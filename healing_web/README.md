# Healing Mini Project (정리본)

## 1) 실행 환경
- XAMPP/WAMP/MAMP 등 PHP + MariaDB(MySQL)
- PHP 7.4+ 권장

## 2) DB 세팅
1. phpMyAdmin 접속
2. `schema.sql` 실행 (DB heal + 테이블 생성)

## 3) 프로젝트 배치
- 이 폴더 전체를 `htdocs/healing_web/` 같은 경로에 복사

예)
- Windows XAMPP: `C:\xampp\htdocs\healing_web\`
- Mac MAMP: `/Applications/MAMP/htdocs/healing_web/`

## 4) 접속
- http://localhost/healing_web/login.html

## 5) 주요 페이지
- 회원가입: `userjoin.html`
- 로그인: `login.html`
- 메인: `main.php`
- 마이페이지: `mypage.php`
- 일기 작성: `diary.html` (저장: `diary_save.php`)
- 기록 목록: `content.php`
- 게임: `game.html` (성공 시 500P 지급)
- 상점: `store.html` (구매 시 포인트 차감 + 메인에 반영)

## 참고
- 비밀번호는 현재 '그대로 비교' 방식입니다(수업/미니프로젝트용).
  실제 서비스라면 `password_hash()` / `password_verify()` 로 바꾸는 걸 권장합니다.
