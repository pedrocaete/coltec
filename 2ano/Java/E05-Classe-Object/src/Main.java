
public class Main {

    public static void main(String[] args) {
        Cliente pessoa1 = new PessoaFisica("123456789", 30, 'M', "João da Silva", "Rua XYZ, 123");
        Cliente empresa1 = new PessoaJuridica("12345678901234", 50, "Tecnologia", "Empresa XYZ", "Avcipal, 123");
        Cliente pessoa2 = new PessoaFisica("123456789", 560, 'F', "João da Sivs", "RuZ, 123");
        Cliente empresa2 = new PessoaJuridica("12345678901234", 5078, "Tecngia", "resa XYZ", "Av. cipal, 123");
        Conta contapf = new Conta(1000.0, 123456, "001", 500.0, pessoa1);
        Conta contapj = new Conta(10000.0, 5789, "002", 200000.0,empresa1);
        Conta contapf2 = new Conta(1006660.0, 123456, "001", 500.0, pessoa2);
        Conta contapj2 = new Conta(10000666.0, 5789, "002", 200000.0,empresa2);

        System.out.println(empresa1.toString());
        System.out.println(pessoa1.toString());

        System.out.println(contapf.toString());
        System.out.println(contapj.toString());

        contapf.depositar(900);
        contapf.sacar(100);

        contapf.extrato();

        contapj.depositar(900);
        contapj.sacar(100);

        contapj.extrato();

        System.out.println(empresa1.equals(empresa2));
        System.out.println(pessoa1.equals(pessoa2));
        System.out.println(contapj.equals(contapj2));

    }
}
