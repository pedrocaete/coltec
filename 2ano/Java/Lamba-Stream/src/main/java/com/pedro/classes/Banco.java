package com.pedro.classes;

import java.util.ArrayList;

public class Banco {
    int id;
    String nome;
    String cnpj;
    ArrayList<Agencia> agencias = new ArrayList<>();

    public int getId() {
        return id;
    }
    public void setId(int id) {
        this.id = id;
    }
    public String getNome() {
        return nome;
    }
    public void setNome(String nome) {
        this.nome = nome;
    }
    public String getCnpj() {
        return cnpj;
    }
    public void setCnpj(String cnpj) {
        this.cnpj = cnpj;
    }

    @Override
    public String toString() {
        return "Banco{id=" + id + ", nome='" + nome + "', cnpj='" + cnpj + "'}";
    }
}
