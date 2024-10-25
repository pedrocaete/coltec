package com.pedro;

import java.util.LinkedList;
import java.util.Queue;

public class Produtor implements Runnable {
    Queue<String> fila = new LinkedList<>();
    public final int LIMITE;
    private final int id;

    public Produtor(Queue<String> fila, int limite, int id) {
        this.fila = fila;
        this.LIMITE = limite;
        this.id = id;
    }

    public void produzir(int valor) {
        synchronized (fila) {
            while (fila.size() == LIMITE) {
                try {
                    fila.wait();
                } catch (InterruptedException e) {
                    Thread.currentThread().interrupt();
                }
            }
            fila.offer("Produto " + valor);
            System.out.println(id + "   Produto " + valor + " produzido\n");
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
            produzir(i);
        }
    }

}
