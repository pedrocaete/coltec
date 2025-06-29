using System.Diagnostics;
using System.Numerics;

public class Program
{
    public static void Main()
    {
        TestarPerformanceCompleta();
    }

    public static void TestarPerformanceCompleta()
    {
        int[] tamanhosExercito = { 10_000, 50_000, 100_000, 500_000, 1_000_000 };

        Console.WriteLine("=== BENCHMARK DE SISTEMA DE COMBATE ===");
        Console.WriteLine($"SIMD Suportado: {Vector.IsHardwareAccelerated}");
        Console.WriteLine($"Elementos por Vetor: {Vector<int>.Count}");
        Console.WriteLine();

        foreach (int tamanho in tamanhosExercito)
        {
            Console.WriteLine($"Testando exércitos de {tamanho:N0} personagens:");

            // Gerar exércitos
            var atacantes = SimuladorCombate.GerarExercito(tamanho, "atacante");
            var defensores = SimuladorCombate.GerarExercito(tamanho, "defensor");

            // Testar versão original
            var stopwatchOriginal = Stopwatch.StartNew();
            int danoOriginal = SimuladorCombate.SimularRodadaCombate(atacantes, defensores);
            stopwatchOriginal.Stop();

            // Converter para SIMD
            var atacantesSIMD = new ExercitoSIMD(tamanho);
            var defensoresSIMD = new ExercitoSIMD(tamanho);
            atacantesSIMD.ConverterDePersonagens(atacantes);
            defensoresSIMD.ConverterDePersonagens(defensores);

            // Testar versão SIMD
            var stopwatchSIMD = Stopwatch.StartNew();
            int danoSIMD = SimuladorCombateSIMD.CalcularDanoVetorizado(atacantesSIMD, defensoresSIMD);
            stopwatchSIMD.Stop();

            // Calcular speedup
            double speedup = (double)stopwatchOriginal.ElapsedMilliseconds / stopwatchSIMD.ElapsedMilliseconds;

            Console.WriteLine($"  Dano Original: {danoOriginal:N0}");
            Console.WriteLine($"  Dano SIMD: {danoSIMD:N0}");
            Console.WriteLine($"  Tempo Original: {stopwatchOriginal.ElapsedMilliseconds}ms");
            Console.WriteLine($"  Tempo SIMD: {stopwatchSIMD.ElapsedMilliseconds}ms");
            Console.WriteLine($"  Speedup: {speedup:F2}x");
            Console.WriteLine($"  DPS Original: {danoOriginal * 1000 / Math.Max(1, stopwatchOriginal.ElapsedMilliseconds):N0}");
            Console.WriteLine($"  DPS SIMD: {danoSIMD * 1000 / Math.Max(1, stopwatchSIMD.ElapsedMilliseconds):N0}");
            Console.WriteLine();
        }
    }
}
