<?php

class MySql{

	private $con;
	public $stmt;
	private $result;
	public static $instance;
	
	
	
		public static function getInstance() {
	        if (!isset(self::$instance)) {
	            self::$instance = new PDO("mysql:host=127.0.0.1:3306;dbname=apiLiga", "root", "root",
	 array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	            self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
	        }

	        return self::$instance;
	    }

}








?>