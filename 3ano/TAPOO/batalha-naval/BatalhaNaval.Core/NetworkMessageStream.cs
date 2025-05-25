using System.Net.Sockets;
using System.Text;

public class NetworkMessageStream : IMessageStream
{
    private readonly NetworkStream _stream;

    public NetworkMessageStream(NetworkStream stream)
    {
        _stream = stream;
    }

    public void Send(string message)
    {
        var data = Encoding.ASCII.GetBytes(message);
        _stream.Write(data, 0, data.Length);
    }

    public string Receive()
    {
        var buffer = new byte[32];
        int len = _stream.Read(buffer, 0, buffer.Length);
        return Encoding.ASCII.GetString(buffer, 0, len);
    }

    public void Close()
    {
        _stream?.Close();
    }
}
