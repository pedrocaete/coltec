﻿using System;
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
        int[] tamanhosExercito = { 10_000, 50_000, 100_000, 500_000, 1_000_000, 5_000_000, 10_000_000, 20_000_000 };

        Console.WriteLine("=== BENCHMARK DE SISTEMA DE COMBATE ===");
        Console.WriteLine($"SIMD Suportado: {Vector.IsHardwareAccelerated}");
        Console.WriteLine($"Elementos por Vetor: {Vector<int>.Count}");
        Console.WriteLine();

        foreach (int tamanho in tamanhosExercito)
        {
            Console.WriteLine($"Testando exércitos de {tamanho:N0} personagens:");

            var atacantes = SimuladorCombate.GerarExercito(tamanho, "atacante");
            var defensores = SimuladorCombate.GerarExercito(tamanho, "defensor");

            var atacantesSIMD = new ExercitoSIMD(tamanho);
            var defensoresSIMD = new ExercitoSIMD(tamanho);
            atacantesSIMD.ConverterDePersonagens(atacantes);
            defensoresSIMD.ConverterDePersonagens(defensores);

            // Pré-computar números aleatórios uma única vez
            int[] randomCriticos = new int[tamanho];
            var rand = new Random(42);
            for (int i = 0; i < tamanho; i++)
                randomCriticos[i] = rand.Next(0, 100);

            // Sequencial
            var stopwatchOriginal = Stopwatch.StartNew();
            long danoOriginal = SimuladorCombate.SimularRodadaCombate(atacantes, defensores, randomCriticos);
            stopwatchOriginal.Stop();

            // SIMD
            var stopwatchSIMD = Stopwatch.StartNew();
            long danoSIMD = SimuladorCombateSIMD.CalcularDanoVetorizado(atacantesSIMD, defensoresSIMD, randomCriticos);
            stopwatchSIMD.Stop();

            double tempoOriginalMs = Math.Max(1, stopwatchOriginal.ElapsedMilliseconds);
            double tempoSIMDMs = Math.Max(1, stopwatchSIMD.ElapsedMilliseconds);
            double speedup = tempoOriginalMs / tempoSIMDMs;

            long dpsOriginal = (long)(danoOriginal * 1000 / tempoOriginalMs);
            long dpsSIMD = (long)(danoSIMD * 1000 / tempoSIMDMs);

            Console.WriteLine($"  Dano Original: {danoOriginal:N0}");
            Console.WriteLine($"  Dano SIMD: {danoSIMD:N0}");
            Console.WriteLine($"  Tempo Original: {stopwatchOriginal.ElapsedMilliseconds}ms");
            Console.WriteLine($"  Tempo SIMD: {stopwatchSIMD.ElapsedMilliseconds}ms");
            Console.WriteLine($"  Speedup: {speedup:F2}x");
            Console.WriteLine($"  DPS Original: {dpsOriginal:N0}");
            Console.WriteLine($"  DPS SIMD: {dpsSIMD:N0}");
            Console.WriteLine();
        }
    }
}
