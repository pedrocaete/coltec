package com.pedro;

import com.pedro.DAO.*;
import com.pedro.classes.*;
import java.util.ArrayList;

public class Test{
    public static void main(String[] args) {
        // Chama o método list() da AgenciaDAO
        SetupDatabase.CreteTables();

        BancoDAO.insert("BancoCaete", "1224444555");
        AgenciaDAO.insert("rua dos coquinhos 8899", 1);
        ClienteDAO.insert("Pedro", "123456789");
        ContaDAO.insert(1000, 500, 1); 
        Cliente_ContaDAO.insert(1, 1);

        System.out.println("Banco\n");
        ArrayList<Banco> list = BancoDAO.list();
        System.out.println(list.toString());
        System.out.println("Agencia\n");
        ArrayList<Agencia> list2 = AgenciaDAO.list();
        System.out.println(list2.toString());
        System.out.println("Conta\n");
        ArrayList<Cliente> list3 = ClienteDAO.list();
        System.out.println(list3.toString());
        System.out.println("Conta\n");
        ArrayList<Conta> list4 = ContaDAO.list();
        System.out.println(list4.toString());
        System.out.println("Cliente_Conta\n");
        ArrayList<ArrayList<Integer>> list5 = Cliente_ContaDAO.list();
        System.out.println(list5.toString());

    }
}
