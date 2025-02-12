PongGame jogo;

void setup() {
  fullScreen();  // Abre o jogo em tela cheia
  jogo = new PongGame();
  background(0);

  //for (int i = 0; i < 100000; i++) {
  //  jogo.mostrarPlacar();

  //  jogo.bola.movimentar();
  //  jogo.bola.colidirComBorda();

  //  jogo.qLearningDireita();
  //  jogo.qLearningEsquerda();

  //  if (jogo.bola.colidirComRaquete(jogo.raqueteEsquerda) || jogo.bola.colidirComRaquete(jogo.raqueteDireita)) {
  //    jogo.bola.inverterDirecaoX();
  //  }

  //  if (jogo.bola.posicaoX < 0) {
  //    jogo.pontosp2++;
  //  } else    if (jogo.bola.posicaoX > width) {
  //    jogo.pontosp1++;

  //    jogo.reiniciarJogo();
  //  }
  //}
  jogo.reiniciarJogo();
  frameRate(350);
}

void draw() {
  jogo.executar();
}

void keyPressed() {
  if (key == 'r' || key == 'R') { // Verifica se a tecla pressionada é 'R' ou 'r'
    jogo.reiniciarJogo();
  }
}
