<?php 	
require_once "../app/core/route.php";
require_once "../app/core/controller.php";
require_once "../app/core/view.php";
require_once "../app/core/model.php";



// Autoloader
spl_autoload_register('autoload');

function autoload($className)
{
	$fileName = __DIR__ . "\..\src\blog\controllers\\" . $className . ".php";
	
	require_once $fileName;
}


// Запускает роутер
Route::start();
