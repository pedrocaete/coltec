public class FabricaEletronicos : FabricaProduto
{
	public override Produto CriarProduto(string nome, decimal preco)
	{
    	    return new Eletronico { Nome = nome, Preco = preco };
	}
}
