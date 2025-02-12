import java.util.*;

boolean start = false;

final int chunkSize = 100;
final int tileSize = 20;
final int velocidade = 4;
int startPos;

boolean dragging = false;
int xT, yT; //cheat

Map map;
Trigger trigger;
Player player;
Route route;
Game game;

void setup() {
  //size(800, 800);
  fullScreen();
  startPos = int(random(1000, 10000));
  map = new Map(chunkSize, tileSize);
  player = new Player();
  route = new Route();
  trigger = new Trigger();
  game = new Game();
  map.reset(player.posX, player.posY);
}

void draw() {
  if (start){
    background(0);
    map.display();
    if (route != null) route.display();   
    trigger.display();
    game.display();
    player.update();
  }else map.begin();
}

void mouseDragged() {
    dragging = true;
    map.drag(mouseX - pmouseX, mouseY - pmouseY);
}

void mouseReleased() {
  if(!dragging){
    if (!start){
      start = true;
      textFont(createFont("cheese.ttf", 32));
    }
    if (trigger.btnTrigger(mouseX, mouseY));
    else{
      int xM = map.gridPosX(mouseX);
      int yM = map.gridPosY(mouseY);
      int v = map.getTileValue(xM, yM);
      xT = xM; yT = yM;
      if (player.allowedTiles.contains(v)){
        route.getCoord(xM, yM);
        game.addToRoute(xM,yM);
      }else if (route.onRoute > 0){
        println("Block not allowed! Try again");
        route.onRoute = 0;
      }
    
      String block = null;
      println("valor: " + xM + ", " + yM);
      switch(v) {
            case 0: // água
              block = "água";
              break;
            case 1: // grama
              block = "grama";
              break;
            case 2: // areia
              block = "areia";
              break;
            case 3: // coral
              block = "coral";
              break;
            case 4: // pedra
              block = "pedra";
              break;
            case 5: // cacto
              block = "cacto";
              break;
            case 6: // boat
              block = "boat";
              break;
      }
      if (route.onRoute == 2) trigger.origB = block;
      else if (route.onRoute == 3) trigger.destB = block;
      println(block);
    }
  }else dragging = false;
}

void keyPressed() {
  if (!start){
    start = true;
    textFont(createFont("cheese.ttf", 32));
  }
  if (key == 'r') if (route.onRoute == 0) route.onRoute = 1; else if (route.onRoute > 3) route.off(); else route.onRoute = 0; //choose route
  if (key == 'g' && route.onRoute == 3) route.onRoute = 4; //confirm points
  if (key == '5' && route.onRoute == 4)  route.traceRoute('d'); //choose algorithm
  if (key == '8' && route.onRoute == 4)  route.traceRoute('d');
  
  if (key == 'p' || key == 'P') map.reset(player.posX,player.posY); //centralize
  if (key == 't'){player.posY = yT; player.posX = xT;} //cheat
  
  if ((key == 'w' || key == 'W') && player.allowedTiles.contains(map.getTileValue(player.posX, player.posY-1))) player.move(1);
  if ((key == 's' || key == 'S') && player.allowedTiles.contains(map.getTileValue(player.posX, player.posY+1))) player.move(-1);
  if ((key == 'a' || key == 'A') && player.allowedTiles.contains(map.getTileValue(player.posX-1, player.posY))) player.move(2);
  if ((key == 'd' || key == 'D') && player.allowedTiles.contains(map.getTileValue(player.posX+1, player.posY))) player.move(-2);
  
  if (key == 'n' || key == 'N') if (player.boat) player.dropBoat();
  
  if (key == 'y' && game.reading) game.done();
  
  if (key == '*') setup();
}
