public interface IMessageStream
{
    void Send(string message);
    string Receive();
    void Close();
}
