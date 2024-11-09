PongGame jogo;

void setup() {
  fullScreen();  // Abre o jogo em tela cheia
  jogo = new PongGame();
  jogo.reiniciarJogo();
  frameRate(250);
}

void draw() {
  jogo.executar();
}
