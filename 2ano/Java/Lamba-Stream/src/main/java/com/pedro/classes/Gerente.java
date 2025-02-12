package com.pedro.classes;

import java.util.List;
import java.util.stream.Collectors;

public class Gerente {

    public static List<Conta> getAccountsWithNegativeBalance(List<Conta> accounts){
        return accounts.stream().
            filter(account -> account.getBalance() < 0).
            collect(Collectors.toList());
    }

    public static List<Conta> getAccountsWithPostiveBalance(List<Conta> accounts){
        return accounts.stream().
            filter(account -> account.getBalance() >= 0).
            collect(Collectors.toList());
    }

    public static List<Conta> getAccountByLimitAbove(List<Conta> accounts, double limit){
        return accounts.stream().
            filter(account -> account.getLimit() > limit).
            collect(Collectors.toList());
    }

    public static List<Conta> getAccountByLimitUnder(List<Conta> accounts, double limit){
        return accounts.stream().
            filter(account -> account.getLimit() < limit).
            collect(Collectors.toList());
    }

    public static List<Agencia> getAgencyByAddress(List<Agencia> agencies, String address){
        return agencies.stream().
            filter(agency -> address.contains(agency.getAddress())).
            collect(Collectors.toList());
    }
}
