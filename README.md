# 確認テスト\_お問い合わせフォーム

## 環境構築

### Docker ビルド

1. git clone git@github.com:to-4/ct-test-contact-form.git
2. docker compose up -d --build

### Laravel 環境構築

1. docker compose exec php bash
2. composer install
3. .env.example ファイルから .env を作成し、環境変数を変更
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
