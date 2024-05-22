-- Active: 1704898813628@@127.0.0.1@3306
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

INSERT INTO usuarios VALUES("32","Alvaro","Alvaronv","vazquez1","alvaro@gmail.com");
INSERT INTO usuarios VALUES("33","Paco","Pacojr","Paquito12","paco@hotmail.com");

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
  UNIQUE num_valoracion (num_valoracion),
  CONSTRAINT fk_num_usuario FOREIGN KEY (num_usuario) REFERENCES usuarios(num_usuario)
);

INSERT INTO valoraciones VALUES("47","2024-04-23","Repetiría","Fui porque tenia un cumpleaños y me dejaron el pelo muy bien y fue barato","32","5","-1","0");
INSERT INTO valoraciones VALUES("48","2024-05-05","No fue lo que esperaba","Fueron muy amables pero me hicieron un destrozo en la cabeza","33","3","-1","0");


CREATE TABLE citas (
  num_cita int(10) unsigned NOT NULL auto_increment,
  fecha DATETIME NOT NULL DEFAULT '1970-01-01' ,
  nombre varchar(50) NOT NULL DEFAULT '' ,
  num_usuario int(10) unsigned NOT NULL DEFAULT '0' ,
  telefono int(10) unsigned NOT NULL DEFAULT '0' ,
  tipo varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (num_cita),
  UNIQUE num_cita (num_cita),
  CONSTRAINT fk_num_usuario_cita FOREIGN KEY (num_usuario) REFERENCES usuarios(num_usuario)
);

INSERT INTO citas VALUES("18", "2024-05-21 15:00:00", "Raquel", "33", "623547895", "Tinte");
INSERT INTO citas VALUES("19", "2024-05-21 14:00:00", "Alvaro", "32", "645869871", "Corte y Barba");