class Route{
  int onRoute; // Route status, 0 - off, 1 - ON, 2 - haveOrigin, 3 - haveDestiny, 4 - chose Dijstraka or A*, 5 - execute
  int lines, cols;
  int fromX, fromY, toX, toY; //Grid
  int startX, startY;
  int destinyV, originV;
  int verticesNum; //quantidade de blocos presentes na tela
  float[][] adjMatrix;
  ArrayList<Integer> path;
  float cost, time;
  char alg;
  
  public Route(){
    this.path = new ArrayList<Integer>();
    this.onRoute = 0;
    this.cost = 0;
  }
  
   void traceRoute(char m){
     float range = 0.5;
       do{
        setLimits(range);
        setAdjMatrix();
        generateAdjMatrix();
        this.alg = m;
        if (alg == 'a') aStar();
        if (alg == 'd') dijstraka();
        range += 0.5;
       }while (path.isEmpty() && range < 5 && m != '0');
     costCalculator();
  }
  
  Route clone(char c){
    Route r = new Route();
    
    r.fromX = fromX;
    r.fromY = fromY;
    r.toX = toX;
    r.toY = toY;
    
    r.traceRoute(c);
    
    return r;
  }
  
  void getCoord(int x, int y){
    if (onRoute == 1){
      fromX = x;
      fromY = y;
      player.posX = x;
      player.posY = y;
      onRoute = 2;
    }else if ( onRoute == 2 || onRoute == 3){
      toX = x;
      toY = y;
      onRoute = 3;
      //map.reset(int((fromX+toX)/2), int((fromY+toY)/2));
    }
  }
  
  void setLimits(float r){
    int minRange = int((chunkSize/tileSize) * r);
    this.startX = (fromX <= toX) ? fromX - minRange : toX - minRange;
    int lastX = (fromX <= toX) ? toX + minRange : fromX + minRange;
    
    this.startY = (fromY <= toY) ? fromY - minRange : toY - minRange;
    int lastY = (fromY <= toY) ? toY + minRange : fromY + minRange;
    
    this.cols = lastX - this.startX;
    this.lines = lastY - this.startY;
    this.verticesNum = this.lines * this.cols;
  }
  
  int getVertice(int gridX, int gridY){
    return  (gridX - startX) + ((gridY - startY)*cols);
  }
  
  int getGridX(int vertice){
    return startX + vertice%cols;
  }
  
  int getGridY(int vertice){
    return startY + int(vertice/cols);
  }
  
  void setAdjMatrix(){
    this.adjMatrix = new float[verticesNum][verticesNum];
    this.originV = getVertice(fromX, fromY);
    this.destinyV = getVertice(toX, toY);
  }
  
  void generateAdjMatrix(){    
    for (int i=0; i<verticesNum; i++){
      for (int j=0; j<verticesNum; j++){
        float vi = map.getTileValue(getGridX(i), getGridY(i));
        float vj = map.getTileValue(getGridX(j), getGridY(j)); //cálculo para obter elemento em grid a partir de um valor iterador
        vi = (vi==6) ? 1 : vi;
        vj = (vj==6) ? 1 : vj;
        if (((abs(getGridX(i) - getGridX(j)) == 1 && getGridY(i) - getGridY(j) == 0) || (abs(getGridY(i) - getGridY(j)) == 1 && getGridX(i) - getGridX(j) == 0) ) && adjMatrix[i][j]==0 && (player.allowedTiles.contains(int(vi)) && player.allowedTiles.contains(int(vj)))){ //ligação entre mesmo elemento, vizinhos, se for agua tem q ter barco
          adjMatrix[i][j] = ((vi + vj) / 2) + 1; //média dos pesos de dois vértices gera peso de aresta, TileValue+1
          adjMatrix[j][i] = adjMatrix[i][j];        
        }
      }
    }
  }
  
  float costCalculator(){
    int current, past = originV;
    for (int i : path){
      //println(0, i);
      current = i;
      try{
        this.cost += adjMatrix[current][past];
      }catch(Exception e){
        
      }
      past = i;
    }
    return cost;
  }

