package com.pedro.DAO;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.SQLException;

import com.pedro.database.DatabaseConnection;

public class SetupDatabase {
    public static void CreteTables() {
        String[] sqlStatements = {
            "CREATE SCHEMA IF NOT EXISTS `jdbc` DEFAULT CHARACTER SET utf8;",
            "CREATE TABLE IF NOT EXISTS `jdbc`.`banco` (" +
                "`id` INT NOT NULL AUTO_INCREMENT," +
                "`nome` VARCHAR(255) NOT NULL," +
                "`cnpj` VARCHAR(14) NOT NULL," +
                "PRIMARY KEY (`id`)) ENGINE = InnoDB;",
            "CREATE TABLE IF NOT EXISTS `jdbc`.`agencia` (" +
                "`id` INT NOT NULL AUTO_INCREMENT," +
                "`endereco` VARCHAR(255) NOT NULL," +
                "`id_banco` INT NOT NULL," +
                "PRIMARY KEY (`id`)," +
                "INDEX `fk_agencia_banco_idx` (`id_banco` ASC)," +
                "CONSTRAINT `fk_agencia_banco` FOREIGN KEY (`id_banco`) " +
                "REFERENCES `jdbc`.`banco` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION) ENGINE = InnoDB;",
            "CREATE TABLE IF NOT EXISTS `jdbc`.`conta` (" +
                "`id` INT NOT NULL AUTO_INCREMENT," +
                "`limite` DOUBLE NOT NULL," +
                "`saldo` DOUBLE NOT NULL," +
                "`id_agencia` INT NOT NULL," +
                "PRIMARY KEY (`id`)," +
                "INDEX `fk_conta_agencia1_idx` (`id_agencia` ASC)," +
                "CONSTRAINT `fk_conta_agencia1` FOREIGN KEY (`id_agencia`) " +
                "REFERENCES `jdbc`.`agencia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION) ENGINE = InnoDB;",
            "CREATE TABLE IF NOT EXISTS `jdbc`.`cliente` (" +
                "`id` INT NOT NULL AUTO_INCREMENT," +
                "`nome` VARCHAR(255) NOT NULL," +
                "`cpf` VARCHAR(11) NOT NULL," +
                "PRIMARY KEY (`id`)) ENGINE = InnoDB;",
            "CREATE TABLE IF NOT EXISTS `jdbc`.`cliente_conta` (" +
                "`id_conta` INT NOT NULL," +
                "`id_cliente` INT NOT NULL," +
                "PRIMARY KEY (`id_conta`, `id_cliente`)," +
                "INDEX `fk_conta_has_cliente_cliente1_idx` (`id_cliente` ASC) VISIBLE," +
                "INDEX `fk_conta_has_cliente_conta1_idx` (`id_conta` ASC) VISIBLE," +
                "CONSTRAINT `fk_conta_has_cliente_conta1` " +
                "FOREIGN KEY (`id_conta`) " +
                "REFERENCES `jdbc`.`conta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION," +
                "CONSTRAINT `fk_conta_has_cliente_cliente1` " +
                "FOREIGN KEY (`id_cliente`) " +
                "REFERENCES `jdbc`.`cliente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION) ENGINE = InnoDB;"
        };

        try (Connection conn = DatabaseConnection.getInstance().getConnection()) {
            for (String sql : sqlStatements) {
                try (PreparedStatement pstmt = conn.prepareStatement(sql)) {
                    pstmt.execute();
                    System.out.println("Executado: " + sql);
                } catch (SQLException e) {
                    System.err.println("Erro ao executar o comando: " + sql);
                    System.err.println("Erro: " + e.getMessage());
                }
            }
            System.out.println("Banco de dados configurado com sucesso.");
        } catch (SQLException e) {
            System.err.println("Erro ao conectar ao banco de dados: " + e.getMessage());
        }
    }
}
