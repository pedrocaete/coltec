package com.pedro.classes;

import java.util.ArrayList;

public class Agencia {
    int id;
    int idBank;
    String address;
    ArrayList<Conta> contas = new ArrayList<Conta>();
    
    public int getId() {
        return id;
    }
    public void setId(int id) {
        this.id = id;
    }
    public int getIdBank() {
        return idBank;
    }
    public void setIdBank(int idBank) {
        this.idBank = idBank;
    }
    public String getAddress() {
        return address;
    }
    public void setAddress(String address) {
        this.address = address;
    }

    @Override
    public String toString() {
        return "Agencia{id=" + id + ", idBank=" + idBank + ", address='" + address + "'}";
    }
}
