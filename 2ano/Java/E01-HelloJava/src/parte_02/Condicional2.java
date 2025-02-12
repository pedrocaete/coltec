package parte_02;

import java.util.Scanner;

public class Condicional2{
    public static void main(String[] args){
        int numero;
        Scanner scanner = new Scanner(System.in);
        System.out.println("Escreva um numero");
        numero = scanner.nextInt();
        if(numero % 7 == 0)
            System.out.println("O numero e multiplo de 7");
        else
            System.out.println("O numero nao e multiplo de 7");

    }
}
