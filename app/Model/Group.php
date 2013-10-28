<?php
	class Group extends AppModel {
    var $name = 'Group';
    var $actsAs = array('Acl' => 'requester');
     
    function parentNode() {
        return null;
    }
}
?>