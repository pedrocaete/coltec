public class SistemaECommerce
{
    public static void Main()
    {
        // 1. Configurar sistema usando Singleton
        var configuracao = GerenciadorConfiguracao.Instancia;
        configuracao.ConexaoBancoDados = "ServidorLocal;Banco=EcommerceDB";
        configuracao.TaxaImposto = 0.1m;
        Console.WriteLine($"Configuração: Conexão={configuracao.ConexaoBancoDados}, Imposto={configuracao.TaxaImposto:P}");

        // 2. Criar produtos usando Factory
        var fabricaEletronicos = new FabricaEletronicos();
        var smartphone = fabricaEletronicos.CriarProduto("iPhone", 999.99m);

        var fabricaRoupas = new FabricaRoupa();
        var camiseta = fabricaRoupas.CriarProduto("Camiseta", 49.90m);

        var fabricaLivros = new FabricaLivro();
        var livro = fabricaLivros.CriarProduto("Clean Code", 89.90m);
        // Ajuste propriedades específicas do livro
        if (livro is Livro livroConcreto)
        {
            livroConcreto.Autor = "Robert C. Martin";
            livroConcreto.NumeroPaginas = 464;
        }

        // 3. Aplicar decoradores
        // Smartphone com garantia estendida + frete expresso
        var smartphoneComGarantia = new DecoradorGarantia(smartphone, 12);
        var smartphoneFinal = new DecoradorFreteExpresso(smartphoneComGarantia);

        // Camiseta com embalagem presente
        var camisetaPresente = new DecoradorEmbalagemPresente(camiseta);

        // 4. Criar pedido e adicionar observadores
        var pedido = new Pedido();
        pedido.Inscrever(new NotificadorEmail());
        pedido.Inscrever(new NotificadorSMS());

        // Simular alteração do status do pedido para disparar notificações
        pedido.Status = "Processando";
        pedido.Status = "Enviado";
        pedido.Status = "Entregue";

        // 5. Processar pagamento usando Strategy
        var contextoPagamento = new ContextoPagamento();

        // Teste com cartão de crédito
        contextoPagamento.DefinirEstrategiaPagamento(new PagamentoCartaoCredito 
        { 
            NumeroCartao = "1234567812345678", NomeTitular = "Maria Silva" 
        });
        bool sucessoCartao = contextoPagamento.ExecutarPagamento(smartphoneFinal.Preco);
        Console.WriteLine(smartphoneFinal.Preco);
        Console.WriteLine(sucessoCartao);
        Console.WriteLine($"Pagamento Cartão: {(sucessoCartao ? "Aprovado" : "Rejeitado")} - {contextoPagamento.ObterDetalhes()}");

        // Teste com PayPal
        contextoPagamento.DefinirEstrategiaPagamento(new PagamentoPayPal 
        { 
            EmailPayPal = "usuario@paypal.com" 
        });
        bool sucessoPaypal = contextoPagamento.ExecutarPagamento(camisetaPresente.Preco);
        Console.WriteLine($"Pagamento PayPal: {(sucessoPaypal ? "Aprovado" : "Rejeitado")} - {contextoPagamento.ObterDetalhes()}");

        // Teste com Pix
        contextoPagamento.DefinirEstrategiaPagamento(new PagamentoPix 
        { 
            ChavePix = "99999999999" 
        });
        bool sucessoPix = contextoPagamento.ExecutarPagamento(livro.Preco);
        Console.WriteLine($"Pagamento Pix: {(sucessoPix ? "Aprovado" : "Rejeitado")} - {contextoPagamento.ObterDetalhes()}");
    }
}
