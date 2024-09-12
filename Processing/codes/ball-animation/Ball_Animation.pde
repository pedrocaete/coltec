import java.util.LinkedList;
LinkedList<Ball> balls = new LinkedList<Ball>();


void setup(){
size(1280,920);
img = loadImage("Ball.png");
}


void draw(){
  background(#D9DB28);
  for(Ball ball :balls){
    ball.show();
    ball.update();
  }

 
 
}

void mouseReleased(){
  Ball ball = new Ball();
  balls.add(ball);
}
