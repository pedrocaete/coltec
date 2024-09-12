int[][] grid;
int n = 100;

void setup(){
  size(600,600);
  frameRate(30);
  grid = createGrid();
 
}

int[][] createGrid(){
  int[][] m = new int[n][n];
  
  for(int i = 0; i < n; i++){
    for(int j = 0; j < n; j++){
      m[i][j] = (int) random (3);
    }
  }
  return m;
}

void showGrid(){
  float l = width/(float)n;
  float h = height/(float)n;
  
  for(int i = 0; i < n; i++){
    for(int j = 0; j < n; j++){
      stroke(200);
      if(grid[i][j] == 0)
      fill(255);
      else if(grid[i][j] == 1)
      fill(34,139,39);
      else
      fill(107,35,142);
      rect(j*l, i*h, l, h);
    }
  }
  
}

int livingNeighbors(int i, int j){
  int sum = 0;
  for(int ki = -1; ki < 2; ki++){
    for(int kj = -1; kj < 2; kj++){
      if(grid[i][j] == 1 && grid[(n+i+ki)%n][(n+j+kj)%n] == 1)
      sum += 1;
      if(grid[i][j] == 2 && grid[(n+i+ki)%n][(n+j+kj)%n] == 2)
      sum += 1;
    }
  }
    
  return sum - 1;
}

void updateGrid(){
  int[][] newGrid = new int[n][n];
  ArrayList<PVector> emptySpaces = findEmptySpaces();
  for(int i = 0; i < n; i++){
    for(int j = 0; j < n; j++){
      int neighbors = livingNeighbors(i,j);
      
      if(grid[i][j] != 0){
        if(neighbors < 4){
          
          if(emptySpaces.size() > 0){
            PVector randomEmptySpace = emptySpaces.get(int(random(emptySpaces.size())));
            newGrid[int(randomEmptySpace.x)][int(randomEmptySpace.y)] = grid[i][j];
            newGrid[i][j] = 0;
            emptySpaces.remove(randomEmptySpace);
            emptySpaces.add(new PVector(i,j));
            
          }
          else newGrid[i][j] = grid[i][j];
        }
        else newGrid[i][j] = grid[i][j];
      }
      
    }
  }
  
  grid = newGrid;
}

ArrayList<PVector> findEmptySpaces(){
  ArrayList<PVector> emptySpaces = new ArrayList<PVector>();
  for(int i = 0; i < n; i++){
    for(int j = 0; j < n; j++){
      if(grid[i][j] == 0)
        emptySpaces.add(new PVector(i,j));
      
    }
  }
  
  return emptySpaces;
}

void draw(){
  showGrid();
  updateGrid();
  
  if(mousePressed) grid = createGrid();
}
