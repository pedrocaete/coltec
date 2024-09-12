import java.util.HashSet;
import java.util.Map;
import java.util.Set;

// Definição da classe Grafo
class Grafo {
  int numVertices;
  HashMap<PVector, Integer> arestas = new HashMap<PVector, Integer>();
  PVector[] posicoes; // Posições das partículas (nós do grafo)
  PVector[] velocidades; // Velocidades das partículas
  float raio = 10; // Raio dos nós
  float k = 0.00005; // Constante da mola para a atração
  float c = 150; // Constante de repulsão
  ArrayList<Integer> coresReais;

  // Construtor da classe Grafo
  Grafo(int numVertices) {
    int[][] adj = new int[numVertices][numVertices];

    for (int i = 0; i < numVertices; i++)
      for (int j = 0; j < numVertices; j++) {
        if (i == j) {
          adj[i][j] = 0;
        } else {
          if (random(1) > 0.5) {
            arestas.put(new PVector(i, j), (int) random(1, 5)) ;
            arestas.put(new PVector(j, i), arestas.get(new PVector(i, j)));
          }
        }
      }
    this.numVertices = numVertices;
    posicoes = new PVector[numVertices];
    velocidades = new PVector[numVertices];
    inicializarPosicoes();
  }

  // Adiciona uma aresta entre dois vértices
  void adicionarAresta(int i, int j) {
    arestas.put(new PVector(i, j), 1);
    arestas.put(new PVector(j, i), 1);
  }

  // Adiciona uma aresta entre dois vértices
  void adicionarAresta(int i, int j, int peso) {
    arestas.put(new PVector(i, j), peso);
    arestas.put(new PVector(j, i), peso);
  }

  // Inicializa as posições das partículas em um círculo
  void inicializarPosicoes() {
    float angulo = TWO_PI / (numVertices - 1);
    float raioCirculo = min(width, height) / 3;
    for (int i = 1; i < numVertices; i++) {
      float x = width / 2 + raioCirculo * cos((i - 1) * angulo);
      float y = height / 2 + raioCirculo * sin((i - 1) * angulo);
      posicoes[i] = new PVector(x, y);
      velocidades[i] = new PVector(0, 0);
    }
    // Posição fixa do vértice 0
    posicoes[0] = new PVector(width / 2, height / 2);
    velocidades[0] = new PVector(0, 0);
  }

  // Atualiza as posições das partículas
  void atualizar() {
    for (PVector aresta : arestas.keySet()) {
      PVector forca = new PVector(0, 0);
      int arestaOrigem = (int) aresta.x;
      int arestaDestino = (int) aresta.y;

      // Força de repulsão
      if (aresta.x != aresta.y) {
        PVector direcao = PVector.sub(posicoes[arestaOrigem], posicoes[arestaDestino]);
        float distancia = direcao.mag();
        if (distancia > 0) {
          direcao.normalize();
          float forcaRepulsao = c / (distancia * distancia);
          direcao.mult(forcaRepulsao);
          forca.add(direcao);
        }
      }

      // Força de atração
      PVector direcao = PVector.sub(posicoes[arestaDestino], posicoes[arestaOrigem]);
      float distancia = direcao.mag();
      direcao.normalize();
      float forcaAtracao = k * (distancia - raio);
      direcao.mult(forcaAtracao);
      forca.add(direcao);


      velocidades[arestaOrigem].add(forca);
      posicoes[arestaOrigem].add(velocidades[arestaOrigem]);

      // Reduz a velocidade para estabilizar a simulação
      velocidades[arestaOrigem].mult(0.5);

      // Mantém as partículas dentro da tela
      if (posicoes[arestaOrigem].x < 0 || posicoes[arestaOrigem].x > width) velocidades[arestaOrigem].x *= -1;
      if (posicoes[arestaOrigem].y < 0 || posicoes[arestaOrigem].y > height)velocidades[arestaOrigem].y *= -1;
    }
  }

  // Desenha o grafo
  void desenhar(int[] cores) {
    textAlign(CENTER);
    // Desenha as arestas
    strokeWeight(1);
    for (Map.Entry<PVector, Integer> aresta : arestas.entrySet()) {
      int arestaOrigem = (int) aresta.getKey().x;
      int arestaDestino = (int) aresta.getKey().y;
      stroke(0);
      strokeWeight(aresta.getValue());
      if (aresta.getValue() > 0) line(posicoes[arestaOrigem].x, posicoes[arestaOrigem].y, posicoes[arestaDestino].x, posicoes[arestaDestino].y);
    }

    // Desenha os nós
    fill(255);
    strokeWeight(1);
    for (PVector aresta : arestas.keySet()) {
      int arestaOrigem = (int) aresta.x;
      fill(coresReais.get(cores[arestaOrigem]));
      ellipse(posicoes[arestaOrigem].x, posicoes[arestaOrigem].y, raio * 2, raio * 2);
      fill(0);
      text(str(arestaOrigem), posicoes[arestaOrigem].x, posicoes[arestaOrigem].y+4);
    }
  }

  int[] colorirGrafo() {
    int n = numVertices;
    int cores[] = new int[n];
    boolean coresDisponiveis[] = new boolean[n];
    HashSet<Integer> coresUtilizadas = new HashSet<Integer>();

    for (int i = 0; i < n; i ++) {
      cores[i] = 0;
      coresDisponiveis[i] = true;
    }

    for (int v = 0; v < n; v ++) {
      for (int u = 0; u < n; u ++) {
        if (cores[u] != 0 && arestas.containsKey(new PVector(v, u))) {
          coresDisponiveis[cores[u]] = false;
        }
      }


      for (int cor = 1; cor < n; cor++) {
        if (coresDisponiveis[cor] == true) {
          cores[v] = cor;
          break;
        }
      }

      for (int i = 1; i < n; i ++) {
        coresDisponiveis[i] = true;
      }
    }

    while (coresUtilizadas.size() <= cores.length) {
      int corReal = color(random(0, 255), random(0, 255), random(0, 255));
      coresUtilizadas.add(corReal);
    }
    coresReais = new ArrayList<Integer>(coresUtilizadas);
    return cores;
  }
}
