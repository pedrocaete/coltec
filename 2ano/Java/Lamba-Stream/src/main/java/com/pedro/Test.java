package com.pedro;

import com.pedro.DAO.*;
import com.pedro.classes.*;
import java.util.ArrayList;

public class Test {
    public static void main(String[] args) {
        SetupDatabase.CreteTables();

        BancoDAO.insert("BancoCaete", "1224444555");
        AgenciaDAO.insert("rua dos coquinhos 8899", 1);
        ClienteDAO.insert("Pedro", "123456789");
        ContaDAO.insert(1000, 500, 1);
        Cliente_ContaDAO.insert(1, 1);
        BancoDAO.insert("Banco do Brasil", "9876543210");
        AgenciaDAO.insert("Avenida Paulista 1234", 2);
        ClienteDAO.insert("Ana Costa", "987654321");
        Cliente_ContaDAO.insert(2, 2);
        AgenciaDAO.insert("Rua dos Bobos 0", 2);
        AgenciaDAO.insert("Rua dos Bobos 1", 2);
        ClienteDAO.insert("José", "45");
        ContaDAO.insert(100, 500, 2);
        ContaDAO.insert(10000, 12, 1);
        Cliente_ContaDAO.insert(2, 2);
        Cliente_ContaDAO.insert(3, 3);

        System.out.println("Agência encontrada por endereço 'Rua dos Bobos':");
        System.out.println(Gerente.getAgencyByAddress(AgenciaDAO.list(), "Rua dos Bobos"));

        System.out.println("\nContas com limite acima de 500:");
        System.out.println(Gerente.getAccountByLimitAbove(ContaDAO.list(), 500));

        System.out.println("\nContas com limite abaixo de 500:");
        System.out.println(Gerente.getAccountByLimitUnder(ContaDAO.list(), 500));

        System.out.println("\nContas com saldo positivo:");
        System.out.println(Gerente.getAccountsWithPostiveBalance(ContaDAO.list()));

        System.out.println("\nContas com saldo negativo:");
        System.out.println(Gerente.getAccountsWithNegativeBalance(ContaDAO.list()));
    }
}
