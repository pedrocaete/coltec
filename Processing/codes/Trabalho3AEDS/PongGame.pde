class PongGame {
  Bola bola;
  Raquete raqueteEsquerda, raqueteDireita;
  int pontosp1 = 0;
  int pontosp2 = 0;
  AgenteRL agenteRL;

  int quadroAtual;
  int quadroUltimaAcao;
  String estadoUltimaAcao;
  int ultimaAcao;

  PongGame() {
    bola = new Bola(width / 2, height / 2, 5, 5, 20);
    raqueteEsquerda = new Raquete(20, height / 2 - 40, 10, 80, 8);
    raqueteDireita = new Raquete(width - 30, height / 2 - 40, 10, 80, 8);
    agenteRL = new AgenteRL(0.1, 0, 0.1, 0.01, 0.01);
  }

  String obterEstadoRaqueteDireita() {
    int bolaY = round(map(bola.posicaoY, 0, height, 0, 10));
    int raqueteY = round(map(raqueteDireita.posicaoY, 0, height, 0, 10));
    return bolaY + "," + raqueteY;
  }

  boolean raqueteDireitaAcertou() {
    return bola.posicaoX > width;
  }

  void qLearning() {
    // Atualizar valor Q após a ação
    float recompensa;
    if (raqueteDireitaAcertou()) {
      recompensa = 100;
    } else if (bola.posicaoX >= width) {
      recompensa = - abs(raqueteDireita.posicaoY -  bola.posicaoY);
    } else recompensa = -1;
    println(recompensa);

    String estadoAtual = obterEstadoRaqueteDireita();
    agenteRL.atualizarValorQ(estadoUltimaAcao, ultimaAcao, recompensa);

    ultimaAcao = agenteRL.escolherAcao(estadoAtual);
    if (ultimaAcao == 1) raqueteDireita.movimentar(1);
    else raqueteDireita.movimentar(-1);

    estadoUltimaAcao = estadoAtual;
    quadroUltimaAcao = quadroAtual;
  }

  void executar() {

    background(0);
    mostrarPlacar();

    bola.movimentar();
    bola.colidirComBorda();

    qLearning();

    if (/*bola.colidirComRaquete(raqueteEsquerda)*/bola.posicaoX < 0 || bola.colidirComRaquete(raqueteDireita)) {
      bola.inverterDirecaoX();
    }

    if (bola.posicaoX < 0) {
    pontosp2++;
    //  reiniciarJogo();
    }else    if (bola.posicaoX > width) {
      pontosp1++;
      reiniciarJogo();
    }

    raqueteEsquerda.movimentar('w', 's');
    raqueteDireita.movimentar(UP, DOWN);

    bola.mostrar();
    raqueteEsquerda.mostrar();
    raqueteDireita.mostrar();
  }

  void mostrarPlacar() {
    textSize(32);
    fill(255);
    textAlign(CENTER, TOP);
    text(pontosp1, width * 0.25, 40);
    text(pontosp2, width * 0.75, 40);
  }

  void reiniciarJogo() {
    bola.posicaoX = width / 2;
    bola.posicaoY = height / 2;
    //bola.velocidadeX = random(3, 6) * (random(1) < 0.5 ? 1 : -1);
    bola.velocidadeX = 10 * 1;
    bola.velocidadeY = 3 * 1;
    //bola.velocidadeY = random(3, 6) * (random(1) < 0.5 ? 1 : -1);
    raqueteEsquerda.posicaoY = height / 2 - raqueteEsquerda.altura / 2;
    raqueteDireita.posicaoY = height / 2 - raqueteDireita.altura / 2;
  }
}
