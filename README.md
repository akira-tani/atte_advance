# Atte 勤怠管理システム

## 目次
|  番号  |  項目  |
| :----: | :--- |
| 1 | [URL](#1url) |
| 2 | [概要](#2概要)|
| 3 | [製作背景](#3製作背景) |
| 4 | [目的](#4目的) |
| 5 | [使用画面のイメージ](#5使用画面のイメージ) |
| 6 | [使用技術、バージョン](#6使用技術バージョン) |
| 7 | [環境構築手順](#7環境構築手順) |
| 8 | [機能一覧](#8機能一覧) |
| 9 | [DB設計](#9db設計) |
| 10 | [インフラ構成図](#10インフラ構成図) |

## 1.URL
* Herokuデプロイ_URL：

## 2.概要
出勤・退勤時刻の記録、休憩時間の記録、毎日の勤務時間の記録を行い、勤怠管理業務を支援するためのシステムです。

## 3.製作背景
※以下は記載例であり、スクールの模擬案件として本システムを作成しました。  
  
市販されている勤怠管理システムの導入にあたり、以下のような課題に直面しました。  
* 勤怠管理システムの導入コストが高い  
* 求めていない機能が多く、ユーザビリティが低い  

そこで、勤怠管理システムの導入コストを抑え、かつ、最低限の機能に特化することでユーザビリティを優先した勤怠管理システムを作成しました。

## 4.目的
主な目的は以下を行うことで勤怠管理業務を支援することです。  
* 出勤・退勤時刻の記録  
* 休憩時間の記録  
* ユーザー毎、日付毎の勤務時間の表示  

## 5.使用画面のイメージ
### ユーザー登録画面
|![localhost_8000_register](https://user-images.githubusercontent.com/96828647/174489283-159afd54-a755-412b-91ae-f99940a6b3cf.png)|
| ---- |
### ログイン画面
|![localhost_8000_login](https://user-images.githubusercontent.com/96828647/174489291-c429b596-0b74-40b8-8c03-99e52010c1e0.png)|
| ---- |
### 勤務・休憩時刻打刻画面
|![localhost_8000_](https://user-images.githubusercontent.com/96828647/174489302-3b0376a8-2d79-4e68-adf5-287683bd4eb1.png)|
| ---- |
### 日付別勤務時間表示画面
|![localhost_8000_attendance](https://user-images.githubusercontent.com/96828647/174489308-139d2b0c-25ec-44ca-9ab3-ba34f0d70259.png)|
| ---- |

### ユーザー別勤務時間表示画面
|![localhost_8000_user](https://user-images.githubusercontent.com/96828647/179729892-6e3672d7-0008-4afa-92ea-56c8d01c8e46.png)|
| ---- |

### ユーザー別勤務時間(詳細)表示画面
|![localhost_8000_user1](https://user-images.githubusercontent.com/96828647/179730609-6736a449-4efd-4370-ada0-846d6e84044d.png)|
| ---- |


## 6.使用技術、バージョン
* フロントエンド
  + HTML / CSS
* バックエンド
  + PHP 7.4.27
  + Laravel Framework 8.83.12
* インフラ、その他
  + MySQL 10.4.22-MariaDB
  + Visual Studio Code
  + draw.io

## 7.環境構築手順
1. Click [Use this template](https://github.com/ucan-lab/docker-laravel/generate)
2. Git clone & change directory
3. Execute the following command

```bash
$ make create-project # Install the latest Laravel project
$ make install-recommend-packages # Optional
```

http://localhost

## 8.機能一覧
* ユーザー関連
  + 会員登録 / ログイン / ログアウト
* 勤怠打刻関連
  + 勤務開始・終了の打刻
  + 休憩開始・終了の打刻
* 勤怠情報取得関連
  + 日付別勤怠情報の表示 
  + ユーザー別勤怠情報の表示

## 9.DB設計
### ER図
![er](https://user-images.githubusercontent.com/96828647/174491845-6d5a7ff3-fc19-4884-a5dc-5bc4d0397972.png)

### テーブル設計
![table](https://user-images.githubusercontent.com/96828647/174491848-deb58469-56df-4c75-8de3-eee863537bce.png)

### 基本設計 
![basic_design1](https://user-images.githubusercontent.com/96828647/179731935-672d6bd0-01a1-4e9b-9310-c1c7f24994b5.png)
![basic_design2](https://user-images.githubusercontent.com/96828647/179732041-5510b1a5-d3c8-4406-a505-5b99823353cf.png)
![basic_design3](https://user-images.githubusercontent.com/96828647/179732118-304fd579-bf6e-4be1-97b2-98bebda91259.png)

## 10.インフラ構成図
### Container structures

```bash
├── app
├── web
└── db
```

### app container

- Base image
  - [php](https://hub.docker.com/_/php):8.1-fpm-bullseye
  - [composer](https://hub.docker.com/_/composer):2.2

### web container

- Base image
  - [nginx](https://hub.docker.com/_/nginx):1.22

### db container

- Base image
  - [mysql/mysql-server](https://hub.docker.com/r/mysql/mysql-server):8.0

### mailhog container

- Base image
  - [mailhog/mailhog](https://hub.docker.com/r/mailhog/mailhog)
"atte-advance" 
>>>>>>> origin/main
