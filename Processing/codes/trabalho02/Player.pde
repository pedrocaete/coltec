class Player{
  boolean stop;
  int moving;
  int posX, posY; //grid
  int posTile;
  float screenPosX, screenPosY;
  float vel;
  float offsetX, offsetY;
  ArrayList<Integer> allowedTiles, movs;
  boolean boat;
  
  public Player(){
    setPlayer();
    this.posTile = map.getTileValue(posX, posY);
    this.screenPosX = map.screenPosX(posX);
    this.screenPosY = map.screenPosX(posY);
    
    allowedTiles = new ArrayList<Integer>(Arrays.asList(1,2,6));
    movs = new ArrayList<Integer>();
    
    boat = false;
    stop = false;
    update();
  }
  
  void update(){
    this.display();
    
    this.screenPosX = map.screenPosX(posX);
    this.screenPosY = map.screenPosY(posY);

    posTile = map.getTileValue(posX, posY);
    if (movs !=null || moving != 0) movePlayer();
    if (map.renderized && allowedTiles.contains(posTile))
      if (!(route.onRoute > 0 && route.onRoute < 3)) this.checkEdges();
      switch (posTile){ //breca a verificação de chunkPlayer
        case 0:
          this.vel = 2;
          break;
          
        case 1:
          this.vel = 1;
          break;
          
        case 2:
          this.vel = 0.5;
          break;
          
        case 6:
          boat = true;
          allowedTiles.add(0);
          break;
      }
    }
    
    public void setPlayer(){
      while (true){
        PVector randPos = new PVector(int(random(1000)), int(random(1000)));

        Object [] ct = map.getChunkTile((int)randPos.x, (int)randPos.y);
        Chunk playerChunk = map.chunks.get((String)ct[0]);
        PVector tile = (PVector) ct[1];
        
        
        // Caso densidade > 50% repeat
        if (playerChunk.density != 0 && playerChunk.tiles[(int)tile.x][(int)tile.y] != 0){
          this.posX = (int)randPos.x;
          this.posY = (int)randPos.y;
          break;
        }
      }
    }
  
  void display(){
    fill(255,10,10);
    ellipse(map.screenPosX(posX) + offsetX, map.screenPosY(posY) + offsetY, tileSize*0.6, tileSize*0.6);
  }
  
  void move(ArrayList <Integer> movs){
    this.movs = movs;
    stop = false;
  }
  
  void checkEdges(){
    float v = (vel!=0.5) ? ceil(vel*velocidade*0.5) : floor(velocidade*0.5);
    if (this.screenPosY > height*0.7) map.drag(0,  -v);
    else if (this.screenPosY < height*0.3) map.drag(0, v);
    if (this.screenPosX > width*0.7) map.drag(-v, 0);
    else if (this.screenPosX < width*0.3) map.drag(v, 0); 
  }
  
  void dropBoat(){
    int [] dX = new int[] {1,-1,0,0};
    int [] dY = new int[] {0,0,-1,1};
    
    if (posTile != 0)
      for (int i=0; i<4; i++){
        int [] viz = new int [] {posX + dX[i], posY + dY[i]};
        int vizinhoTile = map.getTileValue(viz[0], viz[1]);
        if (vizinhoTile != 0){
          this.boat = false;
          this.allowedTiles.remove(Integer.valueOf(0));
          Object [] ct = map.getChunkTile(viz[0], viz[1]);
          String key = (String)ct[0];
          map.chunks.get(key).tiles[(int)((PVector)ct[1]).x][(int)((PVector)ct[1]).y] = 6;
          map.chunks.get(key).beforeBoat = vizinhoTile;
          break;
        }
      }
  }
  
  void move(int movs){
    if (moving == 0){
      this.movs = new ArrayList<Integer>(Arrays.asList(movs));
    }
    stop = false;
  }
  
  void movePlayer(){   
    if (moving == 0 && !movs.isEmpty()){
      moving = movs.get(0);
      movs.remove(0);
    }else if (moving == 0 && movs.isEmpty()) stop = true;
    float off = (vel/60) * tileSize * 2 * velocidade;
    switch (moving){
      case 1: //up
        offsetY -= off;
        break;
      case -1: //down
        offsetY += off;
        break;
      case 2: //left
        offsetX -= off;
        break;
      case -2: //right
        offsetX += off;
        break;
    }
    
    if (abs(offsetY) >= tileSize){
      int newY = posY += offsetY/abs(offsetY);
      if(allowedTiles.contains(map.getTileValue(posX, newY))) posY = newY;
      moving = 0;
      offsetY = 0;
    }
    
    if (abs(offsetX) >= tileSize){
      int newX = posX += offsetX/abs(offsetX);
      if(allowedTiles.contains(map.getTileValue(newX, posY))) posX = newX;
      moving = 0;
      offsetX = 0;
    }
    
  }
  
  void stop(){
    this.offsetX = (offsetX != 0) ? tileSize / (offsetX/abs(offsetX)): 0;
    this.offsetY = (offsetY != 0) ? tileSize / (offsetY/abs(offsetY)): 0;
    this.movs = new ArrayList<Integer>();
  }
  
}
