# pigly

## 環境構築
  **Dockerビルド**
1. `git clone git@github.com:git@github.com:aiko217/pigly.git
2. cd coachtech-pigly
3. DockerDesktopアプリを立ち上げる
4. `docker-compose up -d --build`

  **Laravel環境構築**
1. `docker-compose exec php bash`
2. `apt-get update && apt-get install -y git unzip`
3. `composer clear-cache`
4. `composer install --prefer-source`
5. 「.env.example」ファイルを 「.env」ファイルに命名を変更。または、新しく.envファイルを作成
6. .envに以下の環境変数を追加
``` text
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```


## 使用技術(実行環境)
- PHP8.1.33
- Laravel8.83.8
- MySQL8.0

- ## URL
- 開発環境：http://localhost/
- phpMyAdmin:：http://localhost:8080/
