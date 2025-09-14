public class PagamentoPix : IEstrategiaPagamento
{
    public string ChavePix { get; set; }

    public bool ProcessarPagamento(decimal valor)
    {
        return valor > 0 ? true : false;
    }

    public string ObterDetalhesPagamento()
    {
        return $"PIX: {ChavePix}";
    }
}
