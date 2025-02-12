package com.numbers;

public class Pairs implements Runnable {
    private final Object lock;

    public Pairs(Object lock) {
        this.lock = lock;
    }

    public void run() {
        for (int i = 1;; i += 2) {
            synchronized (lock) {
                System.out.println(i + "\n");
                try {
                    Thread.sleep(1000);
                    lock.notify();
                    lock.wait();
                } catch (Exception e) {
                    System.out.println("Thread Interrompida\n");
                }

            }
        }
    }
}
