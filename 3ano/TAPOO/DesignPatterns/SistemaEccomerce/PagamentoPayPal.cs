public class PagamentoPayPal : IEstrategiaPagamento
{
    public string EmailPayPal { get; set; }

    public bool ProcessarPagamento(decimal valor)
    {
        return valor > 0 && EmailPayPal != string.Empty ? true : false;
    }

    public string ObterDetalhesPagamento()
    {
        return $"Pagamento com PayPal \n Email: {EmailPayPal}";
    }
}
