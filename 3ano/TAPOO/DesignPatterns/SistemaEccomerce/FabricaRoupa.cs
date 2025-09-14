public class FabricaRoupa : FabricaProduto
{
    public override Produto CriarProduto(string nome, decimal preco)
    {
        return new Roupa { Nome = nome, Preco = preco };
    }

    public Produto CriarProduto(string nome, decimal preco, string tamanho)
    {
        return new Roupa
        {
            Nome = nome,
            Preco = preco,
            Tamanho = tamanho,
        };
    }
}
