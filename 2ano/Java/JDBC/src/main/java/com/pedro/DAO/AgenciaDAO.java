package com.pedro.DAO;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;

import com.pedro.classes.Agencia;

import com.pedro.DAO.Exceptions.IdInexistenteException;
import com.pedro.database.DatabaseConnection;

public class AgenciaDAO {
    private final static int POSICAO_ADDRESS = 1;
    private final static int POSICAO_BANKID = 2;

    public static void insert(String address, int bankID) {
        String sql = "INSERT INTO agencia (endereco, id_banco) VALUES (?, ?)";
        try (Connection conn = DatabaseConnection.getInstance().getConnection();
                PreparedStatement pstmt = conn.prepareStatement(sql)) {
            pstmt.setString(POSICAO_ADDRESS, address);
            pstmt.setInt(POSICAO_BANKID, bankID);
            pstmt.executeUpdate();
        } catch (SQLException e) {
            throw new RuntimeException("Erro ao inserir agencia: " + e.getMessage(), e);
        }
    }

    public static int getBankID(int id) throws IdInexistenteException {
        if (verifyID(id)) {
            String sql = "SELECT id_banco FROM agencia WHERE id = ?";

            try (Connection conn = DatabaseConnection.getInstance().getConnection();
                    PreparedStatement pstmt = conn.prepareStatement(sql)) {
                pstmt.setInt(1, id);
                ResultSet result = pstmt.executeQuery();
                return result.getInt(1);
            } catch (SQLException e) {
                throw new RuntimeException("Erro ao obter id do banco relacionado a esta agência: " + e.getMessage(),
                        e);
            }
        } else {
            throw new IdInexistenteException(id);
        }
    }

    public static String getAddress(int id) throws IdInexistenteException {
        if (verifyID(id)) {
            String sql = "SELECT endereco FROM agencia WHERE id = ?";

            try (Connection conn = DatabaseConnection.getInstance().getConnection();
                    PreparedStatement pstmt = conn.prepareStatement(sql)) {
                pstmt.setInt(1, id);
                ResultSet result = pstmt.executeQuery();
                return result.getString(1);
            } catch (SQLException e) {
                throw new RuntimeException("Erro ao obter id do banco relacionado a esta agência: " + e.getMessage(),
                        e);
            }
        }
        throw new IdInexistenteException(id);
    }

    public static void updateAddress(int id, String address) throws IdInexistenteException {
        if (verifyID(id)) {
            String sql = "UPDATE agencia SET address = ? WHERE id = ?";

            try (Connection conn = DatabaseConnection.getInstance().getConnection();
                    PreparedStatement pstmt = conn.prepareStatement(sql)) {
                pstmt.setString(1, address);
                pstmt.setInt(2, id);
                ResultSet result = pstmt.executeQuery();
            } catch (SQLException e) {
                throw new RuntimeException("Erro ao alterar endereço: " + e.getMessage(), e);
            }
        }
        throw new IdInexistenteException(id);
    }

    public static void updateBankID(int id, int bankID) throws IdInexistenteException {
        if (verifyID(id)) {
            String sql = "UPDATE agencia SET id_banco = ? WHERE id = ?";
             
            try (Connection conn = DatabaseConnection.getInstance().getConnection();
                    PreparedStatement pstmt = conn.prepareStatement(sql)) {
                pstmt.setInt(1, bankID);
                pstmt.setInt(2, id);
                ResultSet result = pstmt.executeQuery();
            } catch (SQLException e) {
                throw new RuntimeException("Erro ao alterar id do banco: " + e.getMessage(), e);
            }
        }
        throw new IdInexistenteException(id);
    }

    public static ArrayList<Agencia> list(){
        String sql = "SELECT * FROM agencia";
        ArrayList<Agencia> agencias = new ArrayList<>();

        try (Connection conn = DatabaseConnection.getInstance().getConnection();
                PreparedStatement pstmt = conn.prepareStatement(sql)) {
            ResultSet result = pstmt.executeQuery();
            while (result.next()) {
                Agencia agencia = new Agencia();
                agencia.setIdBank(result.getInt(1));
                agencia.setAddress(result.getString(2));
                agencia.setId(result.getInt(1));

                agencias.add(agencia);
            }
        } catch (SQLException e) {
            throw new RuntimeException("Erro ao listar agências: " + e.getMessage(), e);
        }

        return agencias;
    }

    public static boolean verifyID(int id) {
        String sql = "SELECT id FROM agencia WHERE id = ?";
        try (Connection conn = DatabaseConnection.getInstance().getConnection();
                PreparedStatement pstmt = conn.prepareStatement(sql)) {
            pstmt.setInt(1, id);
            ResultSet result = pstmt.executeQuery();
            return result.next();
        } catch (SQLException e) {
            throw new RuntimeException("Erro ao verificar id: " + e.getMessage(), e);
        }
    }
}
