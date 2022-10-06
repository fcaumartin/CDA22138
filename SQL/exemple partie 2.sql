-- Active: 1664351913126@@127.0.0.1@3306@exemple
-- Rechercher le prénom des employés et le numéro de la région de leur
-- département

select * from employe;

select * from dept;

select employe.prenom, dept.noregion
from employe
inner join dept on employe.nodep=dept.nodept;

select employe.prenom, dept.noregion
from employe, dept 
where employe.nodep=dept.nodept;



-- Rechercher le numéro du département, le nom du département, le
-- nom des employés classés par numéro de département (renommer les
-- tables utilisées).
select e.nom as nom1, d.nom as nom2
from employe as e
join dept as d on e.nodep=d.nodept
where d.nom='distribution';








-- Rechercher le nom des employés du département Distribution
select e.nom
from employe e
join dept d on e.nodep=d.nodept
where d.nom='distribution';



-- Rechercher le nom et le salaire des employés qui gagnent plus que
-- leur patron, et le nom et le salaire de leur patron.

select 
    salarie.noemp, 
    salarie.nosup, 
    salarie.prenom 'salarie', 
    salarie.salaire,
    patron.noemp,
    patron.prenom 'chef',
    patron.salaire
    from employe salarie
join employe patron on salarie.nosup=patron.noemp
where salarie.salaire>patron.salaire;



-- Rechercher le nom et le titre des employés qui ont le même titre que
-- Amartakaldire.



select * from employe where titre = (
    select titre from employe where nom='Amartakaldire'
);




-- Rechercher le nom, le salaire et le numéro de département des
-- employés qui gagnent plus qu'un seul employé du département 31,
-- classés par numéro de département et salaire.

select * from employe where salaire > ANY (
    select salaire from employe where nodep=31
);

select * from employe where salaire > (
    select MIN(salaire) from employe where nodep=31
);


-- Rechercher le nom, le salaire et le numéro de département des
-- employés qui gagnent plus que tous les employés du département 31,
-- classés par numéro de département et salaire.
select * from employe where salaire > ALL (
    select salaire from employe where nodep=31
);


select * from employe where salaire > (
    select MAX(salaire) from employe where nodep=31
);


-- Rechercher le nom et le titre des employés du service 31 qui ont un
-- titre que l'on trouve dans le département 32.



select * from employe 
where 
    nodep=31
    and 
    titre in (select titre from employe where nodep=32);

    








-- Rechercher le nom et le titre des employés du service 31 qui ont un
-- titre l'on ne trouve pas dans le département 32.


select * from employe 
where 
    nodep=31
    and 
    titre not in (select titre from employe where nodep=32);

  








-- Rechercher le nom, le titre et le salaire des employés qui ont le même
-- titre et le même salaire que Fairant.

select * from employe 
where 
    titre in (select titre from employe where nom='fairent')
and 
    salaire in (select salaire from employe where nom='fairent');




-- Rechercher le numéro de département, le nom du département, le
-- nom des employés, en affichant aussi les départements dans lesquels
-- il n'y a personne, classés par numéro de département.





select nodept, dept.nom, employe.nom
from dept left join employe on employe.nodep=dept.nodept;


select *
from employe right join dept on employe.nodep=dept.nodept;





select count(*), avg(salaire), titre
from employe
group by titre;


-- 1. Calculer le nombre d'employés de chaque titre.
select count(*), titre
from employe
group by titre;


-- 2. Calculer la moyenne des salaires et leur somme, par région.

select avg(e.salaire), sum(e.salaire), d.noregion
from employe e 
join dept d on e.nodep=d.nodept
group by d.noregion;




-- 3. Afficher les numéros des départements ayant au moins 3 employés.

select count(*) as 'nombre', nodep
from employe
group by nodep
having nombre>2;












-- 4. Afficher les lettres qui sont l'initiale du nom d'au moins trois employés.


select count(*) as nombre, SUBSTRING(nom, 1, 1) as premiere
from employe
group by premiere
having nombre>2;

select count(*) , SUBSTRING(nom, 1, 1) 
from employe
group by SUBSTRING(nom, 1, 1)
having count(*)>2;










-- 5. Rechercher le salaire maximum et le salaire minimum parmi tous les
-- salariés et l'écart entre les deux.

select max(salaire), min(salaire), max(salaire) - min(salaire)
from employe;












-- 6. Rechercher le nombre de titres différents.

select count(distinct titre) from employe;










-- 7. Pour chaque titre, compter le nombre d'employés possédant ce titre.

select count(*), titre
from employe
group by titre;










-- 8. Pour chaque nom de département, afficher le nom du département et
-- le nombre d'employés.


select d.nom, count(*)
from employe e
join dept d on e.nodep=d.nodept
group by d.nom;







-- 9. Rechercher les titres et la moyenne des salaires par titre dont la
-- moyenne est supérieure à la moyenne des salaires des Représentants.



select avg(salaire), titre
from employe
group by titre
having avg(salaire)>(
    select avg(salaire) from employe where titre='representant'
);












-- 10.Rechercher le nombre de salaires renseignés et le nombre de taux de
-- commission renseignés.


select count(salaire), count(tauxcom) from employe;















































