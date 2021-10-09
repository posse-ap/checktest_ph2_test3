<?php

namespace App;

use PDO;

class Exam
{
    // DB検索するプログラムを書いてほしいです
    // 各functionのコメントに必要なデータの条件を書いているので、満たすよう実装お願いします
    // 
    // テーブル構成の詳細はmysqlコンテナに入って確認してください
    // 接続方法はmysqlコンテナで以下のコマンドを実行
    // mysql -h localhost -u laravel -p
    // ※パスワードは password です
    // use laravel;
    // show tables;
    // desc depts;
    // desc employees;
    // desc salary;
    // ※salaryテーブルはレコードの削除時に論理削除を行うようになっています
    // ※deleted_atに日付が入っているレコードは削除されているレコードです
    // ※検索時に deleted_at is null の条件を追加してください
    // 
    // 動作確認方法
    // docker exec -it <phpfpmコンテナのID> vendor/bin/phpunit
    // 
    // 以下実行時のイメージ（全部正解）
    // kotani@ap-kotani:~/checktest_ph3_test3-master$ docker exec -it 07785cc5eb5a vendor/bin/phpunit
    // 〜〜〜（省略）〜〜〜
    // OK (6 tests, 6 assertions)
    // kotani@ap-kotani:~/checktest_ph3_test3-master$
    // 
    // 
    // 以下実行時のイメージ（1問不正解）
    // kotani@ap-kotani:~/checktest_ph3_test3-master$ docker exec -it 07785cc5eb5a vendor/bin/phpunit
    // 〜〜〜（省略）〜〜〜
    // FAILURES!
    // Tests: 6, Assertions: 6, Failures: 1.
    // kotani@ap-kotani:~/checktest_ph3_test3-master$

    // サンプル
    // 条件：
    // 　部署テーブルの件数を取得してください
    // 　クエリビルダのみで結果を取得してください
    // 採点：
    // 　結果がOK：100点
    public function Sample()
    {
        $db = new PDO('mysql:host=mysql;dbname=laravel;charset=utf8;', 'laravel', 'password');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT count(*) from depts';
        $ret = $db->query($sql)->fetchColumn();

        var_dump('Sample:' . $ret);
        return $ret;
    }


    // 実装依頼1つ目
    // 条件：
    // 　全社員の人数をカウントして返却してください
    // 採点：
    // 　結果がOK：30点
    public function Case1()
    {
        $db = new PDO('mysql:host=mysql;dbname=laravel;charset=utf8;', 'laravel', 'password');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT count(*) from depts';
        $ret = $db->query($sql)->fetchColumn();

        var_dump('Case1:' . $ret);
        return $ret;
    }

    // 実装依頼2つ目
    // 条件：
    // 　従業員の中で最も低い年齢を返却してください
    // 採点：
    // 　結果がOK：20点
    public function Case2()
    {
        $db = new PDO('mysql:host=mysql;dbname=laravel;charset=utf8;', 'laravel', 'password');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT count(*) from depts';
        $ret = $db->query($sql)->fetchColumn();

        var_dump('Case2:' . $ret);
        return $ret;
    }

    // 実装依頼3つ目
    // 条件：
    // 　2020年で一番年収が高い従業員の年収を返却してください
    // 採点：
    // 　結果がOK：20点
    public function Case3()
    {
        $db = new PDO('mysql:host=mysql;dbname=laravel;charset=utf8;', 'laravel', 'password');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT count(*) from depts';
        $ret = $db->query($sql)->fetchColumn();

        var_dump('Case3:' . $ret);
        return $ret;
    }

    // 実装依頼4つ目
    // 条件：
    // 　社員数が一番多い部署の部署名を返却する
    // 採点：
    // 　結果がOK：20点
    public function Case4()
    {
        $db = new PDO('mysql:host=mysql;dbname=laravel;charset=utf8;', 'laravel', 'password');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT count(*) from depts';
        $ret = $db->query($sql)->fetchColumn();

        var_dump('Case4:' . $ret);
        return $ret;
    }

    // 実装依頼5つ目
    // 条件：
    // 　2019年から2020年で年収が一番上がった人の名前を返却する
    // 採点：
    // 　結果がOK：10点
    public function Case5()
    {
        $db = new PDO('mysql:host=mysql;dbname=laravel;charset=utf8;', 'laravel', 'password');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT count(*) from depts';
        $ret = $db->query($sql)->fetchColumn();

        var_dump('Case5:' . $ret);
        return $ret;
    }
}
