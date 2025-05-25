public abstract class TableBase
{
    protected const int TableSize = 10;
    protected readonly IConsole _console;
    protected char[,] _table;

    public TableBase(IConsole console)
    {
        _console = console;
        _table = new char[TableSize, TableSize];
        Initialize();
    }

    protected virtual void Initialize()
    {
        for (int i = 0; i < TableSize; i++)
            for (int j = 0; j < TableSize; j++)
                _table[i, j] = '~';
    }

    public void Show()
    {
        PrintColumnHeaders();
        _console.WriteLine();

        for (int row = 0; row < TableSize; row++)
        {
            PrintRowWithData(row);
        }
    }

    protected void PrintColumnHeaders()
    {
        _console.Write("\t");
        for (int col = 0; col < TableSize; col++)
        {
            char letter = (char)('A' + col);
            _console.Write($"{letter} \t");
        }
        _console.WriteLine();
    }

    protected void PrintRowWithData(int row)
    {
        int rowNumber = row + 1;
        _console.Write($"{rowNumber} \t");

        for (int col = 0; col < TableSize; col++)
        {
            _console.Write($"{_table[row, col]} \t");
        }
        _console.WriteLine();
    }

    public void UpdateCell(Coordinate position, char value)
    {
        _table[position.Row, position.Column] = value;
    }

    public char GetCell(int row, int col) => _table[row, col];
}
