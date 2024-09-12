class Map {
  boolean renderized;
  int chunkSize, tileSize;
  float offsetX, offsetY;
  HashMap<String, Chunk> chunks;
  
  boolean setBoat;

  Map(int chunkSize, int tileSize) {
    this.chunkSize = chunkSize;
    this.tileSize = tileSize;
    this.offsetX = 0;
    this.offsetY = 0;
    
    renderized = false;
    setBoat = true;
    
    chunks = new HashMap<String, Chunk>();
  }
  
  void display() {
    //noStroke();
    int startX = floor(-offsetX / chunkSize) - 1;
    int startY = floor(-offsetY / chunkSize) - 1;
    int endX = startX + ceil(width / chunkSize) + 10;
    int endY = startY + ceil(height / chunkSize) + 10;
  
    for (int x = startX; x < endX; x++) {
      for (int y = startY; y < endY; y++) {
        String key = x + "," + y;
        if (!chunks.containsKey(key)) {
          chunks.put(key, new Chunk(x, y));          
        }else renderized = true;
        chunks.get(key).display(offsetX, offsetY);
        //String myKey = "203,196";
        //if (renderized && chunks.containsKey(myKey)) Arrays.fill(chunks.get(myKey).tiles, new int[]{9,9,9,9,9}); // chunk rastreator
      }
    }
    if (this.setBoat) setBoat();
  }
  
  public void setBoat(){
      this.setBoat = true;
      while (setBoat){
        int pX = player.posX, pY = player.posY;
        PVector randGrid = new PVector((int)random(pX - (width/tileSize/2), pX + (width/tileSize/2)), (int)random(pY - (height/tileSize/2), pY + (height/tileSize/2.5)));
        
        Object [] ct = this.getChunkTile((int)randGrid.x, (int)randGrid.y);
        Chunk BoatChunk = chunks.get((String)ct[0]);
        PVector tile = (PVector) ct[1];
        
        // Caso densidade predominate agua repeat
        if (BoatChunk.density != 0){
          BoatChunk.beforeBoat = BoatChunk.tiles[(int)tile.x][(int)tile.y];
          BoatChunk.tiles[(int)tile.x][(int)tile.y] = 6;
          this.setBoat = false;
        }
      }
    }

  void drag(float _offsetX, float _offsetY) {
    if(this.gridPosX(0) < 0 || this.gridPosY(0) < 0){
      if(_offsetX <= 0 && _offsetY<=0){
            offsetX += _offsetX;
            offsetY += _offsetY;
      }
    }else{
      offsetX += _offsetX;
      offsetY += _offsetY;
    }
  }

  void reset() {
      offsetX = -width / 2;
      offsetY = -height / 2;
  }
  
  void reset(int gridX, int gridY) {
        offsetX = width / 2 - gridX * tileSize;
        offsetY = height / 2 - gridY * tileSize;
  }
  
  int gridPosX(int xScreen){
    return floor((-offsetX + xScreen) / tileSize);
  }
  
  int gridPosY(int yScreen){
    return floor((-offsetY + yScreen) / tileSize);
  }
  
  int screenPosX(int gridX) {
    return (gridX * tileSize + (int)offsetX) + tileSize/2;
  }
  
  int screenPosY(int gridY) {
    return (gridY * tileSize + (int)offsetY) + tileSize/2;
  }
  
  Object[] getChunkTile(int gridX, int gridY){
    int chunkX = floor(gridX * tileSize / (float) chunkSize);
    int chunkY = floor(gridY * tileSize / (float) chunkSize);
    String key = chunkX + "," + chunkY;
    
    if (!chunks.containsKey(key)) {
      chunks.put(key, new Chunk(chunkX, chunkY));
    }
    
      PVector tile = new PVector();
      tile.x = abs(gridX % (chunkSize / tileSize));
      tile.y = abs(gridY % (chunkSize / tileSize));
          
      return new Object[] {key, tile};
  }
  
  int getTileValue(int gridX, int gridY) {
      Object[] ct = getChunkTile(gridX, gridY);
      String key = (String)ct[0];
      PVector local = (PVector)ct[1];
      Chunk chunk = chunks.get(key);
      return chunk.getTile((int)local.x, (int)  local.y);
  }
  
  void begin(){
    for (int i = 0; i <= height; i++) {
      float inter = map(i, 0, height, 0, 1);  // Interpolação de 0 a 1
      color c = lerpColor(#77CAE3, #3934F5, inter);  // Calcula a cor intermediária
      stroke(c);
      line(0, i, width, i);  // Desenha uma linha vertical com a cor interpolada
    }    
    PImage img = loadImage("clt.png");
    PFont font = createFont("blood.otf", 30);
    int ts = 70;
    textFont(font);
    textSize(ts);
    fill(140,0,0);
    text("Estouradores DE CLT", (width-(ts*10))/2, (height-(ts*5))/4);
    img.resize(260, 320);
    image(img, width*0.42, height*0.25);
    textSize(50);
    fill(0);
    text("Press any KEY", width*.4, height*.7);
    
  }
  
}
