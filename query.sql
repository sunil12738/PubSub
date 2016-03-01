create database asgn3;

use asgn3;

create table publisher(
	name varchar(25) primary key
);

insert into publisher values("sunil");
insert into publisher values("anil");

create table topic(
	pub varchar(25),
	name varchar(25),
	primary key(pub,name)
);

create table subs(
	topic varchar(25),
	user_email varchar(50),
	primary key(topic, user_email)
);

create table message(
	topic varchar(25),
	user_email varchar(50),
	message varchar(500),
	viewed varchar(1)
);