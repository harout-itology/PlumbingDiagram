create table diagram_line
(
  id int auto_increment
    primary key,
  line_id int null,
  diagram_id int null,
  from_key int null,
  to_key int null,
  from_port int null,
  to_port int null
)
  engine=InnoDB
;

create index diagram_line_lines__fk
  on diagram_line (line_id)
;

create index diagram_line_diagrams__fk
  on diagram_line (diagram_id)
;

create table diagram_shape
(
  id int auto_increment
    primary key,
  diagram_id int null,
  category int null,
  `key` int null,
  loc varchar(255) null
)
  engine=InnoDB
;

create index diagram_shape_diagrams__fk
  on diagram_shape (diagram_id)
;

create index diagram_shape_shapes__fk
  on diagram_shape (category)
;

create table diagrams
(
  id int auto_increment
    primary key,
  sector varchar(255) null,
  image text null,
  width int default '0' null,
  height int default '0' null,
  background varchar(255) null,
  created datetime null,
  updated varchar(255) null
)
  engine=InnoDB
;

alter table diagram_line
  add constraint diagram_line_diagrams__fk
foreign key (diagram_id) references diagrams (id)
  on update cascade on delete cascade
;

alter table diagram_shape
  add constraint diagram_shape_diagrams__fk
foreign key (diagram_id) references diagrams (id)
  on update cascade on delete cascade
;

create table `lines`
(
  id int auto_increment
    primary key,
  color varchar(255) null,
  size int null,
  type varchar(255) null,
  status varchar(255) null,
  notes varchar(255) null,
  created datetime null,
  updated datetime null
)
  engine=InnoDB
;

alter table diagram_line
  add constraint diagram_line_lines__fk
foreign key (line_id) references `lines` (id)
;

create table ports
(
  id int auto_increment
    primary key,
  shape_id int null,
  name varchar(55) null,
  location varchar(55) null,
  color varchar(55) null,
  created datetime null,
  updated varchar(55) null
)
  engine=InnoDB
;

create index ports_shapes__fk
  on ports (shape_id)
;

create table shapes
(
  id int auto_increment
    primary key,
  note varchar(255) not null,
  type varchar(55) null,
  width varchar(55) null,
  height varchar(55) null,
  background varchar(55) null,
  color varchar(55) null,
  created datetime null,
  updated datetime null
)
  engine=InnoDB
;

alter table diagram_shape
  add constraint diagram_shape_shapes__fk
foreign key (category) references shapes (id)
;

alter table ports
  add constraint ports_shapes__fk
foreign key (shape_id) references shapes (id)
  on update cascade on delete cascade
;

