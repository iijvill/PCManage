## 作業環境
以下の環境で開発を行い、動作の確認をしています。
- MacOS Mojave 10.14.6
- PHP 7.4.1
- Laravel 5.8
- MySQL 5.6

## 環境構築
言語はPHPで、フレームワークとしてLaravel 5.8 を使用しています。
Homebrewコマンドでそれぞれインストールしています。

Laravelはバージョンを指定しないと最新バージョンがインストールされるため、
```
composer create-project laravel/laravel=5.8 プロジェクト名 --prefer-dist
```
とし、バージョン指定を行ってください。

## 注意点
初めてリポジトリをcloneした状態だとLaravel本体が含まれるvendarディレクトリが存在せず、実行する事ができません。<br>
はじめに以下のコマンドを実行して各種ライブラリをインストールしてください。<br>
```
composer install
```
次に、データベースを用意します。データベースを起動させておきます。<br>
以下のコマンドを実行し、テーブルの作成とあらかじめ用意しておくデータを作成します。
```
php artisan migrate
```

```
php artisan db:seed
```

## 追加したライブラリとかの備忘録
- Carbon
    - Laravelの日付ライブラリ。
- SweetAlert2
    - ウェブページ上でいい感じのアラートを出してくれる。CDN経由で使ってます。
- UIKit
    - モダンな感じにしてくれるCSSのフレームワーク。layouts/app.blade.phpで設定しています。(UIKitが効いているとdump表記が満足になりません)
- List.js
    - テーブルの並べ替えで使用。テーブルヘッダーをクリックすると並べ替えできます。CDN経由で使ってます。