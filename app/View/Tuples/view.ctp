<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="bridge team">
        <link rel="shortcut icon" href="">
        <title>Bridge</title>
        
        <?php
            echo $this->Html->css('bootstrap.min');
            echo $this->Html->script('bootstrap.min');
        ?>
        
        <style>
            html, body {
                height: 100%;
                margin: 0;
                padding: 0;
            }
            body {
            }
            div.container {
                margin: 0;
                padding: 0;
                height: auto !important;
                height: 100%;
                min-height: 100%;
                width: 100%;
                min-width: 860px;
            }
            .side-menu {
                width: 200px;
                height: 100%;
                position:absolute;
                background-color: #272B2E;
                color: #DDDDDD;
                float: left;
            }
            div.main {
                width: 100%;
                min-width: 600px;
                margin-left: 210px;
                position: relative;
                height: 100%;
                float: left;
            }
            .line-up {
                margin: 0;
                padding: 0;
                margin-top: 60px;
            }
            .side-menu ul, .side-menu li {
                margin: 0;
                padding: 0;
            } 
            .side-menu li {
                list-style-type: none;
                background-color: #373B3E;
            }
            .side-profile {
                width: 100%;
                height: 100%;
                margin: 0 auto;
                text-align: center;
                background-color: #2F3334;
            }
            .side-menu .menu {
                margin-top: 20px;
            }
            .side-menu .menu .icon {
                width: 20px;
                height: 20px;
                text-align: center;
                margin: 0;
                padding: 0;
            }
            .side-menu .menu .name {
                margin-left: 10px;
            }
            .side-menu li:hover {
                background-color: #474B4E;
            }
            .side-menu li.active {
                background-color: #DDDDDD;
                color: #333;
                border-top: solid 1px #111;
                border-bottom: solid 1px #111;
            }
            .side-menu li.active a {
                color: #333;
            }
            .side-menu li a {
                margin: 0;
                padding: 0;
                width: 100%;
                height: 100%;
                color: #DDDDDD;
                padding: 10px 5px;
                margin: 1px 0;
                display: block;
                text-decoration: none;
            }
            header {
                width: 100%;
            }
        </style>
    </head>
    <body>
        <div class="navbar navbar-inverse navbar-fixed-top">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#">Bridge</a>
            </div>
          </div>
        </div>
        
        <div class="container">
            <div class="side-menu">
                <div class="line-up">
                    <div class="side-profile">
                        <div class="profile-img">
                            <img width="100" height="100" src="https://dl.dropboxusercontent.com/s/btgabekoka9fnm3/clover.png?token_hash=AAG1ypWwPuQtKlUJ8VVIY9ode6gj2ZjaNPpi8CFM5xapyA&dl=1" />
                        </div>
                        <div class="profile-nickname">
                            たかや
                        </div>
                    </div>
                    <ul class="menu">
                        <li>
                            <a href="#">
                                <span class="icon glyphicon glyphicon-home"></span>
                                <span class="name">ダッシュボード</span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="#">
                                <span class="icon glyphicon glyphicon-pencil"></span>
                                <span class="name">タプル新規作成</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="icon glyphicon glyphicon-th-list"></span>
                                <span class="name">タプル一覧</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="icon glyphicon glyphicon-search"></span>
                                <span class="name">タプルを検索</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="icon glyphicon glyphicon-wrench"></span>
                                <span class="name">設定</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="main">
                <div class="line-up">
                    <div>
                        <header>
                            <h1>タプル - 新規作成</h1>
                            <ol class="breadcrumb">
                                <li><a href="#">タプル</a></li>
                                <li class="active">新規作成</li>
                            </ol>
                        </header>
                        <div class="main-content">
                            <form role="form">
                                <div class="form-group">
                                    <label for="inputTupleTitle">タイトル</label>
                                    <input type="text" class="form-control" id="inputTupleTitle" name="tupleTitle" placeholder="タイトル" />
                                </div>
                                <div class="form-group">
                                    <label for="inputTupleContent">本文</label>
                                    <textarea class="form-control" rows="10" id="inputTupleContent" name="tupleContent"></textarea>
                                </div>
                            </form>
                            Tuple Title<br />
                            Tuple Editor<br />
                            Tuple Setting<br />
                            Buttons<br />
                            パンくずリストをリボン化してヘッダーとコンテンツの境界線とする
                            
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container -->
    </body>
</html>