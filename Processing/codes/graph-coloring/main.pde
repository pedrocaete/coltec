Grafo grafo;
int[] cores;
void setup() {
  size(800, 600);
  frameRate(60);
  
  grafo = new Grafo(6);
  cores = grafo.colorirGrafo();
}
  

void draw(){
  background(255);
  grafo.atualizar();
  grafo.desenhar(cores);
}
