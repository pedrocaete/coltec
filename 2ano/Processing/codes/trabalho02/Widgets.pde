public class Trigger { //<>//
    private String origB, destB;
    private float startX, largBloco, altBloco;
    private float startX1 = 10, startY = 10;
    private float largBloco1 = width/2 - startX1, altBloco1 = 60;
    private float largBloco2 = 54, altBloco2 = 54;

    private void display() {
      if (route.onRoute > 0){
        if (route.onRoute >=3) drawX(map.screenPosX(route.toX), map.screenPosY(route.toY));
          switch (route.onRoute) {
              case 3:
                  goBtn();
                  routeInfo();
                  break;
              case 4:
                  aStarBtn();
                  dijstrakaBtn();
                  break;
              case 5:
                  stopBtn();
                  simulateBtn();
                  break;
              default:
                routeInfo();
          }
      }else if (game.stage > 0){
        switch (game.stage){
          case 1:
            gameInst();
            goBtn();
            break;
          case 2:
            gameInfo();
            aStarBtn();
            dijstrakaBtn();
            break;
          case 4:
            timer(game.playerRoute);
            break;
          case 6:
            timer(game.machineRoute);
            break;
          case 7:
            timer(game.playerRoute);
            delay(1500);
            break;
          case 8:
            timer(game.machineRoute);
            delay(1500);
            break;
          
        }
      }else if (route.onRoute == 0 && game.stage == 0) {
        routeBtn();
        gameBtn();
       }
    }

    public boolean btnTrigger(int x, int y) {
      if (route.onRoute > 0){
          switch (route.onRoute) {
              case 3:
                  if (goBtnV(x, y)) {
                      route.onRoute = 4;
                      return true;
                  }
                  break;
              case 4:
                  if (aStarBtnV(x, y)) {
                      route.traceRoute('a');
                      route.onRoute = 5;
                      return true;
                  } else if (dijstrakaBtnV(x, y)) {
                      route.traceRoute('d');
                      route.onRoute = 5;
                      return true;
                  }
                  break;
              case 5:
                  if (stopBtnV(x, y)) {
                      route.off();
                      return true;
                  } else if (simulateBtnV(x, y)) {
                      route.makeWay();
                      return true;
                  }
                  break;
          }
      }else if(game.stage > 0){
        switch(game.stage){
          case 1:
            if (goBtnV(x, y)) {
              if(!game.way.isEmpty()) game.done();
              return true;
            }
            break;
          case 2:
            if (aStarBtnV(x, y)){
              game.getAlg('a');
              return true;
            }else if (dijstrakaBtnV(x, y)){
              game.getAlg('d');
              return true;
            }
            break;
          
        }
      }else if(game.stage + route.onRoute == 0){
        if (routeBtnV(x, y)) {
          println("route.onRoute");
          route.onRoute = 1;
          return true;
        }else if(gameBtnV(x, y)){
          println("GAME TIME");
          game.start();
          return true;
        }  
      }
        return false;
    }
    
    private void gameBtn() {
        startX = width/2 + startX1;
        largBloco = largBloco1 - startX1;
        altBloco = altBloco1;
        drawButton("Game", color(70, 220, 78), startX + largBloco * 0.45, altBloco * 0.8);
    }

    private void routeBtn() {
        startX = startX1;
        largBloco = largBloco1;
        altBloco = altBloco1;
        drawButton("Waze", color(78, 180, 220), startX + largBloco * 0.4, altBloco * 0.8);
    }

    private void simulateBtn() {
        startX = startX1;
        largBloco = largBloco1;
        altBloco = altBloco1;
        drawButton("Simulate route", color(150, 150, 250), startX + largBloco * 0.25, altBloco * 0.8);
    }

    private void goBtn() {
        largBloco = largBloco2;
        altBloco = altBloco2;
        startX = width - largBloco*1.2;
        drawButton("GO", color(50, 150, 50), startX + largBloco * 0.2, altBloco * 0.85);
    }

    private void stopBtn() {
        largBloco = tileSize * 5;
        altBloco = altBloco2;
        startX = width - largBloco*1.1;
        drawButton("STOP", color(150, 50, 50), startX + largBloco * 0.2, altBloco * 0.85);
    }

    private void aStarBtn() {
        largBloco = largBloco2;
        altBloco = altBloco2;
        startX = width - largBloco*1.2;
        drawButton("A*", color(255, 150, 50), startX + largBloco * 0.3, altBloco * 0.8);
    }

    private void dijstrakaBtn() {
        largBloco = tileSize * 6;
        altBloco = altBloco2;
        startX = width - largBloco*2;
        drawButton("Dijstraka", color(50, 150, 50), startX + largBloco * 0.1, altBloco * 0.8);
    }

    private void drawButton(String text, color c, float txtX, float txtY) {
        fill(c, 230);
        rect(startX, startY, largBloco, altBloco, 10);
        fill(0);
        textSize(27);
        text(text, txtX, txtY);
    }

    private void routeInfo() {
        String start = (String.format("(%d, %d) - %s", route.fromX, route.fromY, origB));
        String goal = (String
        .format("(%d, %d) - %s", route.toX, route.toY, destB));
        startX = startX1;
        largBloco = 260;
        altBloco = 80;
        drawButton(start + "\n" + goal, color(220, 180, 78), startX*3, altBloco * 0.5);
    }
    
    private void timer(Route r){
      
      if (r.alg == 'a' || r.alg == 'd') machineInfo();
      else playerInfo();
      
        startX = startX1;
        largBloco = largBloco1*0.4;
        altBloco = altBloco1;
        drawButton(str(r.time), color(150, 150, 250), startX + largBloco * 0.2, altBloco * 0.8);
      
    }
    
    private void gameInfo() {
        startX = startX1;
        largBloco = largBloco1*0.4;
        altBloco = altBloco1;
        drawButton("PLAYER 1: ", color(150, 150, 250), startX*1.35 + largBloco * 0.2, altBloco * 0.8);
        playerInfo();
        startX += largBloco*1.55;
        fill(230, 230, 0);
        rect(startX, altBloco*1.15, 54, -54);
        fill(100, 0, 100);
        text("VS", startX*1.02, altBloco*0.85);
        startX *= 1.35;
        largBloco = largBloco1*0.4;
        drawButton("PLAYER 2: ", color(150, 150, 250), startX*1.15, altBloco * 0.8);
    }
    
    private void playerInfo(){
      startX = startX*1.8 + largBloco;
      largBloco *=0.5;
      drawButton("You", color(150, 250, 250), startX + largBloco * 0.3, altBloco * 0.8);
    }
    
    private void machineInfo(){
      startX = startX*1.8 + largBloco;
      largBloco *=1;
      drawButton("Machine", color(255, 150, 50), startX + largBloco * 0.2, altBloco * 0.8);

    }
    
    private void gameInst(){
        startX = width/4;
        largBloco = largBloco1;
        altBloco = altBloco1;
        drawButton("Selecione sua rota ideal, bloco por bloco!", color(#CCF8FA), startX*1.05 + largBloco * 0.2, altBloco * 0.8);
    }
    
    private boolean gameBtnV(int x, int y) {
        return isWithinBounds(x, y, width/2 + startX1, largBloco1 - startX1, altBloco1);
    }

    private boolean routeBtnV(int x, int y) {
        return isWithinBounds(x, y, startX1, largBloco1, altBloco1);
    }

    private boolean simulateBtnV(int x, int y) {
        return isWithinBounds(x, y, startX1, largBloco1, altBloco1);
    }
    private boolean goBtnV(int x, int y) {
        return isWithinBounds(x, y, width - (20 * 3.25), largBloco2, altBloco2);
    }

    private boolean stopBtnV(int x, int y) {
        return isWithinBounds(x, y, width - (tileSize * 5.5), tileSize * 5, altBloco2);
    }

    private boolean aStarBtnV(int x, int y) {
        return isWithinBounds(x, y, width - (20 * 3.25), largBloco2, altBloco2);
    }

    private boolean dijstrakaBtnV(int x, int y) {
        return isWithinBounds(x, y, width - (tileSize*12), tileSize * 6, altBloco2);
    }

    private boolean isWithinBounds(int x, int y, float startX, float largBloco, float altBloco) {
        float endX = startX + largBloco;
        float endY = startY + altBloco;
        return x > startX && x < endX && y > startY && y < endY;
    }
    
    void drawX(int screenX, int screenY){
      //fill(255,0,0);
      float xCenter = screenX;
      float yCenter = screenY;
      float rectWidth = tileSize/3;
      float rectHeight = tileSize;
      pushMatrix();
      translate(xCenter, yCenter);
      rotate(radians(45));
      rect(-rectWidth/2, -rectHeight/2, rectWidth, rectHeight);
      popMatrix();
      
      // Desenhar segunda linha diagonal do X
      pushMatrix();
      translate(xCenter, yCenter);
      rotate(radians(-45));
      rect(-rectWidth/2, -rectHeight/2, rectWidth, rectHeight);
      popMatrix();
  }
}
