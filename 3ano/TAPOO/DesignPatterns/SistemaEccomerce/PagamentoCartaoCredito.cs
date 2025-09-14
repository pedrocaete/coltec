public class PagamentoCartaoCredito : IEstrategiaPagamento
{
    public string NumeroCartao { get; set; }
    public string NomeTitular { get; set; } 

    public bool ProcessarPagamento(decimal valor)
    {
        return valor > 0 && valor < 5000;
    }
    
    public string ObterDetalhesPagamento()
    {
        string Ultimos4Digitos = NumeroCartao.Substring(NumeroCartao.Length - 4);
        return $"Últimos 4 Dígitos Cartão de Crédito: {Ultimos4Digitos}";
    }
}
