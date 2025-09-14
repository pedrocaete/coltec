public class NotificadorEmail : IObservadorPedido
{
    public void AoMudarStatusPedido(Pedido pedido, string novoStatus)
    {
        Console.WriteLine($"[EMAIL] O pedido mudou para o status: {novoStatus}");
    }
}
