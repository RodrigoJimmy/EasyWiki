CREATE DATABASE IF NOT EXISTS easywiki;
USE easywiki;

DROP TABLE IF EXISTS posts;
CREATE TABLE posts (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  title varchar(64) NOT NULL,
  content text NOT NULL,
  created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) DEFAULT CHARSET=utf8;


INSERT INTO posts (title, content) VALUES ('Primeiro post','Conteúdo do Primeiro Post');
INSERT INTO posts (title, content) VALUES ('Segundo post','Conteúdo do Segundo Post');
INSERT INTO posts (title, content) VALUES ('Terceiro post','Conteúdo do Terceiro Post');

DROP TABLE IF EXISTS users;
CREATE TABLE users (
  id int(11) NOT NULL AUTO_INCREMENT,
  login varchar(45) NOT NULL,
  password varchar(128) NOT NULL,
  role set('admin','anonymous') NOT NULL DEFAULT 'anonymous',
  name varchar(64),
  PRIMARY KEY (id),
  UNIQUE KEY `login_UNIQUE` (login)
) DEFAULT CHARSET=utf8;

INSERT INTO users (login, password, role, name) VALUES ('admin','e10adc3949ba59abbe56e057f20f883e','admin','Rodrigo de Lima Vieira');

GRANT ALL PRIVILEGES ON easywiki.* TO admin@localhost IDENTIFIED BY '123456';