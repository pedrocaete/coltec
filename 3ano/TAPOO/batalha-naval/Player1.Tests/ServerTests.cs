public class ServerTests
{
    [Fact]
    public void Send_Message_SendMessage()
    {
        var fakeStream = new MessageStreamMock();
        var server = new Server(fakeStream);

        server.Send("Olá Player2");

        Assert.Equal("Olá Player2", fakeStream.SentMessage);
    }

    [Fact]
    public void Receive_Message_ReturnsMessage()
    {
        var fakeStream = new MessageStreamMock();
        var server = new Server(fakeStream);

        var result = server.Receive();

        Assert.Equal("Olá do Player2", result);
    }
}
