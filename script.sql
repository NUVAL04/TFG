-- Active: 1704898813628@@127.0.0.1@3306@tfg
SET NAMES UTF8;
CREATE DATABASE IF NOT EXISTS TFG;
USE TFG;
CREATE TABLE usuarios (
  num_usuario int(10) unsigned NOT NULL auto_increment,
  nombre varchar(30) NOT NULL DEFAULT '' ,
  login varchar(20) NOT NULL DEFAULT '' ,
  password varchar(12) NOT NULL DEFAULT '' ,
  email varchar(30) NOT NULL DEFAULT '' ,
  PRIMARY KEY (num_usuario),
  UNIQUE num_usuario (num_usuario,nombre,login,password)
);

INSERT INTO usuarios VALUES("18","Pedro","pedro","a","pedro@email.es");
INSERT INTO usuarios VALUES("19","Maria","maria","a","maria@nadie.com");

CREATE TABLE valoraciones (
  num_valoracion int(10) unsigned NOT NULL auto_increment,
  fecha date NOT NULL DEFAULT '1970-01-01' ,
  asunto varchar(50) NOT NULL DEFAULT '' ,
  contenido text NOT NULL DEFAULT '' ,
  num_usuario int(10) unsigned NOT NULL DEFAULT '0' ,
  estrellas int(6) unsigned NOT NULL DEFAULT '0',
  num_valoracion_origen int(10) DEFAULT '-1' ,
  num_respuestas int(6) unsigned DEFAULT '0' ,
  PRIMARY KEY (num_valoracion),
  UNIQUE num_valoracion (num_valoracion)
);

INSERT INTO valoraciones VALUES("14","2007-11-23","Hola!","Acabo de llegar al foro y me parece muy util. Un saludo a tod@s!","18","4","-1","1");
INSERT INTO valoraciones VALUES("15","2007-11-23","RE:Hola!","Hola, Pedro! A mi tambien me parece de gran utilidad.","19","3","14","0");
INSERT INTO valoraciones VALUES("16","2007-11-23","Duda curso","Acabo de llegar al curso de PHP y estoy un poco perdida con los objetos, me podeis enviar alg�n ejemplo?
Gracias!","19","2","-1","1");
INSERT INTO valoraciones VALUES("17","2007-11-23","RE:Duda curso","Ahora mismo te hago llegar un buen ejemplo!!!","18","4","16","0");
INSERT INTO valoraciones VALUES("18","2007-11-23","Por fin es viernes!","Feliz fin de semana a todos!!!
Volved en buen estado el lunes :-)","18","5","-1","0");

CREATE TABLE citas (
  num_cita int(10) unsigned NOT NULL auto_increment,
  fecha DATETIME NOT NULL DEFAULT '1970-01-01' ,
  nombre varchar(50) NOT NULL DEFAULT '' ,
  num_usuario int(10) unsigned NOT NULL DEFAULT '0' ,
  telefono int(10) unsigned NOT NULL DEFAULT '0' ,
  tipo varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (num_cita),
  UNIQUE num_cita (num_cita)
);