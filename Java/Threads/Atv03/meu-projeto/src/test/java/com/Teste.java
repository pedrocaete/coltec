package com;

import com.numbers.*;

public class Teste {
    public static void main(String[] args) {
        Object lock = new Object();
   Z
        Odd odd = new Odd(lock);
        Pairs pair = new Pairs(lock);
        
        Thread thread1 = new Thread(odd);
        Thread thread2 = new Thread(pair);

        thread1.start();
        thread2.start();
    }
}
