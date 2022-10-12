-- Active: 1664351913126@@127.0.0.1@3306@papyrus2

-- 1. Application d'une augmentation de tarif de 4% pour le prix 1 et de 2%
-- pour le prix2 pour le fournisseur 9180


update vente
SET
prix1=prix1*1.04,
prix2=prix2*1.02
WHERE numfou=9180;














-- 2. Dans la table vente, mettre à jour le prix2 des articles dont le prix2 est
-- null, en affectant a prix2 la valeur de prix1.


update vente
set
prix2=prix1
where prix2 is null;

select prix1, prix2 from vente where prix2 is null;










-- 3. Mettre à jour le champ obscom en positionnant '*****' pour toutes les
-- commandes dont le fournisseur a un indice de satisfaction <5


update entcom
join fournis on fournis.numfou=entcom.numfou
set
obscom='*****'
where fournis.satisf<5;







-- 4. Suppression du produit I110


DELETE
FROM produit
where codart='I110';



DELETE
FROM ligcom
where codart='I110';

DELETE
FROM vente
where codart='I110';


--5 Suppression des entête de commande qui n'ont aucune ligne

delete  
from entcom
where numcom not in (
    select distinct numcom from ligcom
);




