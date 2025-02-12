package parte_02;

import java.util.Scanner;

public class Condicional4{
    public static void main (String[] args){
        Scanner scanner = new Scanner(System.in);
        int nota;
        System.out.println("Digite a nota final do aluno");
        nota = scanner.nextInt();
        if(nota < 40)
            System.out.println("Conceito: F");
        else if(nota < 60)
            System.out.println("Conceito: E");
        else if(nota < 70)
            System.out.println("Conceito: D");
        else if(nota < 80)
            System.out.println("Conceito: C");
        else if(nota < 90)
            System.out.println("Conceito: B");
        else
            System.out.println("Conceito: A");
    }
}