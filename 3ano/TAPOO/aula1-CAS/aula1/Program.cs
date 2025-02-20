using CAS;
using System.Numerics;

Expressao a = 10;
Expressao b = "b";

Expressao soma = new Soma(a, b);

Console.WriteLine(soma);

Expressao x = "x";
Expressao y = x*x*x+10;
Console.WriteLine(y);

Expressao derivada = y.Derivar((Simbolo)x);
Console.WriteLine(derivada);
