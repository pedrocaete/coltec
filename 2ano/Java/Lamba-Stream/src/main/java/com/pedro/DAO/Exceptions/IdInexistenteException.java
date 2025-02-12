package com.pedro.DAO.Exceptions;

public class IdInexistenteException extends Exception{
    public IdInexistenteException(int id){
        super("ID Inexistente: " + id);
    }
}
