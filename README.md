bridge
======

### GitHubに登録したFuelPHPアプリケーションをcloneする

保存したいディレクトリで以下のコマンドを実行

	git clone --recursive git://github.com/jec-11jz/bridge.git
	
一部をサブモジュールとして管理しているため、

通常のクローンではすべてをローカルに持ってくることはできない

### おすすめのGitクライアント

1. [SourceTree](https://itunes.apple.com/jp/app/sourcetree-git-hg/id411678673?mt=12)

![SourceTree画像](http://sourcetreeapp.com/images/sourcetree_hero_mac_history.png)
 
2. [GitHub](http://mac.github.com/)

![GitHub画像](https://a248.e.akamai.net/camo.github.com/f5136c6dc444ac0997859de78c8f951deb2ff45d/687474703a2f2f6769746875622d696d616765732e73332e616d617a6f6e6177732e636f6d2f626c6f672f323031312f6d61632d312e312d73637265656e73686f74732f726564657369676e2d63726f707065642e706e67)

### 開発フロー

個人的にGitHub-Flowってものを推奨

下画像はGit-Flowのものだが、もっとシンプルにmasterと各featureだけでいい


参考サイト１：[GitHub Flow](https://gist.github.com/Gab-km/3705015)
> 
> * masterブランチのものは何であれデプロイ可能である
> * 新しい何かに取り組む際は、説明的な名前のブランチをmasterから作成する（例: new-oauth2-scopes）
> * 作成したブランチにローカルでコミットし、サーバー上の同じ名前のブランチにも定期的に作業内容をpushする
> * フィードバックや助言が欲しい時、ブランチをマージしてもよいと思ったときは、 プルリクエスト を作成する
> * 他の誰かがレビューをして機能にOKを出してくれたら、あなたはコードをmasterへマージすることができる
> * マージをしてmasterへpushしたら、直ちにデプロイをする

参考サイト２：[Gitでの開発の流れを理解する](http://xerial.org/scala-cookbook/recipes/2012/11/16/git-flow/)

> ![Git-Flow画像](http://xerial.org/scala-cookbook/capture/2012-11/gitflow.png)