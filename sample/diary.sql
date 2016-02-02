--
-- データベース
--

CREATE DATABASE IF NOT EXISTS sample_db;
USE sample_db;

--
-- テーブル
--

CREATE TABLE diary_user (
  name CHAR(32) NOT NULL,
  pass CHAR(32) NOT NULL,
  PRIMARY KEY (name)
);

CREATE TABLE diary_auth (
  uid CHAR(32) NOT NULL,
  sid CHAR(32) NOT NULL,
  life DATETIME NOT NULL,
  PRIMARY KEY (uid)
);

CREATE TABLE diary_log (
  id INT NOT NULL AUTO_INCREMENT,
  title VARCHAR(255) NOT NULL,
  story TEXT NOT NULL,
  modify DATE NOT NULL,
  PRIMARY KEY (id,modify)
);

--
-- 管理用データ
--

INSERT INTO diary_user VALUES (md5('owner'),md5('admin'));

--
-- テスト用データ
--

INSERT INTO diary_log (title,story,modify) VALUES('テストタイトル','テストメッセージ',now());
