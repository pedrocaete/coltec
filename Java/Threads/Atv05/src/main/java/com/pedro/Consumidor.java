package com.pedro;

import java.util.LinkedList;
import java.util.Queue;

public class Consumidor implements Runnable {
    Queue<String> fila = new LinkedList<>();

    public Consumidor(Queue<String> fila) {
        this.fila = fila;
    }

    public void consumir() {
        synchronized (fila) {
            while (fila.isEmpty()) {
                try {
                    Thread.sleep(1000);
                    fila.wait();
                } catch (InterruptedException e) {
                    Thread.currentThread().interrupt();
                }
            }
            String produtoConsumido = fila.poll();
            System.out.println(produtoConsumido + " consumido");
            fila.notify();
        }
       // try {
       //     Thread.sleep(100);
       // } catch (InterruptedException e) {
       //     Thread.currentThread().interrupt();
       // }
    }

    public void run() {
        for (int i = 0;; i++) {
            this.consumir();
        }
    }
}