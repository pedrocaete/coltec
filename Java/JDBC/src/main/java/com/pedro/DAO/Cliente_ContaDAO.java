package com.pedro.DAO;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;

import com.pedro.database.DatabaseConnection;

public class Cliente_ContaDAO {
    public static final int POSICAO_CONTA_ID = 1;
    public static final int POSICAO_CLIENTE_ID = 2;

    public static void insert(int accountID, int clientID) {
        String sql = "INSERT INTO cliente_conta (id_conta, id_cliente) VALUES (?, ?)";

        try (Connection conn = DatabaseConnection.getInstance().getConnection();
                PreparedStatement pstmt = conn.prepareStatement(sql)) {
            pstmt.setInt(POSICAO_CONTA_ID, accountID);
            pstmt.setInt(POSICAO_CLIENTE_ID, clientID);
            pstmt.executeUpdate();
        } catch (SQLException e) {
            throw new RuntimeException("Erro ao inserir cliente_conta: " + e.getMessage(), e);
        }
    }

    public static ArrayList<ArrayList<Integer>> list() {
        String sql = "SELECT * FROM cliente_conta";
        ArrayList<ArrayList<Integer>> cliente_conta = new ArrayList<ArrayList<Integer>>();

        try (Connection conn = DatabaseConnection.getInstance().getConnection();
                PreparedStatement pstmt = conn.prepareStatement(sql)) {
            ResultSet result = pstmt.executeQuery();
            int anteriorResult = -1;
            while (result.next()) {
                if (result.getInt(1) == anteriorResult) {
                    cliente_conta.get(result.getInt(1)).add(result.getInt(2));
                } else {
                    cliente_conta.add(new ArrayList<Integer>(result.getInt(2)));
                }
            }
            return cliente_conta;
        } catch (SQLException e) {
            throw new RuntimeException("Erro ao listar lotação cliente conta: " + e.getMessage(), e);
        }
    }

    public static void update(int accountID, int clientID) {
        String sql = "UPDATE cliente_conta SET id_conta = ?, id_cliente = ? WHERE id_conta = ? AND id_cliente = ?";

    }
}
