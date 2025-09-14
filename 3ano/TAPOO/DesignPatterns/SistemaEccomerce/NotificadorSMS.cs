public class NotificadorSMS : IObservadorPedido
{
    public void AoMudarStatusPedido(Pedido pedido, string novoStatus)
    {
        Console.WriteLine($"[SMS] O pedido mudou para o status: {novoStatus}");
    }
}
