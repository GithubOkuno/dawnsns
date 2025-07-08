<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/style.css">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
</head>
<body>
    <header>
        <div id = "head">
        <h1><a><img src="/images/main_logo.png"></a></h1>
            <div id="">
                <div id="" class="head-username">
                    <p>{{Auth::user()->username}}さん<img src="/storage/images/{{Auth::user()->images}}" alt="" class="user-icon"></p>
                <div>
                <ul class="nav-menu">
                    <li><a href="/top">ホーム</a></li>
                    <li><a href="/profile">プロフィール</a></li>
                    <li><a href="/logout">ログアウト</a></li>
                </ul>
            </div>
        </div>
    </header>
    <div id="row">
        <div id="container">
            <!--posts>index.blade.phpの内容を表示-->
            @yield('content')
        </div >
        <div id="side-bar">
            <div id="confirm">
                <p>{{Auth::user()->username}}さんの</p>
                <div class="inline-paragraphs">
                <p>フォロー数</p>
                <p>{{$countfollow}}名</p>
                </div>
                <p class="listbtn"><a href="/followList" class="btn">フォローリスト</a></p>
                <div class="inline-paragraphs">
                <p>フォロワー数</p>
                <p>{{$countfollower}}名</p>
                </div>
                <p class="listbtn"><a href="/followerList" class="btn">フォロワーリスト</a></p>
            </div>
            <p class="searchbtn"><a href="/search" class="btn">ユーザー検索</a></p>
        </div>
    </div>
    <footer>
    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="js/style.js"></script>
</body>
</html>
