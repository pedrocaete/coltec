package com.pedro;
import java.util.LinkedList;
import java.util.Queue;

public class Test {
    public static void main(String[] args){
        Queue<String> fila = new LinkedList<>();

        Consumidor consumidor[] = new Consumidor[10];
        Produtor produtor[] = new Produtor[10];
        Thread thread[] = new Thread[20];
        for (int i = 0; i < 10; i ++){
            produtor[i] = new Produtor(fila, 10, i);
            thread[i] = new Thread(produtor[i]);
            consumidor[i] = new Consumidor(fila, i);
            thread[10 + i] = new Thread(consumidor[i]);
        }

        for (int i = 0; i < 20; i++){
            thread[i].start();
        }
    }
}
