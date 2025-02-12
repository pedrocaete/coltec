class Bola {
  float posicaoX, posicaoY;
  float velocidadeX, velocidadeY;
  float tamanho;

  Bola(float x, float y, float velX, float velY, float tamanho) {
    this.posicaoX = x;
    this.posicaoY = y;
    this.velocidadeX = velX;
    this.velocidadeY = velY;
    this.tamanho = tamanho;
  }

  void movimentar() {
    posicaoX += velocidadeX;
    posicaoY += velocidadeY;
  }

  void inverterDirecaoX() {
    velocidadeX *= -1;
  }

  void colidirComBorda() {
    if (posicaoY <= 0 || posicaoY >= height) {
      velocidadeY *= -1;
    }
  }

  boolean colidirComRaquete(Raquete raquete) {
    return posicaoX >= raquete.posicaoX && posicaoX <= raquete.posicaoX + raquete.largura &&
           posicaoY >= raquete.posicaoY && posicaoY <= raquete.posicaoY + raquete.altura;
  }

  void mostrar() {
    fill(255);
    ellipse(posicaoX, posicaoY, tamanho, tamanho);
  }
}
