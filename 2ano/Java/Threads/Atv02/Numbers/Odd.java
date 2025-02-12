package Numbers;

public class Odd implements Runnable{
    public void run() {
        for (int i = 0;;i += 2){
            System.out.println(i + "\n");
            try {
                Thread.sleep(1000);
            } catch (Exception e) {
                System.out.println("Thread Interrompida\n");
            }
        }
    }
}
