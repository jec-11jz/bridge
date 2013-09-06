<?php
    echo $this->Form->create( 'User', array( 'type'=>'post', 'url'=>'signup'));
    // ユーザ名
    echo $this->Form->text( 'username', array( 'maxlength' => '255'));
    echo $this->Form->error('username');
    // パスワード
    echo $this->Form->text( 'plain', array( 'maxlength' => '50', 'type' => 'password'));
    echo $this->Form->error('plain');
    // パスワード確認用
    echo $this->Form->text( 'plain_confirm', array( 'maxlength' => '50', 'type' => 'password'));
    echo $this->Form->error('plain_confirm');
    echo $this->Form->end();
?>