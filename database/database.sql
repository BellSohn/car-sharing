CREATE DATABASE IF NOT EXISTS carsharing;
USE carsharing;

CREATE TABLE usuario(
    id int(255) auto_increment not null,
    name varchar(100) not null,
    surname varchar(150) not null,
    nick varchar(100) null,
    phone varchar(200) not null,
    email varchar(250) not null,
    password varchar(255) not null,
    type varchar(100) not null,
    CONSTRAINT PK_USER PRIMARY KEY(id)
);

CREATE TABLE itinerary(
    id int(255) auto_increment not null,
    days varchar(150) not null,
    start-time datetime not null,
    start-place varchar(150) not null,
    end-place varchar(150) not null,
    free-seats int(255) not null,
    id_usuario int(255) not null,
    CONSTRAINT PK_ITINERARY PRIMARY KEY(id),
    CONSTRAINT FK_ITINERARY FOREIGN KEY(id_usuario)REFERENCES(id) usuario

);

CREATE TABLE seek(
    id int(255) auto_increment not null,
    days varchar(150) not null,
    start_time datetime,
    start_place varchar(150) not null,
    end_place varchar(150) not null,
    seats_demanded int(255) not null,
    id_usuario int(255) not null,
    CONSTRAINT PK_SEEK PRIMARY KEY(id),
    CONSTRAINT FK_SEEK_USER FOREIGN KEY(id) REFERENCES usuario(id)
);