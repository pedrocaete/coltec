public class TestConsole : IConsole
{
    private Queue<string> _inputs;
    public List<string> Outputs = new();

    public TestConsole(IEnumerable<string> inputs)
    {
        _inputs = new Queue<string>(inputs);
    }

    public void Write(string? value)
    {
        Outputs.Add(value ?? "");
    }

    public void WriteLine(string? value = null)
    {
        Outputs.Add((value ?? "") + "\n");
    }

    public string? ReadLine()
    {
        return _inputs.Count > 0 ? _inputs.Dequeue() : null;
    }
}
