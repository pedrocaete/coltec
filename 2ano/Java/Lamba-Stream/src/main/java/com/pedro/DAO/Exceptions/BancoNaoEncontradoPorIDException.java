package com.pedro.DAO.Exceptions;

public class BancoNaoEncontradoPorIDException extends Exception {
    public BancoNaoEncontradoPorIDException(int id) {
        super("Banco com id" + id + " não encontrado");
    }
}
