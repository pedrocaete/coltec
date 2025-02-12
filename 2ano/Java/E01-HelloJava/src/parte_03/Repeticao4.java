package parte_03;


import java.util.Scanner;
public class Repeticao4
{
    public static void main(String[] args) {
        int fatorial = 1, n;
        Scanner scanner = new Scanner(System.in);
        System.out.println("Digite um numero");
        n = scanner.nextInt();
        for (int i = 1;i <= n; i ++)
            fatorial *= i;
        System.out.println("O fatorial de " + n + " e " + fatorial);

    }
}


