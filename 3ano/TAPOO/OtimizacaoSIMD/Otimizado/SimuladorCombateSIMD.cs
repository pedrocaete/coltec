using System.Numerics;

public class SimuladorCombateSIMD
{
    public static long CalcularDanoVetorizado(ExercitoSIMD atacantes, ExercitoSIMD defensores, int[] randomCriticos)
    {
        int tamanhoExercito = atacantes.Vivos.Length;
        int tamanhoVetor = Vector<int>.Count;

        long danoTotal = 0;
        int limiteSIMD = tamanhoExercito - (tamanhoExercito % tamanhoVetor);

        int[] mascaraVivos = new int[tamanhoExercito];
        for (int i = 0; i < tamanhoExercito; i++)
        {
            mascaraVivos[i] = (atacantes.Vivos[i] && defensores.Vivos[i]) ? 1 : 0;
        }

        Vector<int> vetorUm = Vector<int>.One;
        Vector<int> vetorCem = new Vector<int>(100);

        for (int i = 0; i < limiteSIMD; i += tamanhoVetor)
        {
            Vector<int> ataques = new Vector<int>(atacantes.Ataques, i);
            Vector<int> defesas = new Vector<int>(defensores.Defesas, i);
            Vector<int> chancesAtacante = new Vector<int>(atacantes.ChancesCritico, i);
            Vector<int> multAtacante = new Vector<int>(atacantes.MultCriticos, i);
            Vector<int> randoms = new Vector<int>(randomCriticos, i);
            Vector<int> mascaras = new Vector<int>(mascaraVivos, i);

            Vector<int> danoBase = Vector.Max(
                Vector.Subtract(ataques, defesas),
                vetorUm
            );

            Vector<int> ehCritico = Vector.LessThan(randoms, chancesAtacante);

            Vector<int> multiplicador = Vector.ConditionalSelect(
                ehCritico,
                multAtacante,
                vetorCem
            );

            Vector<int> danoComCritico = Vector.Multiply(danoBase, multiplicador);
            Vector<int> danoNormalizado = Vector.Divide(danoComCritico, vetorCem);
            Vector<int> danoFinal = Vector.Multiply(danoNormalizado, mascaras);

            danoTotal += Vector.Dot(danoFinal, vetorUm);
        }

        for (int i = limiteSIMD; i < tamanhoExercito; i++)
        {
            if (mascaraVivos[i] == 1)
            {
                int danoBase = Math.Max(atacantes.Ataques[i] - defensores.Defesas[i], 1);
                bool critico = randomCriticos[i] < atacantes.ChancesCritico[i];
                int danoFinal = critico ?
                    (danoBase * atacantes.MultCriticos[i]) / 100 :
                    danoBase;

                danoTotal += danoFinal;
            }
        }

        return danoTotal;
    }
}
