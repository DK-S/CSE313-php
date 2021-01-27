

/*
user
id
firstName
lastName



speaker
id
firstName
lastName

conferences
id
[month]
[year]

notes
id
note
userid
talkid

[session]
id
conferenceid
sessionNameid

talks
id
title
speakerid
sessionid

sessionName
id
name

drop table if exists notes;
drop table if exists talks;
drop table if exists theSessions;
drop table if exists sessionName;
drop table if exists conferences;
drop table if exists speakers;
drop table if exists users;
*/


drop table if exists users;
create table users (id serial not null primary key
,firstName varchar(255)
,lastName varchar(255)
);

Insert INTO users (firstName, lastName) VALUES ('Donivan', 'Killpack');
Insert INTO users (firstName, lastName) VALUES ('Chris', 'Lundquist');
Insert INTO users (firstName, lastName) VALUES ('Kat', 'Nelson');
Insert INTO users (firstName, lastName) VALUES ('Barandon', 'Gorringe');
Insert INTO users (firstName, lastName) VALUES ('Tommy', 'Knorr');
Insert INTO users (firstName, lastName) VALUES ('Frank', 'Desjardins');
Insert INTO users (firstName, lastName) VALUES ('Darlene', 'Chapman');
Insert INTO users (firstName, lastName) VALUES ('Carlos', 'Alonzo');
Insert INTO users (firstName, lastName) VALUES ('Carson', 'Fairbourn');

drop table if exists speakers;
create table speakers (id serial not null primary key
,firstName varchar(255)
,lastName varchar(255)
);

drop table if exists conferences;
create table conferences (id serial not null primary key
,theYear int
,theMonth int
);


drop table if exists sessionName;
create table sessionName (id serial not null primary key,
name varchar(255)
);

Insert INTO sessionName (name) VALUES ('Saturday Morning');
Insert INTO sessionName (name) VALUES ('Saturday Afternoon');
Insert INTO sessionName (name) VALUES ('Sunday Morning');
Insert INTO sessionName (name) VALUES ('Sunday Afternoon');
Insert INTO sessionName (name) VALUES ('General Relief Society');
Insert INTO sessionName (name) VALUES ('General Priesthood');

drop table if exists theSessions;
create table theSessions(id serial not null primary key
,conferenceid int not null references conferences(id)
,sessionNameid int references sessionName(id)
);

drop table if exists talks;
create table talks(id serial not null primary key
,title varchar(255)
,speakersid int references speakers(id)
,theSessionsid int references theSessions(id)
);

drop table if exists notes;
create table notes (id serial not null primary key
,note TEXT
,usersid int references users(id)
,talksid int references talks(id)
);


insert into conferences (theYear, theMonth) values (2020, 10);
insert into theSessions (conferenceid, sessionNameID) values ((select id from conferences where theYear=2020 and theMonth=10),(select id from sessionName where name = 'Saturday Morning'));
insert into theSessions (conferenceid, sessionNameID) values ((select id from conferences where theYear=2020 and theMonth=10),(select id from sessionName where name = 'Saturday Afternoon'));
insert into theSessions (conferenceid, sessionNameID) values ((select id from conferences where theYear=2020 and theMonth=10),(select id from sessionName where name = 'Sunday Morning'));
insert into theSessions (conferenceid, sessionNameID) values ((select id from conferences where theYear=2020 and theMonth=10),(select id from sessionName where name = 'Sunday Afternoon'));
insert into theSessions (conferenceid, sessionNameID) values ((select id from conferences where theYear=2020 and theMonth=10),(select id from sessionName where name = 'General Relief Society'));

insert into speakers (firstName, lastName) values ('Russell', 'Nelson');
insert into speakers (firstName, lastName) values ('David', 'Bednar');
insert into speakers (firstName, lastName) values ('Scott', 'Whiting');
insert into speakers (firstName, lastName) values ('Michelle', 'Craig');
insert into speakers (firstName, lastName) values ('Quentin', 'Cook');

insert into talks (title, speakersid, theSessionsid) values ('Moving Forward', (select id from speakers where lastName='Nelson' and firstName='Russell'), (select id from theSessions where conferenceid=(select id from conferences where theYear=2020 and theMonth=10) and sessionNameID=(select id from sessionName where name = 'Saturday Morning')));
insert into talks (title, speakersid, theSessionsid) values ('He will prove them herewith', (select id from speakers where lastName='Bednar' and firstName='David'), (select id from theSessions where conferenceid=(select id from conferences where theYear=2020 and theMonth=10) and sessionNameID=(select id from sessionName where name = 'Saturday Morning')));
insert into talks (title, speakersid, theSessionsid) values ('Becoming like him', (select id from speakers where lastName='Whiting' and firstName='Scott'), (select id from theSessions where conferenceid=(select id from conferences where theYear=2020 and theMonth=10) and sessionNameID=(select id from sessionName where name = 'Saturday Morning')));

insert into notes (note, usersid, talksid) values ('My primary responsibility as a teacher was to help students', 5, (select id from talks where title = 'Moving Forward'));
insert into notes (note, usersid, talksid) values ('tests in the school of mortality are a vital element of our eternal progression.', 5, (select id from talks where title = 'Moving Forward'));
insert into notes (note, usersid, talksid) values ('the work of the Lord is steadily moving forward. ', 3, (select id from talks where title = 'He will prove them herewith'));
insert into notes (note, usersid, talksid) values ('Family history work has increased exponentially.', 3, (select id from talks where title = 'He will prove them herewith'));
insert into notes (note, usersid, talksid) values ('what if becoming “even as [He is]” is not figurative,', 7, (select id from talks where title = 'Becoming like him'));
insert into notes (note, usersid, talksid) values ('Truly, there is no other way to heal the wounds of broken relationships or of a fractured society than for each of us to more fully emulate the Prince of Peace.', 7, (select id from talks where title = 'Becoming like him'));

select * from notes inner join talks on notes.talksid = talks.id where talks.title like '%Forward%';

select talks.title, CONCAT(speakers.firstName, ' ', speakers.lastName) as speaker
, sessionName.name as theSessionName, CONCAT(conferences.theMonth, '/', conferences.theYear) as conference
,notes.note, CONCAT(users.firstName, ' ', users.lastname) as listener from talks 
inner join speakers on talks.speakersid = speakers.id
inner join theSessions on talks.theSessionsid = theSessions.id
inner join sessionName on theSessions.sessionNameID = sessionName.id
inner join conferences on theSessions.conferenceid = conferences.id
inner join notes on talks.id = notes.talksid
inner join users on notes.usersid = users.id
where talks.title like '%Forward%';

