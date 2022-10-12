-- Active: 1664351913126@@127.0.0.1@3306@papyrus2


select * from vente;


start transaction;

delete from vente;

rollback;

commit;