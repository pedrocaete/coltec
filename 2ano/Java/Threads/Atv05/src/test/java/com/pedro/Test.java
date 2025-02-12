package com.pedro;
import com.pedro.*;
import java.util.LinkedList;
import java.util.Queue;
import java.util.concurrent.ThreadPoolExecutor;

public class Test {
    public static void main (String[] args){
        Queue<String> fila = new LinkedList<>();

        Consumidor consumidor = new Consumidor(fila);
        Produtor produtor = new Produtor(fila, 10);

        Thread threadConsumidor = new Thread(consumidor);
        Thread threadProdutor = new Thread(produtor);
        
        threadConsumidor.start();
        threadProdutor.start();

        try {
            threadConsumidor.join();
            threadProdutor.join();
        }
        catch (InterruptedException e){
            e.printStackTrace();
        }
    }
}   
