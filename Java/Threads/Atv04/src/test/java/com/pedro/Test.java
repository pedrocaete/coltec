package com.pedro;

import com.pedro.Counter;

public class Test {
    public static void main(String[] args) {
        Counter counter = new Counter();

        Thread threads[] = new Thread[5];

        for (int i = 0; i < 5; i++) {
            threads[i] = new Thread(counter, "Thread " + (i + 1));
            threads[i].start();
        }

        for (int i = 0; i < 5; i++) {
            try {
                threads[i].join();
            } catch (InterruptedException e) {
                e.printStackTrace();
            }
        }

        System.out.println("Valor do contador: " + counter.getCounter());
    }
}
