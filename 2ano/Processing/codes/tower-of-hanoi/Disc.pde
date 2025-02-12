public class Disc {

  float Width;
  float Height;
  float xPos;
  float yPos;
  float color1, color2, color3;

  public Disc (int i, float size){
    this.Width = size;
    this.Height = Width/3;
    this.Width -= i*10;
    this.xPos = (width/2 - Width - 5)/2;
    this.yPos = height - (Height * (i + 1)) - 10;
    this.color1 = random(255);
    this.color2 = random(255);
    this.color3 = random(255);
  }
  
  public Disc(float size){
    this.Width = size;
  }
  
  public void show(){
    fill(color1, color2, color3);
    rect(xPos,yPos,Width,Height,2);
  }
  
}
