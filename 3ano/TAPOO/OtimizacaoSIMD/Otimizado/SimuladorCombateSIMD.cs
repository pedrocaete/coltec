using System.Numerics;
using MathNet.Numerics;
using MathNet.Numerics.Distributions;
using MathNet.Numerics.Random;

public class SimuladorCombateSIMD
{
    public static int CalcularDanoVetorizado(ExercitoSIMD atacantes, ExercitoSIMD defensores)
    {
        int danoTotal = 0;
        int tamanhoVetor = Vector<int>.Count;
        int tamanhoExercito = atacantes.Vivos.Length;
        int restante = tamanhoExercito % tamanhoVetor;
        int inicioRestante = tamanhoExercito - restante;

        var rand = new SystemRandomSource(seed: 42);
        var dist = new DiscreteUniform(0, 100, rand);
        int[] arrayRandomCritico = dist.Samples().Take(tamanhoExercito).ToArray();

        int[] vivosAtacInt = new int[tamanhoExercito];
        int[] vivosDefInt = new int[tamanhoExercito];

        for (int k = 0; k < tamanhoExercito; k++)
        {
            vivosAtacInt[k] = atacantes.Vivos[k] ? 1 : 0;
            vivosDefInt[k] = defensores.Vivos[k] ? 1 : 0;
        }

        for (int i = 0; i <= tamanhoExercito - tamanhoVetor; i += tamanhoVetor)
        {
            Vector<int> atacantesVivos = new Vector<int>(vivosAtacInt, i);
            Vector<int> defensoresVivos = new Vector<int>(vivosDefInt, i);
            Vector<int> maskAtacantesVivos = Vector.GreaterThan(atacantesVivos, Vector<int>.Zero);
            Vector<int> maskDefensoresVivos = Vector.GreaterThan(defensoresVivos, Vector<int>.Zero);
            Vector<int> maskVivos = Vector.BitwiseOr(maskAtacantesVivos, maskDefensoresVivos);
            Vector<int> randomCritico = new Vector<int>(arrayRandomCritico, i);
            Vector<int> chancesCritico = new Vector<int>(atacantes.ChancesCritico, i);
            Vector<int> multiCriticos = new Vector<int>(atacantes.MultCriticos, i);

            // Dano Crítico
            Vector<int> maskCritico = Vector.GreaterThan(chancesCritico, randomCritico);

            // Subtração com mínimo
            Vector<int> vetorAtaques = new Vector<int>(atacantes.Ataques, i);
            Vector<int> vetorDefesas = new Vector<int>(defensores.Defesas, i);
            Vector<int> danoBase = Vector.Subtract(vetorAtaques, vetorDefesas);

            // Garantir mínimo de 1
            Vector<int> vetorUm = Vector<int>.One;
            Vector<int> danoOriginal = Vector.Max(danoBase, vetorUm);

            Vector<int> danoCritico = (danoOriginal * multiCriticos) / 100;
            Vector<int> danoOriginalComCritico = Vector.ConditionalSelect(
                maskCritico,
                danoCritico,
                danoOriginal
            );

            // Tirar mortos
            Vector<int> danoFinal = Vector.ConditionalSelect(
                maskVivos,
                danoOriginalComCritico,
                Vector<int>.Zero
            );

            for (int j = 0; j < tamanhoVetor; j++)
            {
                danoTotal += danoFinal[j];
            }
        }

        for (int i = inicioRestante; i < tamanhoExercito; i++)
        {
            // 1) Só quem está vivo nos dois exércitos causa dano
            if (!atacantes.Vivos[i] || !defensores.Vivos[i])
                continue;

            // 2) Dano base mínimo 1
            int danoBase = atacantes.Ataques[i] - defensores.Defesas[i];
            int danoOriginal = Math.Max(danoBase, 1);

            // 3) Crítico?
            // (Use o mesmo arrayRandomCritico gerado antes)
            int rnd = arrayRandomCritico[i];
            bool critico = atacantes.ChancesCritico[i] > rnd;

            // 4) Aplica multiplicador
            int danoFinal = critico
                ? (danoOriginal * atacantes.MultCriticos[i]) / 100
                : danoOriginal;

            // Soma ao total
            danoTotal += danoFinal;
        }

        return danoTotal;
    }
}
