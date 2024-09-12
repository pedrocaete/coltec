class Fish{
  float fishWidth;
  float fishHeight;
  float xPos;
  float yPos;
  float speedX;
  float speedY;
  float sinalX;
  float sinalY;
  float executionsNumber;
  float R;
  float G;
  float B;
 
  public Fish(){
    fishWidth=random(20,70);
    R= (int) random(255);
    G= (int) random(255);
    B= (int) random(255);
    speedX = random(100, 900)/frameRate;
    speedY = random(1, 400)/frameRate;
    fishHeight=fishWidth/2;
    sinalX=1;
    sinalY=1;
    executionsNumber = 0;
    xPos=random(100, width-100);
    yPos=random(100, height-100);
  }  
  public void move()
  {
    executionsNumber++;
    if(executionsNumber==600){
      executionsNumber = 0;
      speedX = sinalX * random(100, 900)/frameRate;
      speedY = sinalY * random(1, 400)/frameRate;
    }
    if((xPos >= width - this.fishWidth/2|| xPos <= 0 + this.fishWidth/2) ){
      speedX = -speedX;
      sinalX = -sinalX;
    }
    if((yPos >= height - this.fishHeight/2|| yPos <= 0 + this.fishHeight/2) ){
      speedY = -speedY;
      sinalY = -sinalY;
    }
    xPos += speedX;
    yPos += speedY;
  }
 
  public void draw()
  {  
    if(sinalX>0){
      fill(R,G,B);
      triangle(xPos-fishWidth,yPos-fishHeight/2,xPos-fishWidth,yPos+fishHeight/2,xPos-fishWidth/2+fishWidth/10,yPos);
      ellipse (xPos,yPos,fishWidth,fishHeight);
      fill(0);
      ellipse(xPos + fishWidth/6,yPos - fishWidth/7,fishWidth/10,fishWidth/10);
      line(xPos+fishWidth/2,yPos,xPos+fishWidth/3,yPos);
    }
    else{
      fill(R,G,B);
      triangle(xPos+fishWidth,yPos-fishHeight/2,xPos+fishWidth,yPos+fishHeight/2,xPos+fishWidth/2-fishWidth/10,yPos);
      ellipse (xPos,yPos,fishWidth,fishHeight);
      fill(0);      
      ellipse(xPos - fishWidth/6,yPos - fishWidth/7,fishWidth/10,fishWidth/10);
      line(xPos-fishWidth/2,yPos,xPos-fishWidth/3,yPos);
    }
   
  }
 
}
