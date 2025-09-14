public class Roupa : Produto 
{
    public string Tamanho {get; set;}

    public override string ObterCategoria()
    {
        return "Roupas";
    }

    public override decimal CalcularFrete()
    {
        return 12.5m;
    }
}
