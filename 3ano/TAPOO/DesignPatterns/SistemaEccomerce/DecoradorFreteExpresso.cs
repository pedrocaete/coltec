public class DecoradorFreteExpresso : DecoradorProduto
{
	public DecoradorFreteExpresso(Produto produto) : base(produto)
	{
    	Preco = produto.Preco + 15m;
	}
}
