package com.pedro.DAO.Exceptions;

public class BancoNaoEncontradoPorCnpjException extends Exception {
    public BancoNaoEncontradoPorCnpjException(String cnpj) {
        super("Banco com CNPJ " + cnpj + " não encontrado");
    }
}
