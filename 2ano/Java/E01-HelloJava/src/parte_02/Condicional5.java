package parte_02;

import java.util.Scanner;

public class Condicional5{
    public static void main(String[] args){
        int numero1,numero2;
        Scanner scanner = new Scanner(System.in);
        System.out.println("Digite dois numeros");
        numero1 = scanner.nextInt();
        numero2 = scanner.nextInt();

        if(numero1 > numero2)
            System.out.println("O numero 1("+numero1+") e maior");
        else
            System.out.println("O numero 2("+numero2+") e maior");
    }
}