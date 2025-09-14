public class Eletronico : Produto
{
    public override string ObterCategoria()
    {
        return "Eletrônicos";
    }
    
    public override decimal CalcularFrete()
    {
        return Preco * 0.05m;
    }
}
