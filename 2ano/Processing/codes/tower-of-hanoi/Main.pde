import java.util.Stack;

PFont font;
PImage background;

Stack<Disc>[] tower = new Stack[3];
Pillar pillar[] = new Pillar[3];
Timer timer = new Timer();

int move = -1; //Allows the disc to follow the mouse
int referencedDisc = 0; 
int totalDiscs = 5;
float size = random (110, 135); //Size of the biggest disc
boolean win = false;
boolean menu = true;
boolean initialize = true; //To initialize the stack after the choice the TotalDiscs
String formatedMenu = String.format("TOWER SIZE + %d -", totalDiscs);

void setup() {
  size(600, 600);
  background = loadImage("visual_assets/Fundo.jpg");
  font = createFont("visual_assets/font.TTF",32);
  textFont(font);
  
  for (int i = 0; i < 3; i++) {
    tower[i] = new Stack<>();
    pillar[i] = new Pillar(i);
  }
}

void draw() {
  if (menu){
    initialMenu(); 
  }
  else{
    if(win == false){  
      game();
    }
    else{
      finalMenu();
    }
  }

  //Verify if the player wins
  if (tower[1].size() == totalDiscs || tower[2].size() == totalDiscs){
    win = true;  
  }
}



public void initialMenu(){
    //Interface of initial menu
    image(background, 0, 0, width, height);
    fill(255);
    textSize(40);
    text("PLAY", width/7, height/4);
    text("TOWER SIZE + " + totalDiscs, width/18, height/2.5);
    text("-",width/18 + 16.2 * textWidth(formatedMenu.charAt(15)), height/2.5);

    //Verify if the mouse is on the + button
    if (mouseX >= width/18 + 12 * textWidth(formatedMenu.charAt(12)) && mouseX <= width/18 + 13 * textWidth(formatedMenu.charAt(12)) &&
        mouseY >= height/2.5 - 40 && mouseY <= height/2.5) {
      fill(0,0,255);
      text("+",width/18 + 11.9 * textWidth(formatedMenu.charAt(12)), height/2.5 + 0.5);
    }
    
    //Verify if the mouse is on the - button
    if (mouseX >= width/18 + 16 * textWidth(formatedMenu.charAt(15)) && mouseX <= width/18 + 17 * textWidth(formatedMenu.charAt(15)) &&
        mouseY >= height/2.5 - 40 && mouseY <= height/2.5) {
      fill(0,0,255);
      text("-",width/18 + 16.25 * textWidth(formatedMenu.charAt(15)), height/2.5 + 0.5);
    }

    //Verify if the mouse is on the PLAY button
    if (mouseX >= width/7 && mouseX <= width/7 + 4* textWidth("Play".charAt(0)) &&
        mouseY >= height/4 - 40 && mouseY <= height/4) {
      fill(0,0,255);
      text("PLAY", width/7 + 0.5, height/4 + 0.5);
    }
}

public void finalMenu(){
      image(background, 0, 0, width, height);
      fill(20,255,20); 
      textAlign(CENTER);
      textSize(40);
      text("YOU WIN", width/2, height/3);
      textSize(20);
      fill(255);
      textAlign(RIGHT);
      text("TIME: " + timer.formatedTime, width/2, height/2.5);
}

public void game(){
      if (initialize) {
        for (int i = 0; i < totalDiscs; i++) {
          tower[0].push(new Disc(i,size));
        }
        initialize = false;
      }
      background(255);
      timer.show();
      timer.update();

      for (int i = 0; i < 3; i++) {
        pillar[i].show();
        for (Disc disc : tower[i])
          disc.show();
      }
      
      Disc d = tower[referencedDisc].peek();
      d.show();
      
      //To the disc follows the mouse after it is mousePressed
      if (move == 1) {
        d.xPos = mouseX - d.Width/2;
        d.yPos = mouseY - d.Height/2;
      }
}
public void moveDisc(){
  if (initialize == false){
    Disc d = tower[referencedDisc].peek(); //Disc that is been referenced
    Disc[] disc = new Disc[3];

    //Create a instance of peek disc for each tower
    for (int i = 0; i < 3; i ++){
      if (!tower[i].isEmpty()){
        disc[i] = tower[i].peek();
      }
      else{
        disc[i] = new Disc(size);
      }
    }

    //To the disc follows the mouse after it is mousePressed
    for (int i =0; i < 3; i ++){
      if (mouseX >= disc[i].xPos && mouseX <= disc[i].xPos + disc[i].Width &&
          mouseY >= disc[i].yPos && mouseY <= disc[i].yPos + disc[i].Height) {
        move = -move;
        referencedDisc = i;
        d = tower[referencedDisc].peek(); 
      }
    }

    //Repositions the disc after a click in a allowed local
    if (mouseX >= d.xPos && mouseX <= d.xPos + d.Width &&
        mouseY >= d.yPos && mouseY <= d.yPos + d.Height) {
      for (int i = 0; i < 3; i ++){
        if (move == -1 && mouseX >= pillar[i].xPos -30 && mouseX <= pillar[i].xPos + pillar[i].Width + 30 &&
            mouseY >= pillar[i].yPos && mouseY <= pillar[i].yPos + pillar[i].Height && d.Width <= disc[i].Width){
          tower[referencedDisc].pop();
          d.xPos = pillar[i].xPos - d.Width/2 + 5;
          d.yPos = height - (d.Height * (tower[i].size() + 1)) - 10;  
          disc[i] = tower[i].push(d); 
          referencedDisc = i;
        }
      }
    }
  }
}

public void changeTotalDiscs(){
  //Sums or diminishes the totalDiscs if the mouse is pressed on + or -
  if (mouseX >= width/18 + 12 * textWidth(formatedMenu.charAt(12)) && mouseX <= width/18 + 13 * textWidth(formatedMenu.charAt(12)) &&
      mouseY >= height/2.5 - 40 && mouseY <= height/2.5) {
    totalDiscs ++;
    text("+",width/18 + 11.9 * textWidth(formatedMenu.charAt(12)), height/2.5);
  }
  if (mouseX >= width/18 + 16 * textWidth(formatedMenu.charAt(15)) && mouseX <= width/18 + 17 * textWidth(formatedMenu.charAt(15)) &&
      mouseY >= height/2.5 - 40 && mouseY <= height/2.5) {
    totalDiscs --;
  }
}

public void startGame(){
  //Initiates the game with the play pressed
  if (mouseX >= width/7 && mouseX <= width/7 + 4* textWidth("Play".charAt(0)) &&
      mouseY >= height/4 - 40 && mouseY <= height/4) {
    menu = false;
  }
}

public void mousePressed(){  
  moveDisc();
  changeTotalDiscs();
  startGame();
}
