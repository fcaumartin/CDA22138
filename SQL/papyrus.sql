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

select * from entcom where numfou=(select numfou from entcom where numcom=70210);


select e1.*
from entcom e1
join entcom e2 on  e1.numfou=e2.numfou
where e2.numcom=70210;


/* 14. Dans les articles susceptibles d’être vendus, lister les articles moins
chers (basés sur Prix1) que le moins cher des rubans (article dont le
premier caractère commence par R). On affichera le libellé de l’article
et prix1 */



select * 
from vente
where prix1 < (
    select min(prix1) from vente where codart like 'r%'
);



/* 15. Afficher la liste des fournisseurs susceptibles de 
livrer les produits
dont le stock est inférieur ou égal à 150 % du stock d'alerte. 
La liste est triée par produit puis fournisseur */


select e.numfou
from ligcom l
join entcom e on e.numcom=l.numcom
join produit p on l.codart=p.codart 
where l.qtecde>l.qteliv and p.stkphy<=(1.5*p.stkale);

/* 16. Éditer la liste des fournisseurs susceptibles de livrer les produit dont
le stock est inférieur ou égal à 150 % du stock 
d'alerte et un délai de livraison d'au plus 30 jours. 
La liste est triée par fournisseur puis
produit */

select e.numfou
from ligcom l
join entcom e on e.numcom=l.numcom
join produit p on l.codart=p.codart 
join fournis f on f.numfou=e.numfou
join vente v on f.numfou=v.numfou and p.codart=v.codart
where 
    l.qtecde>l.qteliv 
and 
    p.stkphy<=(1.5*p.stkale)
and
    v.delliv<=30;



/* 17. Avec le même type de sélection que ci-dessus, sortir un 
total des
stocks par fournisseur trié par total décroissant */



select f.nomfou, sum(p.stkphy)
from ligcom l
join entcom e on e.numcom=l.numcom
join produit p on l.codart=p.codart 
join fournis f on f.numfou=e.numfou
join vente v on f.numfou=v.numfou and p.codart=v.codart
where 
    l.qtecde>l.qteliv 
and 
    p.stkphy<=(1.5*p.stkale)
and
    v.delliv<=30
group by f.nomfou;



/* 18. En fin d'année, sortir la liste des produits 
dont la quantité réellement
commandée dépasse 90% de la quantité annuelle prévue. */


select p.codart, qteann, sum(qtecde)
from produit p
join ligcom l on l.codart=p.codart
group by p.codart
having sum(qtecde) > (qteann*0.9);




/* 19. Calculer le chiffre d'affaire par 
fournisseur pour l'année 93 sachant
que les prix indiqués sont hors taxes 
et que le taux de TVA est 20%. */

select e.numfou, sum(l.qtecde*l.priuni)*1.20
from entcom e
join ligcom l on l.numcom=e.numcom
where YEAR(e.datcom)=2018
group by e.numfou;


-- 20
-- produits commandés chez les fournisseurs
select codart, numfou 
from ligcom
join entcom on ligcom.numcom=entcom.numcom;

-- catalogue
select codart, numfou 
from vente;
