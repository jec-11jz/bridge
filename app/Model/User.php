<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 */


class User extends AppModel {
    var $name = 'User';
    var $useTable = 'users';
    public $validate = array(
        'username' => array(
            // メールアドレスであること。
            'validEmail' => array(
                'rule' => array( 'email', true),
                'message' => 'メールアドレスを入力して下さい'
            ),
            // 一意性チェック
            'emailExists' => array(
                'rule' => 'isUnique',
                'message' => 'メールアドレスは既に登録されています'
            ),
        ),
        'plain' => array(
             // パスワード・確認パスワードの一致
             'match' => array(
                 'rule' => array( 'confirmPassword', 'plain', 'plain_confirm'),
                 'message' => 'Passwords do not match'
             ),
        )
    );

    public function confirmPassword( $field, $plain, $plain_confirm) {
        if ($plain == $plain_confirm) {
          return true;
        }
    }
}
