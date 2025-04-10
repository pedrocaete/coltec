public static class ConsoleLock
{
    private static readonly object _lock = new();

    public static void Log(ConsoleColor color, string message)
    {
        lock (_lock)
        {
            var aux = Console.ForegroundColor;
            Console.ForegroundColor = color;
            Console.WriteLine(message);
            Console.ForegroundColor = aux;
        }
    }
}
