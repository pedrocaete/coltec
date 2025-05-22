class Program
{
    public static async Task Main(string[] args)
    {
        List<Cryptocurrency> cryptos = new(){
            new Cryptocurrency("BTC"),  // Bitcoin
	        new Cryptocurrency("ETH"),  // Ethereum
	        new Cryptocurrency("LTC"),  // Litecoin
	        new Cryptocurrency("BCH"),  // Bitcoin Cash
	        new Cryptocurrency("XRP"),  // Ripple
	        new Cryptocurrency("ADA"),  // Cardano
	        new Cryptocurrency("DOT"),  // Polkadot
        	new Cryptocurrency("LINK"), // Chainlink
	        new Cryptocurrency("XLM"),  // Stellar
	        new Cryptocurrency("DOGE")  // Dogecoin
        };

        using CancellationTokenSource cts = new();

        _ = MonitorarTeclaEscAsync(cts);
        try
        {
            while (!cts.Token.IsCancellationRequested)
            {
                var tasks = cryptos.Select(async crypto =>
                {
                    await crypto.ObterEConverterCotacaoAsync(cts.Token);
                    crypto.ExibirResultadosNoConsole();
                });
                await Task.WhenAll(tasks);
                await Task.Delay(30000, cts.Token);
            }
        }
        catch (TaskCanceledException)
        {
            Console.WriteLine("Programa Encerrado");
        }
        catch (Exception e)
        {
            Console.WriteLine($"Ocorreu um erro: {e}");
        }
    }

    public static async Task MonitorarTeclaEscAsync(CancellationTokenSource cts)
    {
        while (true)
        {
            if (Console.KeyAvailable && Console.ReadKey(true).Key == ConsoleKey.Escape)
            {
                cts.Cancel();
                break;
            }
            await Task.Delay(100);
        }
    }
}
