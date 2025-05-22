using ConsoleDump;

class Program
{
    static IEnumerable<CotaParlamentar> cotas = CotaParlamentar.LerCotasParlamentares("cota_parlamentar.csv");

    static void Main()
    {
        TotalDeGastosPorAno();
        TotalGastoPorPartido();
        Top5DeputadosComMaiorGastoIndividual();
        GastoMedioPorMes();
        TotalGastoEmAlimentacaoPorDeputado();
        FornecedoresUtilizadosMaisVezes();
        FornecedoresComMaiorGasto();
        GastoTotalPorUF();
        MesesComMaisDocumentosEmitidos();
        DeputadosComDespesaAcimaDeDezMil();
        TotalGastoPorTipoDeDespesa();

    }

    static void TotalGastoPorPartido()
    {
        cotas.GroupBy(c => c.Partido)
             .Select(g => new { Partido = g.Key, TotalGasto = g.Sum(c => c.ValorLiquido) })
             .OrderByDescending(g => g.TotalGasto)
             .Dump();
    }


    static void Top5DeputadosComMaiorGastoIndividual()
    {
        cotas.GroupBy(c => c.NomeParlamentar)
             .Select(g => new { Parlamentar = g.Key, TotalGasto = g.Sum(c => c.ValorLiquido) })
             .OrderByDescending(g => g.TotalGasto)
             .Take(5)
             .Dump();
    }

    static void GastoMedioPorMes()
    {
        cotas.GroupBy(c => c.DataEmissao?.Month ?? 0)
             .Select(g => new { Mes = g.Key, GastoMedio = g.Sum(c => c.ValorLiquido) / g.Count() })
             .OrderByDescending(g => g.Mes)
             .Dump();
    }

    static void TotalGastoEmAlimentacaoPorDeputado()
    {
        cotas.GroupBy(c => c.NomeParlamentar)
             .Select(g => new { Parlamentar = g.Key, TotalGasto = g.Where(c => c.Descricao.Contains("ALIMENTAÇÃO")).Sum(c => c.ValorLiquido) })
             .OrderByDescending(g => g.TotalGasto)
             .Dump();
    }

    static void FornecedoresUtilizadosMaisVezes()
    {
        cotas.GroupBy(c => c.Fornecedor)
             .Select(g => new { Fornecedor = g.Key, QuantidadeDeUsos = g.Count() })
             .OrderByDescending(g => g.QuantidadeDeUsos)
             .Take(10)
             .Dump();
    }

    static void FornecedoresComMaiorGasto()
    {
        cotas.GroupBy(c => c.Fornecedor)
             .Select(g => new { Fornecedor = g.Key, TotalGasto = g.Sum(c => c.ValorLiquido) })
             .OrderByDescending(g => g.TotalGasto)
             .Take(10)
             .Dump();
    }

    static void GastoTotalPorUF()
    {
        cotas.GroupBy(c => c.UF)
             .Select(g => new { UF = g.Key, TotalGasto = g.Sum(c => c.ValorLiquido??0) })
             .OrderByDescending(g => g.TotalGasto)
             .Dump();
    }

    static void MesesComMaisDocumentosEmitidos()
    {
        cotas.GroupBy(c => new { Ano = c.DataEmissao?.Year ?? 0, Mes = c.DataEmissao?.Month ?? 0})
             .Select(g => new { Ano = g.Key.Ano, Mes = g.Key.Mes, QuantidadeDeDocumentos = g.Count() })
             .OrderByDescending(g => g.QuantidadeDeDocumentos)
             .Dump();
    }
   
    static void DeputadosComDespesaAcimaDeDezMil()
    {
        cotas.GroupBy(c => c.NomeParlamentar)
             .Where(g => g.Sum(c => c.ValorLiquido) > 10_000)
             .Select(g => new { Parlamentar = g.Key, TotalGasto = g.Sum(c => c.ValorLiquido) })
             .OrderByDescending(g => g.TotalGasto)
             .Dump();
    }

    static void TotalGastoPorTipoDeDespesa()
    {
        cotas.GroupBy(c => c.Descricao)
             .Select(g => new { TipoDeDespesa = g.Key, TotalGasto = g.Sum(c => c.ValorLiquido) })
             .OrderByDescending(g => g.TotalGasto)
             .Dump();
    }

    static void TotalDeGastosPorAno()
    {
        cotas.GroupBy(c => c.DataEmissao?.Year ?? 0)
             .Select(g => new { Ano = g.Key, TotalGasto = g.Sum(c => c.ValorLiquido) })
             .OrderByDescending(g => g.TotalGasto)
             .Dump();
    }
}
