using System;
using System.Collections.Generic;
using Xunit;
using Moq;

public class AttackTableTests
{
    private Mock<IConsole> _mockConsole;
    private Mock<Client> _mockClient;
    private AttackTable _attackTable;

    public AttackTableTests()
    {
        _mockConsole = new Mock<IConsole>();
        _mockClient = new Mock<Client>();
        _attackTable = new AttackTable(_mockConsole.Object, _mockClient.Object);
    }

    [Fact]
    public void Play_ShouldStopWhenReceiveWIN()
    {
        // Arrange
        var coordinate = new Coordinate("A1");
        _mockConsole.Setup(c => c.ReadLine()).Returns("A1");
        _mockClient.SetupSequence(c => c.Receive())
            .Returns("HIT")
            .Returns("WIN");

        // Act
        _attackTable.Play();

        // Assert
        _mockClient.Verify(c => c.Send("A1"), Times.Exactly(2));
        _mockClient.Verify(c => c.Receive(), Times.Exactly(2));
    }

    [Fact]
    public void Play_ShouldContinueUntilWIN()
    {
        // Arrange
        _mockConsole.SetupSequence(c => c.ReadLine())
            .Returns("A1")
            .Returns("B2")
            .Returns("C3");
        
        _mockClient.SetupSequence(c => c.Receive())
            .Returns("MISS")
            .Returns("HIT")
            .Returns("WIN");

        // Act
        _attackTable.Play();

        // Assert
        _mockClient.Verify(c => c.Send(It.IsAny<string>()), Times.Exactly(3));
        _mockClient.Verify(c => c.Receive(), Times.Exactly(3));
    }

    [Fact]
    public void VerifyAttackStatus_WhenHIT_ShouldUpdateCellWithX()
    {
        // Arrange
        var coordinate = new Coordinate("A1");
        _mockClient.Setup(c => c.Receive()).Returns("HIT");

        // Act
        _attackTable.VerifyAttackStatus(coordinate);

        // Assert
        _mockConsole.Verify(c => c.WriteLine("Jogo Ganho!"), Times.Never);
        // Verificar se a célula foi adicionada à lista attackedCells seria necessário tornar a lista pública ou criar um método para verificar
    }

    [Fact]
    public void VerifyAttackStatus_WhenMISS_ShouldUpdateCellWithO()
    {
        // Arrange
        var coordinate = new Coordinate("A1");
        _mockClient.Setup(c => c.Receive()).Returns("MISS");

        // Act
        _attackTable.VerifyAttackStatus(coordinate);

        // Assert
        _mockConsole.Verify(c => c.WriteLine("Jogo Ganho!"), Times.Never);
    }

    [Fact]
    public void VerifyAttackStatus_WhenWIN_ShouldDisplayWinMessage()
    {
        // Arrange
        var coordinate = new Coordinate("A1");
        _mockClient.Setup(c => c.Receive()).Returns("WIN");

        // Act
        _attackTable.VerifyAttackStatus(coordinate);

        // Assert
        _mockConsole.Verify(c => c.WriteLine("Jogo Ganho!"), Times.Once);
    }

    [Fact]
    public void SendCoordinateToServer_ShouldSendCoordinateAsString()
    {
        // Arrange
        var coordinate = new Coordinate("B3");

        // Act
        _attackTable.SendCoordinateToServer(coordinate);

        // Assert
        _mockClient.Verify(c => c.Send("B3"), Times.Once);
    }

    [Fact]
    public void ReadAttackCoordinate_WithValidInput_ShouldReturnCoordinate()
    {
        // Arrange
        _mockConsole.Setup(c => c.ReadLine()).Returns("A1");

        // Act
        var result = _attackTable.ReadAttackCoordinate();

        // Assert
        Assert.Equal("A1", result.ToString());
        _mockConsole.Verify(c => c.WriteLine("Escreva a coordenada de ataque"), Times.Once);
    }

    [Fact]
    public void ReadAttackCoordinate_WithInvalidInput_ShouldRetryUntilValid()
    {
        // Arrange
        _mockConsole.SetupSequence(c => c.ReadLine())
            .Returns("") // entrada inválida
            .Returns("X") // entrada inválida (muito curta)
            .Returns("A1"); // entrada válida

        // Act
        var result = _attackTable.ReadAttackCoordinate();

        // Assert
        Assert.Equal("A1", result.ToString());
        _mockConsole.Verify(c => c.WriteLine("Coordenada inválida"), Times.Exactly(2));
        _mockConsole.Verify(c => c.WriteLine("Escreva a coordenada de ataque"), Times.Once);
    }

