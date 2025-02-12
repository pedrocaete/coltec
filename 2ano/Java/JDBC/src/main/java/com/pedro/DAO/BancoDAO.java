package com.pedro.DAO;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;

import com.pedro.DAO.Exceptions.BancoNaoEncontradoPorCnpjException;
import com.pedro.DAO.Exceptions.BancoNaoEncontradoPorIDException;
import com.pedro.classes.Banco;
import com.pedro.database.DatabaseConnection;

public class BancoDAO {
    private static final int POSICAO_NOME = 1;
    private static final int POSICAO_CNPJ = 2;

    public static void insert(String nome, String cnpj) {
        String sql = "INSERT INTO banco (nome, cnpj) VALUES (?, ?)";
        try (Connection conn = DatabaseConnection.getInstance().getConnection();
                PreparedStatement pstmt = conn.prepareStatement(sql)) {

            pstmt.setString(POSICAO_NOME, nome);
            pstmt.setString(POSICAO_CNPJ, cnpj);
            pstmt.executeUpdate();

        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

    public static int getIDbyCnpj(String cnpj) throws BancoNaoEncontradoPorCnpjException {
        String sql = "SELECT id FROM banco WHERE cnpj = ?";

        try (Connection conn = DatabaseConnection.getInstance().getConnection();
                PreparedStatement pstmt = conn.prepareStatement(sql)) {

            pstmt.setString(1, cnpj);
            ResultSet result = pstmt.executeQuery();

            if (result.next()) {
                return result.getInt(1);
            }

            throw new BancoNaoEncontradoPorCnpjException(cnpj);

        } catch (SQLException e) {
            throw new RuntimeException("Erro ao buscar o ID do banco: " + e.getMessage(), e);
        }
    }

    public static String getName(int id) throws BancoNaoEncontradoPorIDException {
        String sql = "SELECT nome FROM banco WHERE id = ?";

        try (Connection conn = DatabaseConnection.getInstance().getConnection();
                PreparedStatement pstmt = conn.prepareStatement(sql)) {

            pstmt.setInt(1, id);
            ResultSet result = pstmt.executeQuery();

            if (result.next()) {
                return result.getString(1);
            }

            throw new BancoNaoEncontradoPorIDException(id);

        } catch (SQLException e) {
            throw new RuntimeException("Erro ao buscar o ID do banco: " + e.getMessage(), e);
        }
    }

    public static String getCnpj(int id) throws BancoNaoEncontradoPorIDException {
        String sql = "SELECT cnpj FROM banco WHERE id = ?";

        try (Connection conn = DatabaseConnection.getInstance().getConnection();
                PreparedStatement pstmt = conn.prepareStatement(sql)) {

            pstmt.setInt(1, id);
            ResultSet result = pstmt.executeQuery();

            if (result.next()) {
                return result.getString(1);
            }

            throw new BancoNaoEncontradoPorIDException(id);

        } catch (SQLException e) {
            throw new RuntimeException("Erro ao obter CNPJ do banco: " + e.getMessage(), e);
        }
    }

    public static void updateName(int id, String name) {
        String sql = "UPDATE banco SET nome = ? WHERE id = ?";

        try (Connection conn = DatabaseConnection.getInstance().getConnection();
                PreparedStatement pstmt = conn.prepareStatement(sql)) {

            pstmt.setString(1, name);
            pstmt.setInt(2, id);
            pstmt.executeUpdate();

        } catch (SQLException e) {
            throw new RuntimeException("Erro ao alterar nome do banco: " + e.getMessage(), e);
        }
    }

    public static void updateCnpj(int id, String cnpj) {
        String sql = "UPDATE banco SET cnpj = ? WHERE id = ?";

        try(Connection conn = DatabaseConnection.getInstance().getConnection();
            PreparedStatement pstmt = conn.prepareStatement(sql)) {

            pstmt.setString(1, cnpj);
            pstmt.setInt(2, id);
            pstmt.executeUpdate();

        }
        catch(SQLException e){
            throw new RuntimeException("Erro ao alterar cnpj do banco: " + e.getMessage(), e);
        }
    }

    public static ArrayList<Banco> list(){
        String sql = "SELECT * from banco";
        ArrayList<Banco> bancos = new ArrayList<Banco>();
        try(Connection conn = DatabaseConnection.getInstance().getConnection();
            PreparedStatement pstmt = conn.prepareStatement(sql)){
            ResultSet result = pstmt.executeQuery();

            while(result.next()){
                Banco banco = new Banco();
                
                banco.setCnpj(result.getString(POSICAO_CNPJ));
                banco.setNome(result.getString(POSICAO_NOME));

                bancos.add(banco);
            }
        
        }
        catch(SQLException e){
            throw new RuntimeException("Erro ao listar bancos: " + e.getMessage(), e);
    }
        return bancos;
    }
}
