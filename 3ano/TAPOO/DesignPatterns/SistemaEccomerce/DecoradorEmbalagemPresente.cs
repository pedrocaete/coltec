public class DecoradorEmbalagemPresente : DecoradorProduto
{
	public DecoradorEmbalagemPresente(Produto produto) : base(produto)
	{
    	Preco = produto.Preco + 5m;
	}
}
