package com.pedro;

public class Counter implements Runnable{
    public int counter;

    public Counter(int start) {
        this.counter = start;
    }

    public Counter() {
        this.counter = 0;
    }

    public synchronized void increment(int value) {
        this.counter += value;
    }

    public synchronized void increment() {
        this.counter ++;
    }

    public int getCounter() {
        return this.counter;
    }

    public void run(){
        for (int i = 0; i < 100000; i ++){
            this.increment();
        }
        System.out.println("Thread " + Thread.currentThread().getName() + " terminou de incrementar");
    }
}
