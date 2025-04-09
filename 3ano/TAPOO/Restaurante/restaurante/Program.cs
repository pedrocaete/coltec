using System;
using System.Threading.Tasks;
using System.Collections.Concurrent;

BlockingCollection<(int pedidoId, int pratoId)> pedidos = new BlockingCollection<(int pedidoId, int pratoId)>();
object lockConsole = new();

void ConsoleLock(string msg, ConsoleColor color)
{
    lock (lockConsole)
    {
        var aux = Console.ForegroundColor;
        Console.ForegroundColor = color;
        Console.WriteLine(msg);
        Console.ForegroundColor = aux;
    }
}

int proximoPedidoId = 0;

void Garcom()
{
    var rnd = new Random();
    var threadId = Thread.CurrentThread.ManagedThreadId;
    Console.WriteLine($"[Garcom {threadId}] Estou pronto!!!");

    while (true)
    {
        int tempo = rnd.Next(1000, 10000);
        int pratoId = rnd.Next(1, 4);
        int pedidoId = Interlocked.Increment(ref proximoPedidoId);

        Thread.Sleep(tempo);

        ConsoleLock($"[Garcom {threadId}] Enviei pedido {pedidoId} do prato {pratoId}!", ConsoleColor.Blue);
        pedidos.Add((pedidoId, pratoId));
    }

    pedidos.CompleteAdding();
}

void Chef()
{
    Console.WriteLine("[Chef] Estou pronto!!!");

    foreach (var (pedidoId, pratoId) in pedidos.GetConsumingEnumerable())
    {
        ConsoleLock($"[Chef] Iniciando o pedido {pedidoId} do prato {pratoId}!", ConsoleColor.Red);

        if (pratoId is 1 or 2) Thread.Sleep(2000);
        else Thread.Sleep(3000);

        ConsoleLock($"[Chef] Finalizado o pedido {pedidoId} do prato {pratoId}!", ConsoleColor.Red);
    }
}

// Inicializa 5 garçons (tasks)
var tarefasGarcons = Enumerable.Range(1, 5)
    .Select(_ => Task.Run(() => Garcom()))
    .ToList();

// Inicializa o chef (task)
var tarefaChef = new Task(Chef);
tarefaChef.Start();

// Aguarda o término do chef (nunca ocorre neste caso)
tarefaChef.Wait();

// Aguarda o término de todos os garçons (também nunca ocorre)
Task.WaitAll(tarefasGarcons.ToArray());
