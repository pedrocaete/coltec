package parte_02;

import java.util.Scanner;

public class Condicional3{
    public static void main (String[] args){
        Scanner scanner = new Scanner(System.in);
        int nota;
        System.out.println("Digite a nota final do aluno");
        nota = scanner.nextInt();
        if(nota >= 60)
            System.out.println("Passou de ano");
        else
            System.out.println("Repetiu de ano");
    }
}
