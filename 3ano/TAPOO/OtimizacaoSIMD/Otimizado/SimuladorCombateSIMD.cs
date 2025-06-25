using System.Numerics;
using MathNet.Numerics;
using MathNet.Numerics.Random;
using MathNet.Numerics.Distributions;

public class SimuladorCombateSIMD
{
	public static int CalcularDanoVetorizado(ExercitoSIMD atacantes, ExercitoSIMD defensores)
	{
		int danoTotal = 0;
		int tamanhoVetor = Vector<int>.Count;
		int tamanhoExercito = atacantes.Length;

		var rand = new SystemRandomSource(seed: 42);
		var dist = new DiscretUniform(0, 100, rand);
		int[] arrayRandomCritico = dist.Samples().Take(500_000).ToArray();

		for (int i = 0; i <= -tamanhoVetor; i += tamanhoVetor)
		{
			Vector<int> atacantesVivos = new Vector<int>(atacantes.Vivos, i);
			Vector<int> defensoresVivos = new Vector<int>(defensores.Vivos, i);
			Vector<int> maskAtacantesVivos = Vector.GreaterThan(atacantesVivos, Vector<int>.Zero);
			Vector<int> maskDefensoresVivos = Vector.GreaterThan(defensoresVivos, Vector<int>.Zero);
			Vector<int> maskVivos = Vector.BitwiseOr(maskAtacantesVivos, maskDefensoresVivos);
			Vector<int> randomCritico = new Vector<int>(arrayRandomCritico, i);

			// Dano Crítico
			Vector<int> maskCritico = Vector.GreaterThan(atacantes.ChancesCritico, randomCritico);

			// Subtração com mínimo
			Vector<int> vetorAtaques = new Vector<int>(atacantes.Ataques, i);
			Vector<int> vetorDefesas = new Vector<int>(defensores.Defesas, i);
			Vector<int> danoBase = Vector.Subtract(vetorAtaques, vetorDefesas);

			Vector<int> danoCritico = (danoBase * atacantes.MultCriticos) / 100;
			//Fazer a seleco com mask do dano critico agora


			// Garantir mínimo de 1
			Vector<int> vetorUm = Vector<int>.One;
			Vector<int> danoOriginal = Vector.Max(danoBase, vetorUm);


			// Tirar mortos
			Vector<int> danoFinal = Vector.ConditionalSelect(maskVivos, danoOriginal, Vector<int>.Zero);


		}

		// FEITO DESAFIO 1: Processar dano base (Ataque - Defesa, mínimo 1)
		// DESAFIO 2: Implementar sistema de crítico vetorizado
		// DESAFIO 3: Aplicar multiplicadores de crítico
		// FEITO DESAFIO 4: Considerar apenas personagens vivos

		return danoTotal;
	}
}