package com.pedro.DAO;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;

import com.pedro.DAO.Exceptions.IdInexistenteException;
import com.pedro.classes.Conta;
import com.pedro.database.DatabaseConnection;

public class ContaDAO {
    public static final int POSICAO_LIMIT = 1;
    public static final int POSICAO_SALDO = 2;
    public static final int POSICAO_AGENCIA_ID = 3;

    public static void insert(int limit, int balance, int agencyID) {
        String sql = "INSERT INTO conta (limite, saldo, id_agencia) VALUES (?, ?, ?)";
        try (Connection conn = DatabaseConnection.getInstance().getConnection();
                PreparedStatement pstmt = conn.prepareStatement(sql)) {
            pstmt.setInt(POSICAO_LIMIT, limit);
            pstmt.setInt(POSICAO_SALDO, balance);
            pstmt.setInt(POSICAO_AGENCIA_ID, agencyID);
            pstmt.executeUpdate();
        } catch (SQLException e) {
            throw new RuntimeException("Erro ao inserir conta: " + e.getMessage(), e);
        }
    }

    public static double getLimit(int id) throws IdInexistenteException {
        if (verifyID(id)) {
            String sql = "SELECT limite FROM conta WHERE id = ?";
            try (Connection conn = DatabaseConnection.getInstance().getConnection();
                    PreparedStatement pstmt = conn.prepareStatement(sql)) {
                pstmt.setInt(1, id);
                ResultSet result = pstmt.executeQuery();
                return result.getDouble(1);
            } catch (SQLException e) {
                throw new RuntimeException("Erro ao buscar limite do conta: " + e.getMessage(), e);
            }
        } else {
            throw new IdInexistenteException(id);
        }
    }

    public static double getBalance(int id) throws IdInexistenteException {
        if (verifyID(id)) {
            String sql = "SELECT saldo FROM conta WHERE id = ?";
            try (Connection conn = DatabaseConnection.getInstance().getConnection();
                    PreparedStatement pstmt = conn.prepareStatement(sql)) {
                pstmt.setInt(1, id);
                ResultSet result = pstmt.executeQuery();
                return result.getDouble(1);
            } catch (SQLException e) {
                throw new RuntimeException("Erro ao buscar limite do conta: " + e.getMessage(), e);
            }
        } else {
            throw new IdInexistenteException(id);
        }
    }

    public static void updateLimit(int id, double limit) throws IdInexistenteException {
        if (verifyID(id)) {
            String sql = "UPDATE conta SET limite = ? WHERE id = ?";
            try (Connection conn = DatabaseConnection.getInstance().getConnection();
                    PreparedStatement pstmt = conn.prepareStatement(sql)) {
                pstmt.setDouble(1, limit);
                pstmt.setInt(2, id);
                ResultSet result = pstmt.executeQuery();
            } catch (SQLException e) {
                throw new RuntimeException("Erro ao alterar limite do conta: " + e.getMessage(), e);
            }
        } else {
            throw new IdInexistenteException(id);
        }
    }

    public static void updateBalance(int id, double balance) throws IdInexistenteException {
        if (verifyID(id)) {
            String sql = "UPDATE conta SET saldo = ? WHERE id = ?";
            try (Connection conn = DatabaseConnection.getInstance().getConnection();
                    PreparedStatement pstmt = conn.prepareStatement(sql)) {
                pstmt.setDouble(1, balance);
                pstmt.setInt(2, id);
                ResultSet result = pstmt.executeQuery();
            } catch (SQLException e) {
                throw new RuntimeException("Erro ao alterar limite do conta: " + e.getMessage(), e);
            }
        } else {
            throw new IdInexistenteException(id);
        }
    }

    public static void updateAgencyID(int id, int agencyID) throws IdInexistenteException {
        if (verifyID(id)) {
            String sql = "UPDATE conta SET id_agencia = ? WHERE id = ?";
            try (Connection conn = DatabaseConnection.getInstance().getConnection();
                    PreparedStatement pstmt = conn.prepareStatement(sql)) {
                pstmt.setInt(1, agencyID);
                pstmt.setInt(2, id);
                pstmt.executeQuery();
            } catch (SQLException e) {
                throw new RuntimeException("Erro ao alterar agência do conta: " + e.getMessage(), e);
            }
        } else {
            throw new IdInexistenteException(id);
        }
    }

    public static boolean verifyID(int id) {
        String sql = "SELECT id FROM conta WHERE id = ?";
        try (Connection conn = DatabaseConnection.getInstance().getConnection();
                PreparedStatement pstmt = conn.prepareStatement(sql)) {
            pstmt.setInt(1, id);
            ResultSet result = pstmt.executeQuery();
            return result.next();
        } catch (SQLException e) {
            throw new RuntimeException("Erro ao verificar id: " + e.getMessage(), e);
        }
    }

    public static ArrayList<Conta> list(){
        String sql = "SELECT * from conta";
        ArrayList<Conta> contas = new ArrayList<Conta>();
        try(Connection conn = DatabaseConnection.getInstance().getConnection();
            PreparedStatement pstmt = conn.prepareStatement(sql)){
            ResultSet result = pstmt.executeQuery();

            while(result.next()){
                Conta conta = new Conta();
                
                conta.setId(result.getInt(1));
                conta.setLimit(result.getDouble(2));
                conta.setBalance(result.getDouble(3));
                conta.setIdAgency(result.getInt(4));

                contas.add(conta);
            }
        }
        catch(SQLException e){
            throw new RuntimeException("Erro ao listar clientes: " + e.getMessage(), e);
    }
        return contas;
    }
}
