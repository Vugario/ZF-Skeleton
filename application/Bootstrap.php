<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

	protected function _initRequest()
	{
		
		$this->db = Zend_Db::factory( 'Pdo_Mysql', array( 'host' => 'localhost', 'username' => 'root', 'password' => 'root', 'dbname' => 'forum' ) );
		
	}

}

