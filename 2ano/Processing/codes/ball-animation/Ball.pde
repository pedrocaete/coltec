PImage img;

public class Ball{
  float size;
  float vy;
  float ay;
  float x;
  float y;
  
  public Ball(){
    this.x = mouseX;
    this.y = mouseY;
    vy = 0;
    ay = 0.1;
    size = width/10;
  }
 
  void update(){  
    vy += ay;
    if(y >= height-size){
      y = height-size;
      vy *= -0.9;
    }
    y += vy;
  }
 
  void show(){
    fill(#DB8228);
    image(img,x,y,size,size);
   
  }
}
