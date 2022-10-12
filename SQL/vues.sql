-- Active: 1664351913126@@127.0.0.1@3306@northwind


create view extraction1
as
select * 
from customers;


select CompanyName from extraction1
where City='Berlin';

