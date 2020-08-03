create table Users(
    id int PRIMARY KEY auto_increment,
    username varchar(255) not null,
    password varchar(255) not null,
    integlevel varchar(255),
    conflevel varchar(255),
    lastfailcount int default 0
);

create table Files(
    id int PRIMARY KEY auto_increment,
    name varchar(255) not null,
    content text ,
    integlevel varchar(255),
    conflevel varchar(255),
    username VARCHAR(255)
);

CREATE table Logs(
    id int PRIMARY KEY auto_increment,
    dt datetime DEFAULT NOW(),
    content text
);

alter table Users add column active int DEFAULT 1