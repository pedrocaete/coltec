public class FabricaLivro : FabricaProduto
{
    public override Produto CriarProduto(string nome, decimal preco)
    {
        return CriarProduto(nome, preco, "Autor Desconhecido", 100);
    }

    public Produto CriarProduto(string nome, decimal preco, string autor, int numeroPaginas)
    {
        return new Livro
        {
            Nome = nome,
            Preco = preco,
            Autor = autor,
            NumeroPaginas = numeroPaginas,
        };
    }
}
