## 準備手順
コンテナを起動してください
```
docker-compose build --no-cache
docker-compose up -d
```

phpfpmコンテナとmysqlコンテナのCONTAINER IDを確認してください
```
docker ps
```
```
docker exec -it <mysqlコンテナのID>  /import.sh
例）docker exec -it 08361d943c93 /import.sh
※Warningが出ても大丈夫です
```
```
docker exec -it <phpfpmコンテナのID> composer install
docker exec -it <phpfpmコンテナのID> vendor/bin/phpunit
例）docker exec -it 07785cc5eb5a composer install
例）docker exec -it 07785cc5eb5a vendor/bin/phpunit
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
