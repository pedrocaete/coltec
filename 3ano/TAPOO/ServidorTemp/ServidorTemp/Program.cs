using System.Text.Json;

public class Program
{
    static string? UnidadeDesejada { get; set; }
    static int IntervaloDeRequisicao { get; set; }
    static string? Url { get; set; }
    static double? AnteriorTemp { get; set; }

    public static async Task Main(string[] args)
    {
        RestServer server = new();
        server.StartAsync();
        UnidadeDesejada = "";
        IntervaloDeRequisicao = 0;
        Url = "";
        AnteriorTemp = null;
        using HttpClient httpClient = new();
        using var cts = new CancellationTokenSource();

        Console.CancelKeyPress += (sender, e) =>
        {
            e.Cancel = true;
            cts.Cancel();
            Console.WriteLine("\nParando o monitoramento...");
        };

        Console.WriteLine("Digite a unidade de medida desejada");
        UnidadeDesejada = Console.ReadLine()?.ToLower() ?? "";

        if (UnidadeDesejada != "celsius" && UnidadeDesejada != "fahrenheit" && UnidadeDesejada != "kelvin")
        {
            Console.WriteLine("Selecione uma unidade válida");
            return;
        }

        Console.WriteLine("Digite o intervalo entre as requisições");
        IntervaloDeRequisicao = int.Parse(Console.ReadLine()!);

        if (IntervaloDeRequisicao < 0)
        {
            Console.WriteLine("Selecione um intervalo válido");
            return;
        }

        Url = $"http://localhost:5086/temperatura/{UnidadeDesejada}";

        try
        {
            while (!cts.Token.IsCancellationRequested)
            {
                await ExibirTemperatura(httpClient, cts.Token);
            }
        }
        catch (OperationCanceledException)
        {
            Console.WriteLine("Monitoramento finalizado.");
        }


    }
    static async Task ExibirTemperatura(HttpClient httpClient, CancellationToken cancellationToken)
    {
        string symbol = "";
        HttpResponseMessage response = await httpClient.GetAsync(Url, cancellationToken);

        if (!response.IsSuccessStatusCode)
        {
            return;
        }

        string jsonString = await response.Content.ReadAsStringAsync();
        var temperatura = JsonSerializer.Deserialize<Temperatura>(jsonString);

        if (temperatura.valor > AnteriorTemp)
        {
            symbol = "↑";
        }
        else if (temperatura.valor < AnteriorTemp)
        {
            symbol = "↓";
        }
        else
        {
            symbol = "";
        }

        AnteriorTemp = temperatura.valor;
        Console.WriteLine($"[{DateTime.Now:HH:mm:ss}]Temperatura: {temperatura.valor}°{temperatura.unidade} {symbol}");
        await Task.Delay(IntervaloDeRequisicao * 1000, cancellationToken);
    }
}

