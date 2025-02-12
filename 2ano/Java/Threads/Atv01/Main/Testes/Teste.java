package Main.Testes;

import Thread.PrimeiroThread;

public class Teste {
    public static void main(String[] args){
        PrimeiroThread meuThread = new PrimeiroThread();

        Thread thread = new Thread(meuThread);

        thread.start();
    }
}
