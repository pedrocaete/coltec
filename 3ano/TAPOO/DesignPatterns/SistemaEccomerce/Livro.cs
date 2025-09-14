public class Livro : Produto
{
    public string Autor {get; set;}
    public int NumeroPaginas {get; set;}

    public override string ObterCategoria()
    {
        return "Livros";
    }

    public override decimal CalcularFrete()
    {
        return NumeroPaginas > 300 ? 8m : 5m;
    }
}
