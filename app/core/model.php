<?php 
class Model
{
	public $pdo; // PDO

	// Make PDO 
	public function __construct () {
		$host = '127.0.0.1';
	    $db   = 'children';
	    $user = 'root';
	    $pass = 'toor';
	    $charset = 'utf8';

	    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
	    $opt = [
	        // PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	        // PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	        // PDO::ATTR_EMULATE_PREPARES   => false,
	    ];
	    $this->pdo = new PDO($dsn, $user, $pass, $opt);
	}
	public function get_data()
	{
	}
}
