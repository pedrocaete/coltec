package com.numbers;

public class Odd implements Runnable {
    private final Object lock;

    public Odd(Object lock) {
        this.lock = lock;
    }

    public void run() {
        for (int i = 0;; i += 2) {
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
