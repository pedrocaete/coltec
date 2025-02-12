package com.pedro.DAO;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;

import com.pedro.DAO.Exceptions.IdInexistenteException;
import com.pedro.classes.Cliente;
import com.pedro.database.DatabaseConnection;

public class ClienteDAO {
    public static final int POSICAO_NOME = 1;
    public static final int POSICAO_CPF = 2;

    public static void insert(String name, String cpf) {
        String sql = "INSERT INTO cliente (nome, cpf) VALUES (?, ?)";
        try (Connection conn = DatabaseConnection.getInstance().getConnection();
                PreparedStatement pstmt = conn.prepareStatement(sql)) {
            pstmt.setString(POSICAO_NOME, name);
            pstmt.setString(POSICAO_CPF, cpf);
            pstmt.executeUpdate();
        } catch (SQLException e) {
            throw new RuntimeException("Erro ao inserir cliente: " + e.getMessage(), e);
        }
    }

    public static int getId(String cpf) {
        String sql = "SELECT id FROM cliente WHERE cpf = ?";
        try (Connection conn = DatabaseConnection.getInstance().getConnection();
                PreparedStatement pstmt = conn.prepareStatement(sql)) {
            pstmt.setString(1, cpf);
            ResultSet result = pstmt.executeQuery();
            return result.getInt(1);
        } catch (SQLException e) {
            throw new RuntimeException("Erro ao buscar o ID da cliente: " + e.getMessage(), e);
        }
    }

    public static String getName(int id) throws IdInexistenteException {
        if (verifyID(id)) {
            String sql = "SELECT nome FROM cliente WHERE id = ?";
            try (Connection conn = DatabaseConnection.getInstance().getConnection();
                    PreparedStatement pstmt = conn.prepareStatement(sql)) {
                pstmt.setInt(1, id);
                ResultSet result = pstmt.executeQuery();
                return result.getString(1);
            } catch (SQLException e) {
                throw new RuntimeException("Erro ao buscar o nome da cliente: " + e.getMessage(), e);
            }
        }
        throw new IdInexistenteException(id);
    }

    public static String getCpf(int id) throws IdInexistenteException {
        if (verifyID(id)) {
            String sql = "SELECT cpf FROM cliente WHERE id = ?";
            try (Connection conn = DatabaseConnection.getInstance().getConnection();
                    PreparedStatement pstmt = conn.prepareStatement(sql)) {
                pstmt.setInt(1, id);
                ResultSet result = pstmt.executeQuery();
                return result.getString(1);
            } catch (SQLException e) {
                throw new RuntimeException("Erro ao buscar o CPF da cliente: " + e.getMessage(), e);
            }
        }
        throw new IdInexistenteException(id);
    }

    public static void updateName(int id, String name) throws IdInexistenteException {
        if (verifyID(id)) {
            String sql = "UPDATE cliente SET nome = ? WHERE id = ?";
            try (Connection conn = DatabaseConnection.getInstance().getConnection();
                    PreparedStatement pstmt = conn.prepareStatement(sql)) {
                pstmt.setString(1, name);
                pstmt.setInt(2, id);
                ResultSet result = pstmt.executeQuery();
            } catch (SQLException e) {
                throw new RuntimeException("Erro ao alterar nome: " + e.getMessage(), e);
            }
        }
        throw new IdInexistenteException(id);
    }

    public static void updateCpf(int id, String cpf) throws IdInexistenteException {
        if (verifyID(id)) {
            String sql = "UPDATE cliente SET cpf = ? WHERE id = ?";
            try (Connection conn = DatabaseConnection.getInstance().getConnection();
                    PreparedStatement pstmt = conn.prepareStatement(sql)) {
                pstmt.setString(1, cpf);
                pstmt.setInt(2, id);
                ResultSet result = pstmt.executeQuery();
            } catch (SQLException e) {
                throw new RuntimeException("Erro ao alterar CPF: " + e.getMessage(), e);
            }
        }
        throw new IdInexistenteException(id);
    }

    public static boolean verifyID(int id) {
        String sql = "SELECT id FROM cliente WHERE id = ?";
        try (Connection conn = DatabaseConnection.getInstance().getConnection();
                PreparedStatement pstmt = conn.prepareStatement(sql)) {
            pstmt.setInt(1, id);
            ResultSet result = pstmt.executeQuery();
            return result.next();
        } catch (SQLException e) {
            throw new RuntimeException("Erro ao verificar id: " + e.getMessage(), e);
        }
    }

    public static ArrayList<Cliente> list(){
        String sql = "SELECT * from cliente";
        ArrayList<Cliente> clientes = new ArrayList<Cliente>();
        try(Connection conn = DatabaseConnection.getInstance().getConnection();
            PreparedStatement pstmt = conn.prepareStatement(sql)){
            ResultSet result = pstmt.executeQuery();

            while(result.next()){
                Cliente cliente = new Cliente();
                
                cliente.setCpf(result.getString(3));
                cliente.setNome(result.getString(2));
                cliente.setId(result.getInt(1));

                clientes.add(cliente);
            }
        
        }

        catch(SQLException e){
            throw new RuntimeException("Erro ao listar clientes: " + e.getMessage(), e);
    }
        return clientes;
    }
}
