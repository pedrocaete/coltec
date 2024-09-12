class Chunk {
  int chunkX, chunkY;
  String key;
  int[][] tiles;
  int density; // Mostly 0, 1, 2 - water, grass, sand
  int beforeBoat; // tileValue before Boat

  Chunk(int x, int y) {
    this.chunkX = x;
    this.chunkY = y;
    this.key = x + "," + y;
    this.beforeBoat = int(random(1,3));
    this.density = 0;
    tiles = new int[chunkSize / tileSize][chunkSize / tileSize];
    generateChunk();
  }

  void generateChunk() {
    int [] count = new int[3];
    for (int x = 0; x < chunkSize / tileSize; x++) {
      for (int y = 0; y < chunkSize / tileSize; y++) {
        float noise = noise((chunkX * chunkSize + x * tileSize) * 0.002, (chunkY * chunkSize + y * tileSize) * 0.002);
        if (noise < 0.4) {
          count[0] ++;
          tiles[x][y] = 0; // água
        } else if (noise < 0.6) {
          count[1] ++;
          tiles[x][y] = 1; // grama
        } else {
          count[2] ++;
          tiles[x][y] = 2; // areia
        }

        if (random(1) < 0.005) {
          if (tiles[x][y] == 0) tiles[x][y] = 3; // coral
          else if (tiles[x][y] == 1) tiles[x][y] = 4; // pedra
          else if (tiles[x][y] == 2) tiles[x][y] = 5; // cacto
        }
      
      }
    }
    
    if (count[0] > count[1] && count[0] > count[2]) this.density = 0;
    else if (count[1] > count[2]) this.density = 1;
    else this.density = 2;
    
  }
  
  int getTile(int localX, int localY) {
    if (localX >= 0 && localX < tiles.length && localY >= 0 && localY < tiles[0].length) {
      return tiles[localX][localY];
    } else {
      return -1;
    }
  }

  void mark(){
    for (int i=0; i<chunkSize/tileSize; i++){
      for (int j=0; j<chunkSize/tileSize; j++){
        tiles[i][j] = 9;
      }
    }
  }

  void display(float offsetX, float offsetY) {
    noStroke();
    for (int x = 0; x < chunkSize / tileSize; x++) {
      for (int y = 0; y < chunkSize / tileSize; y++) {
        float screenX = chunkX * chunkSize + x * tileSize + offsetX;
        float screenY = chunkY * chunkSize + y * tileSize + offsetY;

        if (screenX + tileSize < 0 || screenX > width || screenY + tileSize < 0 || screenY > height) {
          continue;
        }

        switch(tiles[x][y]) {
          case 0: // água
            fill(#42a5f5);
            break;
          case 1: // grama
            fill(#99ff88);
            break;
          case 2: // areia
            fill(#ffd780);
            break;
          case 3: // coral
            fill(#BA14C6);
            break;
          case 4: // pedra
            fill(#a7b1c1);
            break;
          case 5: // cacto
            fill(#55cc44);
            break;
          case 6: // boat
            if(!player.boat) fill(151,51,0);
            else tiles[x][y] = this.beforeBoat;
            break;
          case 9:// black
            fill(0);
            break;
        }
        noStroke();
        rect(screenX, screenY, tileSize, tileSize);
      }
    }
  }
}
