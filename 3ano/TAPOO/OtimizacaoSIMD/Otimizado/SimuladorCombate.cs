public class SimuladorCombate
{
    private static Random gerador = new Random(42);

    public static int CalcularDano(Personagem atacante, Personagem defensor, int randomCritico)
    {
        if (!atacante.Vivo || !defensor.Vivo)
            return 0;

        int danoBase = Math.Max(1, atacante.Ataque - defensor.Defesa);
        bool ehCritico = randomCritico < atacante.ChanceCritico;

        if (ehCritico)
            danoBase = (danoBase * atacante.MultCritico) / 100;

        return danoBase;
    }

    public static int SimularRodadaCombate(Personagem[] atacantes, Personagem[] defensores, int[] randomCriticos)
    {
        int danoTotal = 0;

        for (int i = 0; i < atacantes.Length && i < defensores.Length; i++)
        {
            danoTotal += CalcularDano(atacantes[i], defensores[i], randomCriticos[i]);
        }

        return danoTotal;
    }

    public static Personagem[] GerarExercito(int tamanho, string tipo)
    {
        Personagem[] exercito = new Personagem[tamanho];

        for (int i = 0; i < tamanho; i++)
        {
            if (tipo == "atacante")
            {
                exercito[i] = new Personagem
                {
                    Ataque = gerador.Next(80, 120), // 80-119 ataque
                    Defesa = gerador.Next(20, 40), // 20-39 defesa
                    ChanceCritico = gerador.Next(15, 25), // 15-24% crítico
                    MultCritico = gerador.Next(180, 220), // 1.8x-2.2x crítico
                    Vida = gerador.Next(100, 150),
                    Vivo = true,
                };
            }
            else // defensor
            {
                exercito[i] = new Personagem
                {
                    Ataque = gerador.Next(60, 80), // menos ataque
                    Defesa = gerador.Next(40, 70), // mais defesa
                    ChanceCritico = gerador.Next(10, 20),
                    MultCritico = gerador.Next(150, 200),
                    Vida = gerador.Next(120, 180), // mais vida
                    Vivo = true,
                };
            }
        }

        return exercito;
    }
}
