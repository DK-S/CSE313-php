/*
Drop any tables if they exist so we start with a clean db
start with the tables that reference other tables
*/

--references the accounts table
drop table if exists budgets;
drop table if exists transactionlogs;

--references the accountTypes, 'Frequencies, 'Categories, 'SubCategories, and users tables
drop table if exists accounts;

--do not have references 
drop TABLE if exists accounttypes;
drop table if exists accountfrequencies;
drop table if exists accountcategories;
drop table if exists accountsubcategories;
drop table if exists users;

/*
Create the tables used for this project
*/

Create table accounttypes (id serial not null primary key
,name varchar(50)
,code INT
,active boolean
);

Create table accountfrequencies (id serial not null primary key
,name varchar(50)
,code INT
,active boolean
);

Create table accountcategories (id serial not null primary key
,name varchar(50)
,code INT
,active boolean
);

Create table users (id serial not null primary key
,firstname varchar(255)
,lastname varchar(255)
,username varchar(255)
,password varchar(255)
,active boolean
,administrator boolean
);

Create table accountsubcategories (id serial not null primary key
,name varchar(255)
,active boolean
);

Create table accounts (id serial not null primary key
,name varchar(20)
,description TEXT
,userid int references users(id)
,active boolean
,accounttypeid int references accounttypes(id)
,accountfrequencyid int references accountfrequencies(id)
,accountcategoryid int references accountcategories(id)
,accountsubcategoryid int references accountsubcategories(id)
,subcategorycode int
);

Create table budgets (id serial not null primary key
,amount DECIMAL
,accountid int references accounts(id)
,active boolean
,byear INT
,bmonth INT
);

Create table transactionlogs (id serial not null primary key
,notes TEXT
,amount decimal
,accountid int references accounts(id)
,tdate DATE
);

/*
insert the default values for account Types, Frequencies, and Categories
These are tables rather than static or enumerated lists so that in the 
future they can be changed or modified with ease
*/

insert into accounttypes (name, code, active) values ('Income', 1, TRUE);
insert into accounttypes (name, code, active) values ('Expenses', 2, TRUE);
insert into accounttypes (name, code, active) values ('Savings', 3, TRUE);

insert into accountfrequencies (name, code, active) values ('Fixed', 0, TRUE);
insert into accountfrequencies (name, code, active) values ('Periodic', 1, TRUE);
insert into accountfrequencies (name, code, active) values ('Variable', 2, TRUE);

insert into accountcategories (name, code, active) values ('General', 0, TRUE);
insert into accountcategories (name, code, active) values ('Donations', 1, TRUE);
insert into accountcategories (name, code, active) values ('Entertainment', 2, TRUE);

/*
insert default administrator
*/

--insert into users (firstname, lastname, username, password, active, administrator) VALUES ('Budget', 'Administrator', 'administrator', '', TRUE, TRUE);

/*
DB is now built and ready for the first user to log in
alter table accounts rename column acountsubcategoryid accountsubcategoryid
*/
