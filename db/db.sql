/*
Drop any tables if they exist so we start with a clean db
start with the tables that reference other tables
*/

--references the accounts table
drop table if exists budgets;
drop table if exists transactionLogs;

--references the accountTypes, 'Frequencies, 'Categories, 'SubCategories, and users tables
drop table if exists accounts;

--do not have references 
drop TABLE if exists accountTypes;
drop table if exists accountFrequencies;
drop table if exists accountCategories;
drop table if exists accountSubCategories;
drop table if exists users;

/*
Create the tables used for this project
*/

Create table accountTypes (id serial not null primary key
,name varchar(10)
,code INT
,active boolean
);

Create table accountFrequencies (id serial not null primary key
,name varchar(10)
,code INT
,active boolean
);

Create table accountCategories (id serial not null primary key
,name varchar(50)
,code INT
,active boolean
);

Create table users (id serial not null primary key
,firstName varchar(255)
,lastName varchar(255)
,userName varchar(255)
,password varchar(255)
,active boolean
,administrator boolean
);

Create table accountSubCategories (id serial not null primary key
,name varchar(255)
,active boolean
);

Create table accounts (id serial not null primary key
,name varchar(20)
,description TEXT
,userid int references users(id)
,active boolean
,accountTypeID int references accountTypes(id)
,accountFrequencyID int references accountFrequencies(id)
,accountCategoryID int references accountCategories(id)
,acountSubCategoryID int references accountSubCategories(id)
,subCategoryCode int
);

Create table budgets (id serial not null primary key
,amount DECIMAL
,accountID int references accounts(id)
,active boolean
,bYear INT
,bMonth INT
);

Create table transactionLogs (id serial not null primary key
,notes TEXT
,amount decimal
,accountID int references accounts(id)
,tDate DATE
);

/*
insert the default values for account Types, Frequencies, and Categories
These are tables rather than static or enumerated lists so that in the 
future they can be changed or modified with ease
*/

insert into accountTypes (name, code, active) values ('Income', 1, TRUE);
insert into accountTypes (name, code, active) values ('Income', 2, TRUE);
insert into accountTypes (name, code, active) values ('Income', 3, TRUE);

insert into accountFrequencies (name, code, active) values ('Fixed', 0, TRUE);
insert into accountFrequencies (name, code, active) values ('Periodic', 1, TRUE);
insert into accountFrequencies (name, code, active) values ('Variable', 2, TRUE);

insert into accountCategories (name, code, active) values ('General', 0, TRUE);
insert into accountCategories (name, code, active) values ('Donations', 1, TRUE);
insert into accountCategories (name, code, active) values ('Entertainment', 2, TRUE);

/*
insert default administrator
*/

insert into users (firstName, lastName, username, password, active, administrator) VALUES ('Budget', 'Administrator', 'administrator', '', TRUE, TRUE);

/*
DB is now built and ready for the first user to log in
*/
