public class RestServer
{
    WebApplicationBuilder builder;
    WebApplication app;

    public RestServer(string[]? args = null)
    {
        builder = WebApplication.CreateBuilder(args);
 //       builder.Logging.ClearProviders();
        app = builder.Build();

        app.MapGet("/temperatura/{unidade}", (string unidade) =>
        {
            double t = DateTime.Now.TimeOfDay.TotalHours;

            double tempCBase = 25.0 + 5.0 * Math.Sin((2.0 * Math.PI / 24.0) * t);

            double ruido = Random.Shared.NextDouble();
            double tempC = tempCBase + ruido;

            double resultado;
            string uni = unidade.ToLower();
            if (uni == "kelvin")
            {
                resultado = tempC + 273.15;
            }
            else if (uni == "fahrenheit")
            {
                resultado = tempC * 9.0 / 5.0 + 32.0;
            }
            else if (uni == "celsius")
            {
                resultado = tempC;
            }
            else
            {
                return Results.BadRequest(new { erro = "Unidade inválida. Use celsius, kelvin ou fahrenheit." });
            }

            return Results.Ok(new
            {
                unidade = uni,
                valor = Math.Round(resultado, 2)
            });
        });

    }

    public async void StartAsync()
    {
        await app.StartAsync();
    }
}
