using System;
using System.Linq.Expressions;

namespace CAS;

public abstract class Expressao
{
    public abstract override string ToString();
    public abstract Expressao Derivar(Simbolo x);
    public abstract Expressao Simplificar();
    public abstract Expressao Substituir(Simbolo x, Expressao e);
    public static Expressao operator +(Expressao a, Expressao b) => new Soma(a, b).Simplificar();
    public static Expressao operator -(Expressao a, Expressao b) => new Subtracao(a, b).Simplificar();
    public static Expressao operator *(Expressao a, Expressao b) => new Multiplicacao(a, b).Simplificar();
    public static Expressao operator /(Expressao a, Expressao b) => new Divisao(a, b).Simplificar();

    public static implicit operator Expressao(int v) => new Numero(v);
    public static implicit operator Expressao(string s) => new Simbolo(s);


}

public class Numero : Expressao
{
    public int valor;
    public Numero(int v) => this.valor = v;
    public override string ToString() => valor.ToString();
    public override Expressao Derivar(Simbolo x) => new Numero(0);
    public override Expressao Simplificar() => this;
    public override Expressao Substituir(Simbolo x, Expressao e) => this;
}

public class NumeroComplexo : Expressao
{
    public Complex valor;
    public NumeroComplexo(Complex v) => this.valor = v;
    public override string ToString() => valor.ToString();
    public override Expressao Derivar(Simbolo x) => new Numero(0);
    public override Expressao Simplificar() => this;
    public override Expressao Substituir(Simbolo x, Expressao e) => this;
}
public class Simbolo : Expressao
{
    string simbolo;
    public Simbolo(string s) => this.simbolo = s;
    public override string ToString() => simbolo;
    public override Expressao Derivar(Simbolo x) =>
        x.simbolo == simbolo
            ? new Numero(1)
            : new Numero(0);
    public override Expressao Simplificar() => this;
    public override Expressao Substituir(Simbolo x, Expressao e) =>
        x.simbolo == this.simbolo ? e : this;
}

public class Soma : Expressao
{
    Expressao a, b; // a + b
    public Soma(Expressao x, Expressao y)
    {
        this.a = x;
        this.b = y;
    }
    public override string ToString() => $"({a.ToString()} + {b.ToString()})";
    public override Expressao Derivar(Simbolo x) =>
        new Soma(a.Derivar(x), b.Derivar(x));
    public override Expressao Simplificar()
    {
        if (a is Numero && b is Numero)
        {
            return new Numero((a as Numero).valor + (b as Numero).valor);
        }
        if (a == 0)
        {
            return b;
        }
        if (b == 0)
        {
            return a;
        }

        return this;
    }
    public override Expressao Substituir(Simbolo x, Expressao e)
    {
        Expressao novoA = a.Substituir(x, e);
        Expressao novoB = b.Substituir(x, e);

        return new Soma(novoA, novoB);
    }
}

public class Subtracao : Expressao
{
    Expressao a, b; // a - b
    public Subtracao(Expressao x, Expressao y)
    {
        this.a = x;
        this.b = y;
    }
    public override string ToString() => $"({a.ToString()} - {b.ToString()})";
    public override Expressao Derivar(Simbolo x) =>
        new Subtracao(a.Derivar(x), b.Derivar(x));
    public override Expressao Simplificar()
    {
        if (a is Numero && b is Numero)
        {
            return new Numero((a as Numero).valor - (b as Numero).valor);
        }
        if(a == 0)
        {
            return -b;
        }
        if (b == 0)
        {
            return a;
        }
        return this;
    }
    public override Expressao Substituir(Simbolo x, Expressao e)
    {
        Expressao novoA = a.Substituir(x, e);
        Expressao novoB = b.Substituir(x, e);

        return new Subtracao(novoA, novoB);
    }
}

public class Multiplicacao : Expressao
{
    Expressao a, b; // a * b
    public Multiplicacao(Expressao x, Expressao y)
    {
        this.a = x;
        this.b = y;
    }
    public override string ToString() => $"({a.ToString()} * {b.ToString()})";
    public override Expressao Derivar(Simbolo x) =>
        new Soma(
            new Multiplicacao(a.Derivar(x), b),
            new Multiplicacao(a, b.Derivar(x)));
    public override Expressao Simplificar()
    {
        if (a is Numero && b is Numero)
        {
            return new Numero((a as Numero).valor * (b as Numero).valor);
        }
        if (a == 0 || b == 0)
        {
            return 0;
        }
        return this;
    }
    public override Expressao Substituir(Simbolo x, Expressao e)
    {
        Expressao novoA = a.Substituir(x, e);
        Expressao novoB = b.Substituir(x, e);

        return new Multiplicacao(novoA, novoB);
    }
}

public class Divisao : Expressao
{
    Expressao a, b; // a / b
    public Divisao(Expressao x, Expressao y)
    {
        this.a = x;
        this.b = y;
    }
    public override string ToString() => $"({a.ToString()} / {b.ToString()})";
    public override Expressao Derivar(Simbolo x) =>
        new Divisao(
            new Subtracao(
                new Multiplicacao(a.Derivar(x), b),
                new Multiplicacao(a, b.Derivar(x))),
            new Multiplicacao(b, b));
    public override Expressao Simplificar()
    {
        if(a is Numero && b is Numero)
        {
            return new Numero((a as Numero).valor / (b as Numero).valor);
        }
        if(a == 0)
        {
            return 0;
        }
        if(b == 1)
        {
            return a;
        }
        return this;
    }
    public override Expressao Substituir(Simbolo x, Expressao e)
    {
        Expressao novoA = a.Substituir(x, e);
        Expressao novoB = b.Substituir(x, e);

        return new Divisao(novoA, novoB);
    }
}
