using System.Net.Sockets;

public class Client
{
    readonly IMessageStream _messageStream;
    readonly TcpClient? client;

    public Client(IMessageStream messageStream)
    {
        _messageStream = messageStream;
    }

    public Client(string ip, int port)
        : this(ConnectToServer(ip, port)) {}

    private static IMessageStream ConnectToServer(string ip, int port)
    {
        var client = new TcpClient();
        client.Connect(ip, port);
        Console.WriteLine("Conectado ao servidor!");
        var stream = client.GetStream();
        return new NetworkMessageStream(stream);
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
        client?.Close();
    }
}
