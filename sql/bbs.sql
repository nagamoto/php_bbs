CREATE DATABASE IF NOT EXISTS bbs_db;
USE bbs_db;

CREATE TABLE users (
  id INT NOT NULL AUTO_INCREMENT primary key,
  name CHAR(32) NOT NULL,
  pass CHAR(32) NOT NULL,
  created_at timestamp not null default current_timestamp,
  updated_at timestamp not null default current_timestamp on update current_timestamp
);


CREATE TABLE threads (
  id INT NOT NULL AUTO_INCREMENT primary key,
  user_id INT NOT NULL,
  title CHAR(32) NOT NULL,
  text TEXT NOT NULL,
  created_at timestamp not null default current_timestamp,
  updated_at timestamp not null default current_timestamp on update current_timestamp
);

CREATE TABLE comments (
  id INT NOT NULL AUTO_INCREMENT primary key,
  user_id INT NOT NULL,
  thread_id INT NOT NULL,
  text TEXT NOT NULL,
  created_at timestamp not null default current_timestamp,
  updated_at timestamp not null default current_timestamp on update current_timestamp
);


INSERT INTO users (name, pass) VALUES ('takahiro', 'nagamoto');
