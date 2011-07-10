<?php

abstract class My_Controller_Controller extends Zend_Controller_Action
{

    public function init()
    {
    	$this->db = Zend_Db::factory( 'Pdo_Mysql', array( 'host' => 'localhost', 'username' => 'root', 'password' => 'root', 'dbname' => 'forum' ) );
    }

}

