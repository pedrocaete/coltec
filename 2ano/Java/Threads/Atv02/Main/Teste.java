package Main;

import Numbers.Odd;
import Numbers.Pairs;

public class Teste {
    public static void main(String[] args){
        Pairs threadPares = new Pairs();
        Odd threadImpares = new Odd();

        Thread thread1 = new Thread(threadPares);
        Thread thread2 = new Thread(threadImpares);

        thread1.start();
        thread2.start();
    }
}
