-- Active: 1664351913126@@127.0.0.1@3306@papyrus2


create table article_a_commander (
    codart char(4),
    `date`  date,
    qte int,
    foreign key (codart) references produit(codart)
);



create trigger update_produit
after update
on produit
for each row
BEGIN
    DECLARE pro_id char(4);
    DECLARE stock1 int;
    DECLARE stock2 int;
    DECLARE encmd int;

    set pro_id=NEW.codart;
    set stock1=NEW.stkphy;
    set stock2=NEW.stkale;

    IF stock1<stock2 THEN
        set encmd = (select sum(qte) from article_a_commander where codart=pro_id);
        IF encmd is null THEN
            set encmd=0;
        END IF;
        insert into article_a_commander (codart, `date`, qte) 
        values (pro_id, NOW(), (stock2-stock1)-encmd);
    END IF;
END;