public interface IEstrategiaPagamento
{
	bool ProcessarPagamento(decimal valor);
	string ObterDetalhesPagamento();
}