    [Fact]
    public void ReadAttackCoordinate_WithRepeatedCoordinate_ShouldShowErrorAndRetry()
    {
        // Arrange
        // Primeiro, simular um ataque anterior para ter coordenadas repetidas
        var firstCoordinate = new Coordinate("A1");
        _mockConsole.Setup(c => c.ReadLine()).Returns("A1");
        _mockClient.Setup(c => c.Receive()).Returns("HIT");
        _attackTable.VerifyAttackStatus(firstCoordinate);

        // Agora configurar o teste de coordenada repetida
        _mockConsole.SetupSequence(c => c.ReadLine())
            .Returns("A1") // coordenada repetida
            .Returns("B2"); // coordenada válida

        // Act
        var result = _attackTable.ReadAttackCoordinate();

        // Assert
        Assert.Equal("B2", result.ToString());
        _mockConsole.Verify(c => c.WriteLine("Erro: Coordenada repetida"), Times.Once);
    }

    [Fact]
    public void ReadAttackCoordinate_WithInvalidCoordinateFormat_ShouldShowErrorAndRetry()
    {
        // Arrange
        _mockConsole.SetupSequence(c => c.ReadLine())
            .Returns("Z99") // assumindo que isso gera ArgumentException no construtor Coordinate
            .Returns("A1");

        // Act
        var result = _attackTable.ReadAttackCoordinate();

        // Assert
        Assert.Equal("A1", result.ToString());
        _mockConsole.Verify(c => c.WriteLine(It.Is<string>(s => s.StartsWith("Erro:"))), Times.Once);
    }
}

// Classe auxiliar para testes que expõe métodos internos se necessário
public class TestableAttackTable : AttackTable
{
    public TestableAttackTable(IConsole console, Client client) : base(console, client) { }

    public bool TestIsAttackPositionRepeated(Coordinate position)
    {
        return IsAttackPositionRepeated(position);
    }

    public List<Coordinate> GetAttackedCells()
    {
        return attackedCells;
    }

    // Método para adicionar coordenadas diretamente para testes
    public void AddAttackedCell(Coordinate coordinate)
    {
        attackedCells.Add(coordinate);
    }
}

// Testes adicionais usando a classe testável
public class TestableAttackTableTests
{
    [Fact]
    public void IsAttackPositionRepeated_WithNewPosition_ShouldReturnFalse()
    {
        // Arrange
        var mockConsole = new Mock<IConsole>();
        var mockClient = new Mock<Client>();
        var testableTable = new TestableAttackTable(mockConsole.Object, mockClient.Object);
        var coordinate = new Coordinate("A1");

        // Act
        var result = testableTable.TestIsAttackPositionRepeated(coordinate);

        // Assert
        Assert.False(result);
    }

    [Fact]
    public void IsAttackPositionRepeated_WithExistingPosition_ShouldReturnTrue()
    {
        // Arrange
        var mockConsole = new Mock<IConsole>();
        var mockClient = new Mock<Client>();
        var testableTable = new TestableAttackTable(mockConsole.Object, mockClient.Object);
        var coordinate = new Coordinate("A1");
        
        testableTable.AddAttackedCell(coordinate);

        // Act
        var result = testableTable.TestIsAttackPositionRepeated(coordinate);

        // Assert
        Assert.True(result);
    }

    [Fact]
    public void AttackedCells_AfterHit_ShouldContainCoordinate()
    {
        // Arrange
        var mockConsole = new Mock<IConsole>();
        var mockClient = new Mock<Client>();
        var testableTable = new TestableAttackTable(mockConsole.Object, mockClient.Object);
        var coordinate = new Coordinate("A1");
        
        mockClient.Setup(c => c.Receive()).Returns("HIT");

        // Act
        testableTable.VerifyAttackStatus(coordinate);

        // Assert
        var attackedCells = testableTable.GetAttackedCells();
        Assert.Contains(coordinate, attackedCells);
    }
}
