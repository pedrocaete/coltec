int fishs_number = 100;
Fish fish[] = new Fish[fishs_number];
void setup(){
  size(1540,900);  
  for(int i=0;i<fishs_number;i++){
    fish[i]= new Fish();
  }
}

void draw(){
  background(0,0,255);
  frameRate(70);
  for(int i=0;i<fishs_number;i++){
    fish[i].move();
    fish[i].draw();
  }
}
