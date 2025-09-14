public class DecoradorGarantia : DecoradorProduto
{
	private int _mesesGarantia;
   
	public DecoradorGarantia(Produto produto, int mesesGarantia) : base(produto)
	{
    	_mesesGarantia = mesesGarantia;
    	Preco = produto.Preco + (mesesGarantia * 10); // R$10 por mês
	}
   
    public override string ObterCategoria() => base.ObterCategoria() + $" Garantia de {_mesesGarantia}";
}