  void dijstraka(){
    float [] dist = new float[verticesNum];
    int [] anterior = new int[verticesNum]; 
    Arrays.fill(dist, Float.POSITIVE_INFINITY); 
    Arrays.fill(anterior, -1);

    dist[originV] = 0;
    float[] Q = new float[verticesNum];
    
    done: for (int k = 0; k<verticesNum; k++){
      int u=-1;
      float udist = Float.POSITIVE_INFINITY;
      
      for (int v = 0; v < verticesNum; v++){
        if(Q[v] == 0 && dist[v] < udist){
          u = v;
          udist = dist[v];
        }
      }
      
      u = abs(u);
      
      Q[u] = 1;
      for (int v = 0; v < verticesNum; v++){
        if(u==v || adjMatrix[u][v] == 0) continue;
        
        float alt  = udist + adjMatrix[u][v];
        
        if(alt < dist[v]){
          dist[v] = alt;
          anterior[v] = u;
          
       if (v == destinyV){
        while (v != -1){
          path.add(v);
          v = anterior[v];
        }
        Collections.reverse(path);
        break done;
      } 
          
        }
      }
    }
  }
  
  void aStar() {
        // lista aberta
        PriorityQueue<float[]> queue = new PriorityQueue<>(Comparator.comparingDouble(a -> a[0]));
        queue.add(new float[]{0, originV});

        float[] dist = new float[verticesNum];
        int[] anterior = new int[verticesNum];
        Arrays.fill(dist, Float.POSITIVE_INFINITY);
        Arrays.fill(anterior, -1);
        
        dist[originV] = 0;
        
        done: while (!queue.isEmpty()) {
            // pega o vertice da queue com menor dist (vertice, dist)
            float[] current = queue.poll();
            int currentNode = (int) current[1];

            // chegou no destinyV
            if (currentNode == destinyV) {
                while (currentNode != -1) {
                    path.add(currentNode);
                    currentNode = anterior[currentNode];
                }
                Collections.reverse(path);
                break done;
            }

            // marca na lista "fechada"
            dist[currentNode] = current[0];

            // itera sobre vizinhos do nó atual
            for (int neighbor = 0; neighbor < verticesNum; neighbor++) {
                if (adjMatrix[currentNode][neighbor] > 0) { // se tiver conexão
                    // calcula tentativa do vizinho até origem, atualDist mais distAtéVizinho
                    float tentativedist = current[0] + adjMatrix[currentNode][neighbor];

                    // se tentativa for menor que vizinhoDist (até origem) atualize
                    if (tentativedist < dist[neighbor]) {
                        dist[neighbor] = tentativedist;
                        anterior[neighbor] = currentNode;
                        // euclidian heuristic
                        queue.add(new float[]{tentativedist + sqrt(pow(getGridX(neighbor) - getGridX(destinyV), 2) + pow(getGridY(neighbor) - getGridY(destinyV),2)), neighbor});
                    }
                }
            }
        }
    }

  void display(){
    fill(255, 100, 100, 230);
    trigger.drawX(map.screenPosX(toX), map.screenPosY(toY));
    for (int i : path){
      if (i!=destinyV) ellipse(map.screenPosX(getGridX(i)), map.screenPosY(getGridY(i)), tileSize/3, tileSize/3);
    }
  }
  
  void display(color c){
    fill(c);
    trigger.drawX(map.screenPosX(toX), map.screenPosY(toY));    
    for (int i : path){
      if (i!=destinyV) ellipse(map.screenPosX(getGridX(i)), map.screenPosY(getGridY(i)), tileSize/3, tileSize/3);
    }
  }
  
  void makeWay(){
    ArrayList<Integer> movs = new ArrayList<>();
    int m=0;
    for (int i=0; i < path.size(); i++){
      int nowX = getGridX(path.get(i)), nowY = getGridY(path.get(i));
      int lastX = (i > 0) ? getGridX(path.get(i-1)) : -1, lastY = (i > 0) ? getGridY(path.get(i-1)) : 0;
      if (lastX == nowX) m = lastY - nowY;
      else if (lastY == nowY) m = (lastX - nowX) * 2;
      if (i > 0) movs.add(m);
    }
    player.posX = fromX;
    player.posY = fromY;
    player.move(movs);
  }
  
    
  void off(){
    player.stop();
    route = new Route();
    game.playerRoute = new Route();  
    println("OffRoute");
  }
  
}
