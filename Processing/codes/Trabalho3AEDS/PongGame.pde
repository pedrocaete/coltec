class PongGame {
  Bola bola;
  Raquete raqueteEsquerda, raqueteDireita;
  int pontosp1 = 0;
  int pontosp2 = 0;
  AgenteRL agenteRLDireita, agenteRLEsquerda;

  int quadroAtual;
  int quadroUltimaAcao;
  String estadoUltimaAcao;
  int ultimaAcao;

  PongGame() {
    bola = new Bola(width / 2, height / 2, 5, 5, 20);
    raqueteEsquerda = new Raquete(20, height / 2 - 40, 10, 80, 8);
    raqueteDireita = new Raquete(width - 30, height / 2 - 40, 10, 80, 8);
    agenteRLDireita = new AgenteRL(0.1, 0.99, 1.0, 0.01, 0.001);
    agenteRLEsquerda = new AgenteRL(0.1, 0.99, 1.0, 0.01, 0.001);
  }

  String obterEstadoRaqueteDireita() {
    int posRelativa = round((bola.posicaoY - raqueteDireita.posicaoY-40)); // Estado mais simples e relativo
    return posRelativa < 0 ? "acima" : (posRelativa > 0 ? "abaixo" : "alinhado");

  }

  String obterEstadoRaqueteEsquerda() {
    int posRelativa = round((bola.posicaoY - raqueteEsquerda.posicaoY-40)); // Estado mais simples e relativo
    return posRelativa < 0 ? "acima" : (posRelativa > 0 ? "abaixo" : "alinhado");
  }

  void qLearningDireita() {
    if (bola.velocidadeX > 0) {
      // Atualizar valor Q após a ação
      float recompensa;
      if (bola.colidirComRaquete(raqueteDireita)) {
        recompensa = 1;
      } else if (bola.posicaoX > width) {
        recompensa = - 100;
        //recompensa = - abs(raqueteDireita.posicaoY -  bola.posicaoY);
      } else recompensa = -1;

      String estadoAtual = obterEstadoRaqueteDireita();
      agenteRLDireita.atualizarValorQ(estadoUltimaAcao, ultimaAcao, recompensa);

      ultimaAcao = agenteRLDireita.escolherAcao(estadoAtual);
      if (ultimaAcao == 1) raqueteDireita.movimentar(1);
      else raqueteDireita.movimentar(-1);

      estadoUltimaAcao = estadoAtual;
      quadroUltimaAcao = quadroAtual;
    }
  }

  void qLearningEsquerda() {
    if (bola.velocidadeX < 0) {
      // Atualizar valor Q após a ação
      float recompensa;
      if (bola.colidirComRaquete(raqueteEsquerda)) {
        recompensa = 1;
      } else if (bola.posicaoX < 0) {
        recompensa = - 100;
        //recompensa = - abs(raqueteDireita.posicaoY -  bola.posicaoY);
      } else recompensa = -1;

      String estadoAtual = obterEstadoRaqueteEsquerda();
      agenteRLEsquerda.atualizarValorQ(estadoUltimaAcao, ultimaAcao, recompensa);

      ultimaAcao = agenteRLEsquerda.escolherAcao(estadoAtual);
      if (ultimaAcao == 1) raqueteEsquerda.movimentar(1);
      else raqueteEsquerda.movimentar(-1);

      estadoUltimaAcao = estadoAtual;
      quadroUltimaAcao = quadroAtual;
    }
  }

  void executar() {

    background(0);
    mostrarPlacar();

    bola.movimentar();
    bola.colidirComBorda();

    qLearningDireita();
    qLearningEsquerda();
    if (bola.colidirComRaquete(raqueteEsquerda) || bola.colidirComRaquete(raqueteDireita)) {
      bola.inverterDirecaoX();
    }

    if (bola.posicaoX < 0) {
      pontosp2++;
      reiniciarJogo();
    } else    if (bola.posicaoX > width) {
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
    bola.velocidadeX = random(3, 6) * (random(1) < 0.5 ? 1 : -1);
    bola.velocidadeY = random(3, 6) * (random(1) < 0.5 ? 1 : -1);
    raqueteEsquerda.posicaoY = height / 2 - raqueteEsquerda.altura / 2;
    raqueteDireita.posicaoY = height / 2 - raqueteDireita.altura / 2;
  }
}
