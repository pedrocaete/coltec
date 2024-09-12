class Game{
  int stage;
  boolean done, reading;
  Integer [] from, to;
  ArrayList<Integer[]> way;
  Route playerRoute, machineRoute;
  
  public Game(){
    this.stage = 0;
    done = false;
    reading = false;
    way = new ArrayList<Integer[]>();
    playerRoute = new Route();
  }
  
  void display(){
    if (stage == 7) playerRoute.display(color(100, 100, 255, 230)); 
    else if (stage > 4) machineRoute.display();
    else 
      for (Integer i[] : way){
        int x = map.screenPosX(i[0]), y = map.screenPosY(i[1]);
        fill(100, 100, 255, 230);
        ellipse(x, y, tileSize/3, tileSize/3);
        if (way.indexOf(i) == way.size() - 1) trigger.drawX(x, y);
      }
    animation();
  }
  
  void start(){
    stage = 1;
    reading = true;
  }
  
  void addToRoute(Integer x, Integer y){
    Integer[] current = new Integer[]{x,y};
    Integer[] last = (way.isEmpty()) ? null : way.get(way.size()-1);
    if (reading)
      if (way.isEmpty())
        way.add(current);
      else if ( (abs(last[0] - current[0] ) == 0 && abs(last[1] - current[1] ) == 1) || (abs(last[0] - current[0] ) == 1 && abs(last[1] - current[1] ) == 0) ){
        way.add(current);
      }
    }
  
  void done(){
    stage = 2;
    done = true;
    reading = false;
    this.from = way.get(0);
    this.to = way.get(way.size() - 1);
    convertInRoute();
  }
  
  void getAlg(char c){
    machineRoute = playerRoute.clone(c);
    stage = 3;
    animation();
  }
  
  void convertInRoute(){
    playerRoute.onRoute = 1;
    playerRoute.getCoord(from[0], from[1]);
    playerRoute.onRoute = 2;
    playerRoute.getCoord(to[0], to[1]);
    playerRoute.traceRoute('0');
        
    for (Integer i[] : way){
        int vertice = playerRoute.getVertice(i[0], i[1]);
        playerRoute.path.add(vertice);
    }
    playerRoute.costCalculator();
  }
  
  void animation(){
    float time = frameCount/frameRate * 100;
    time = round(time/10);
    time /= 10;
    switch (stage){
      case 3:
        //delay(500);
        frameCount = 0;  
        playerRoute.makeWay();
        stage = 4;
        break;
      case 4: //player done
        playerRoute.time = time;
        if (player.stop){
          delay(200);
          stage = 5;
          frameCount = 0;
        }
        break;
      case 5:
        frameCount = 0;
        machineRoute.makeWay();
        stage = 6;
        break;
      case 6:
        machineRoute.time = time;
        if (player.stop){
          stage = 7;
          frameCount = 0;
        }
        break;
      case 7:
          stage = 8;
          if (frameCount >= 2){
            frameCount = 0;
            stage = 9;
          }
        break;
      case 8:
          stage = 7;
        break;
        
      case 9:
        int c;
        if (playerRoute.time < machineRoute.time) c = 1;
        else if (playerRoute.time > machineRoute.time) c = 2;
        else c = 3;
        result(c);
        if (frameCount/frameRate >= 3) off();
        break;
    }
  }
  
  void result(int c){
    String msg = "";
    color cor = color(0), cor2 = color(255);
      switch (c){
        case 1: 
          msg = "You Win!";
          cor = color(#238823);
          break;
        case 2:
          msg = "You Lose";
          cor = color(#D2222D);
          break;
        case 3:
          msg = "You Got It!";
          cor = color(#FFBF00);
          cor2 = color(0);
          break; 
      }
      fill(cor);
      rect(width*0.4,height*0.4,width/4,height/8, 10);
      fill(cor2);
      textSize(35);
      text(msg, width*0.48, height*0.48);
     
  }
  
  void off(){
    game = new Game(); 
  }
  
}
