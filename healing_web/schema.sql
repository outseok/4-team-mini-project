-- =========================================================
-- Healing Mini Project - 통합 스키마(권장)
-- DB: heal
-- =========================================================
CREATE DATABASE IF NOT EXISTS heal DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE heal;

-- 사용자 정보(회원가입/로그인/포인트)
CREATE TABLE IF NOT EXISTS user_info (
  num INT AUTO_INCREMENT PRIMARY KEY,
  uname VARCHAR(15),
  uid VARCHAR(20) UNIQUE,
  upw VARCHAR(255),
  uemail VARCHAR(40) UNIQUE,
  point INT DEFAULT 0,
  ip VARCHAR(45),
  uimage VARCHAR(200)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 감정 일기
CREATE TABLE IF NOT EXISTS diary (
  id INT AUTO_INCREMENT PRIMARY KEY,
  uid VARCHAR(20) NOT NULL,
  title VARCHAR(100) NOT NULL,
  emotion VARCHAR(20) NOT NULL,
  content TEXT NOT NULL,
  event_date DATE,
  reg_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  INDEX (uid),
  CONSTRAINT fk_diary_user FOREIGN KEY (uid) REFERENCES user_info(uid)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 상점/장식 아이템(유저가 보유한 현재 장착 아이템)
CREATE TABLE IF NOT EXISTS myitem (
  uid VARCHAR(20) NOT NULL,
  type VARCHAR(10) NOT NULL,   -- tree / house / pet
  name VARCHAR(30) NOT NULL,
  image VARCHAR(200) NOT NULL,
  PRIMARY KEY (uid, type),
  CONSTRAINT fk_myitem_user FOREIGN KEY (uid) REFERENCES user_info(uid)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
