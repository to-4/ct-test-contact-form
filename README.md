# 確認テスト\_お問い合わせフォーム

## 環境構築

### Docker ビルド

1. git clone git@github.com:to-4/ct-test-contact-form.git
2. cd ct-test-contact-form
3. printf "UID=%s\nGID=%s\n" "$(id -u)" "$(id -g)" > .env
4. docker compose up -d --build

### Laravel 環境構築

1. docker compose exec php bash
2. composer install
3. .env.example ファイルから .env を作成し、環境変数を変更
```
  DB_CONNECTION=mysql
  - DB_HOST=127.0.0.1
  + DB_HOST=mysql
  DB_PORT=3306
  - DB_DATABASE=laravel
  - DB_USERNAME=root
  - DB_PASSWORD=
  + DB_DATABASE=laravel_db
  + DB_USERNAME=laravel_user
  + DB_PASSWORD=laravel_pass

```
4. php artisan key:generate
5. php artisan migrate
6. php artisan db:seed

## 使用技術

- PHP 8.2
- Laravel 8.8
- MySQL 8.0

## ER 図

![ER図](./images/ER-core_v1.svg)

## URL

- 開発環境：http://localhost/
- phpMyAdmin：http://localhost:8080/
