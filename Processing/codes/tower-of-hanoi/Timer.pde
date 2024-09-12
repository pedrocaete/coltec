public class Timer{
  
  int iterations;
  int seconds;
  int minutes;
  String formatedTime;
  float framerate;
  int textSize;

  public Timer(){
    iterations = 0;
    seconds = 0;
    minutes =0;
    framerate = (int) frameRate;
    textSize = 20;
  }

  public void update(){
    iterations ++;
    if (iterations % framerate == 0){
      seconds ++;
    }
    if (seconds == 60){
      seconds = 0;
      minutes ++;
    }
    formatedTime = String.format("%02d:%02d", minutes, seconds); 
  }

  public void show(){
    fill(0);
    textSize(textSize);
    textAlign(LEFT);
    text("Time: " + formatedTime, 10, 20);   
  }

}
