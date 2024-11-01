package com.pedro.classes;

import java.util.ArrayList;

public class Conta {
    int id;
    double limit;
    double balance;
    int idAgency;
    ArrayList<Cliente> cliente = new ArrayList<Cliente>();

    public int getId() {
        return id;
    }
    public void setId(int id) {
        this.id = id;
    }
    public double getLimit() {
        return limit;
    }
    public void setLimit(double limit) {
        this.limit = limit;
    }
    public double getBalance() {
        return balance;
    }
    public void setBalance(double balance) {
        this.balance = balance;
    }
    public int getIdAgency() {
        return idAgency;
    }
    public void setIdAgency(int idAgency) {
        this.idAgency = idAgency;
    }

    @Override
    public String toString() {
        return "Conta{id=" + id + ", limit=" + limit + ", balance=" + balance + ", idAgency=" + idAgency + "}";
    }
}
