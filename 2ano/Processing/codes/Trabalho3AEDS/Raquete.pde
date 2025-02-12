class Raquete {
  float posicaoX, posicaoY;
  float largura, altura;
  float velocidade;

  Raquete(float x, float y, float largura, float altura, float velocidade) {
    this.posicaoX = x;
    this.posicaoY = y;
    this.largura = largura;
    this.altura = altura;
    this.velocidade = velocidade;
  }

  void movimentar(char teclaCima, char teclaBaixo) {
    if (keyPressed) {
      if (key == teclaCima) {
        posicaoY -= velocidade;
      } else if (key == teclaBaixo) {
        posicaoY += velocidade;
      }
    }
    posicaoY = constrain(posicaoY, 0, height - altura);
  }

  void movimentar(int teclaCima, int teclaBaixo) {
    if (keyPressed) {
      if (keyCode == teclaCima) {
        posicaoY -= velocidade;
      } else if (keyCode == teclaBaixo) {
        posicaoY += velocidade;
      }
    }
    posicaoY = constrain(posicaoY, 0, height - altura);
  }
  
  void movimentar(int direcao) {
      if (direcao == 1) {
        posicaoY -= velocidade;
      } else if (direcao == -1) {
        posicaoY += velocidade;
      }
    posicaoY = constrain(posicaoY, 0, height - altura);
  }

  void mostrar() {
    fill(255);
    rect(posicaoX, posicaoY, largura, altura);
  }
}
