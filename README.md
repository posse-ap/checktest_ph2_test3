## 準備手順

以下の手順に従ってチェックテスト用の環境を準備してください

```
docker compose down -v
docker compose build --no-cache
docker compose up -d
```

MySQLは初回起動時に`./db/import.sql`が自動でインポートされます（手動で/import.shを実行する必要はありません）。

コンテナの一覧は以下で確認できます。
```
docker ps --format 'table {{.Names}}\t{{.Status}}'
```

phpfpmコンテナで以下のコマンドを実行してください。

```
docker exec -it checktest-phpfpm composer install
docker exec -it checktest-phpfpm vendor/bin/phpunit
```

コマンド実行後に
```
FAILURES!
Tests: 6, Assertions: 6, Failures: 5.
```
と出力されれば準備完了です

## テストの実行
解答用のPHPファイルは以下になります
```
./src/app/Exam.php
```

Case1〜Case5 に実装要件が記載されているので
要件にしたがってデータベース検索処理を実装してください

phpfpmコンテナで以下コマンドを実行すると
解答のチェックが出来ます
```
docker exec -it <phpfpmコンテナのID> vendor/bin/phpunit
```
