public class MessageStreamMock : IMessageStream
{
    public string? SentMessage;
    public string MessageToReceive = "Olá do Player2";

    public void Send(string message)
    {
        SentMessage = message;
    }

    public string Receive()
    {
        return MessageToReceive;
    }
}
