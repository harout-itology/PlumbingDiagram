create table diagrams
(
	id int auto_increment
		primary key,
	name varchar(255) null,
	content text null,
	image text null,
	created datetime null,
	updated varchar(255) null
)
;

create table ports
(
	id int auto_increment
		primary key,
	shape_id int null,
	name varchar(55) null,
	type varchar(55) null,
	color varchar(55) null,
	created datetime null,
	updated varchar(55) null
)
;

create table shapes
(
	id int auto_increment
		primary key,
	note varchar(255) null,
	type varchar(55) null,
	width varchar(55) null,
	height varchar(55) null,
	background varchar(55) null,
	color varchar(55) null,
	created datetime null,
	updated datetime null
)
;

