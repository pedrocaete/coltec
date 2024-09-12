-- INSIRA PELO MENOS 3 REGISTROS EM CADA TABELA
insert into revista_cientifica
VALUES
(1, "nature", 1, 1, "coltec"),
(2, "tatu do zeca", 3, 3, "gilbas"),
(3, "cobra cai", 1,1, "floresta fc");

insert into autor
VALUES
(1, "Joao da Pera", "joaodapera@gmail.com", "Escritorio 32, Belo Horizonte", "Brasil"),
(2, "Artur", "artur@hotmail.com", "Casa 18, Caeté, MG", "Brasil"),
(3, "Xing Lang Ling", "xinglinglang@gmail.com","Rua tonin xinin, 81, Xangai", "China");

insert into artigo
VALUES
(1, "ratos no mundo", "Como os ratos afetam o mundo. Explora como as doenças causadas por eles nos afetam, além de comerem restos", "biologia", 120, 1991, 1),
(2, "terremotos", "Explora como os terremotos são causados", "Geologia", 330, 2020, 1),
(3, "oceanos brilhantes", "Explora os fenomenos que causam o brilho no oceano", "Oceanografia", 30, 2010, 2),
(4, "loucos por mais", "Investiga a causa do efeito viciante das drogas", "Biologia", 100, 2019, 3),
(5, "sotaque", "Como o sotaque é gerado", "Linguística", 50, 2020, 2);


insert into artigo_autor
VALUES
(1,2),
(1,3),
(1,1),
(2,1),
(3,2),
(3,3),
(4,1),
(5,2);

-- CONSULTAS

-- a) Informar o ano que teve mais artigos publicados

select ano
from artigo
group by ano
order by ano desc
limit 1;

-- b) Informar o número de publicações de uma revista específica

select r.nome, count(revista_cientifica_id)
from artigo
join revista_cientifica r on r.id = revista_cientifica_id
group by r.nome;
