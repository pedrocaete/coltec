using System.Globalization;
using System.Text.Json;

public class Cryptocurrency
{
    decimal AtualPrice { get; set; }
    decimal? PreviousPrice { get; set; }
    string Simbol { get; }

    public Cryptocurrency(string simbol)
    {
        Simbol = simbol;
    }
    static HttpClient CriarClienteHttp()
    {
        var cliente = new HttpClient
        {
            Timeout = TimeSpan.FromSeconds(10)
        };
        cliente.DefaultRequestHeaders.Add("User-Agent", "MonitorCripto/1.0");
        cliente.DefaultRequestHeaders.Add("Accept", "application/json");
        return cliente;
    }

    public async Task ObterEConverterCotacaoAsync(CancellationToken token)
    {
        var clienteHttp = CriarClienteHttp();
        var urlRequisicao =
    $"https://api.exchange.cryptomkt.com/api/3/public/price/rate?from={Simbol}&to=USDT";
        var resposta = await clienteHttp.GetAsync(urlRequisicao, token);
        resposta.EnsureSuccessStatusCode();

        var json = await resposta.Content.ReadAsStringAsync(token);

        using var documento = JsonDocument.Parse(json);
        if (documento.RootElement.TryGetProperty(Simbol, out var dadosMoeda))
        {
            PreviousPrice = PreviousPrice == null ? 0 : AtualPrice;
            var precoString = dadosMoeda.GetProperty("price").GetString();
            AtualPrice = decimal.Parse(precoString,
CultureInfo.InvariantCulture);
        }
    }

    public void ExibirResultadosNoConsole()
    {
        string cotationSimbol;
        var corOriginal = Console.ForegroundColor;
        if (AtualPrice > PreviousPrice)
        {
            Console.ForegroundColor = ConsoleColor.Green;
            cotationSimbol = "↑";
        }
        else if (AtualPrice < PreviousPrice)
        {
            Console.ForegroundColor = ConsoleColor.Red;
            cotationSimbol = "↓";
        }
        else
        {
            Console.ForegroundColor = ConsoleColor.White;
            cotationSimbol = "|";
        }

        Console.WriteLine($"{Simbol}: ${AtualPrice:N2} {cotationSimbol}");
        Console.ForegroundColor = corOriginal;
    }





}
