using System.Net;
using System.Net.Sockets;

public class Server
{
    readonly IMessageStream _messageStream;
    readonly TcpListener _listener;
    readonly TcpClient _client;

    public Server(IMessageStream messageStream, TcpListener listener, TcpClient client)
    {
        _messageStream = messageStream;
        _listener = listener;
        _client = client;
    }

    public Server(int port)
        : this(AcceptConnection(port, out var listener, out var client), listener, client) { }

    private static IMessageStream AcceptConnection(int port, out TcpListener listener, out TcpClient client)
    {
        listener = new TcpListener(IPAddress.Any, port);
        listener.Start();
        Console.WriteLine($"Aguardando Player2 na porta {port}...");
        client = listener.AcceptTcpClient();
        Console.WriteLine("Player2 conectado!");
        return new NetworkMessageStream(client.GetStream());
    }

    public void Send(string msg)
    {
        _messageStream.Send(msg);
    }

    public string Receive()
    {
        return _messageStream.Receive();
    }

    public void Close()
    {
        _messageStream?.Close();
        _client?.Close();
        _listener?.Stop();
    }
}
