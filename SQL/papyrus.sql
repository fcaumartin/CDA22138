-- Active: 1664351913126@@127.0.0.1@3306@papyrus
-- 1. Quelles sont les commandes du fournisseur 09120 ?

select * 
from entcom 
where numfou=09120;



-- 2. Afficher le code des fournisseurs pour lesquels des commandes ont été
-- passées.
select distinct numfou from entcom;





-- 3. Afficher le nombre de commandes fournisseurs passées, et le nombre
-- de fournisseur concernés.


select count(numcom), count(distinct numfou) from entcom;








-- 4. Afficher les produits ayant un stock inférieur ou égal au stock d'alerte et
-- dont la quantité annuelle est inférieur à 1000
-- (informations à fournir : n° produit, libellé produit, stock, stock actuel
-- d'alerte, quantité annuelle
select * from produit
where 
    qteann<1000
and
    stkphy<=stkale;


-- 5. Quels sont les fournisseurs situés dans les départements 75 78 92 77 ?
-- L’affichage (département, nom fournisseur) sera effectué par
-- département décroissant, puis par ordre alphabétique

select posfou, nomfou 
from fournis
where posfou like '75%' or posfou like '92%'
order by posfou desc, nomfou;


select posfou, nomfou 
from fournis
where SUBSTRING(posfou, 1, 2) in ('75', '77', '78', '92')
order by posfou desc, nomfou;



-- 6. Quelles sont les commandes passées au mois de mars et avril ?

select datcom, numcom 
from entcom
where MONTH(datcom) between 3 and 4;



select datcom, numcom 
from entcom
where datcom like '_____04%';



-- 7. Quelles sont les commandes du jour qui ont des observations
-- particulières ?
-- (Affichage numéro de commande, date de commande)

select numcom, datcom, obscom 
from entcom
where DATE(datcom) = CURDATE();


select MAX(datcom) 
from entcom;



-- 8. Lister le total de chaque commande par total décroissant
-- (Affichage numéro de commande et total)

select numcom, sum(qtecde*priuni) as total
from ligcom
group by numcom
order by total desc;




-- 9. Lister les commandes dont le total est supérieur à 10 000€ ; 
-- on exclura
-- dans le calcul du total les articles commandés en quantité supérieure
-- ou égale à 1000.
-- (Affichage numéro de commande et total)

select numcom, sum(qtecde*priuni) as total
from ligcom
where qtecde<1000
group by numcom
having total>10000
order by total desc;


-- 10. Lister les commandes par nom fournisseur
-- (Afficher le nom du fournisseur, le numéro de commande et la date)

select f.nomfou, e.numcom, e.datcom
from entcom e
join fournis f on e.numfou=f.numfou
order by f.nomfou;





-- 11. Sortir les produits des commandes ayant le mot "urgent' en
-- observation?
-- (Afficher le numéro de commande, le nom du fournisseur, le libellé du
-- produit et le sous total = quantité commandée * Prix unitaire)

select e.numcom, f.nomfou, p.libart, l.qtecde*l.priuni
from ligcom l
join produit p on p.codart=l.codart
join entcom e on e.numcom=l.numcom
join fournis f on f.numfou=e.numfou
where e.obscom like '%urgent%'; 





-- 12. Coder de 2 manières différentes la requête suivante :
-- Lister le nom des fournisseurs susceptibles de livrer au 
-- moins un article


select distinct f.nomfou
from fournis f 
join entcom e on f.numfou=e.numfou
join ligcom l on e.numcom=l.numcom
where l.qteliv>0;


select nomfou from fournis where numfou in (
    select numfou from entcom where numcom in (
        select numcom from ligcom where qteliv>0
    )
)
;



/* 13. Coder de 2 manières différentes la requête suivante
Lister les commandes (Numéro et date) dont le fournisseur est celui de
la commande 70210 : */

