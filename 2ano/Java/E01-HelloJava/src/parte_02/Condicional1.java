package parte_02;

import java.util.Scanner;

public class Condicional1
{
    public static void main(String[] args) {
        int n;
        Scanner scanner = new Scanner(System.in);
        System.out.println("Escreva um número");
        n = scanner.nextInt();
        if(n % 2 == 0)
            System.out.println("O numero e par");
        else
            System.out.println("O numero e impar");
        scanner.close();
    }
}

