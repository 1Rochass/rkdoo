<?php 	
require_once "../app/core/route.php";
require_once "../app/core/controller.php";
require_once "../app/core/view.php";
require_once "../app/core/model.php";



// Autoloader
spl_autoload_register('autoload');

function autoload($className)
{
	$fileName1 = __DIR__ . "\..\src\blog\controllers\\" . $className . ".php";
	if (file_exists($fileName1)) {
		require_once $fileName1;	
	}

	$fileName2 = __DIR__ . "\..\src\blog\models\\" . $className . ".php";
	if (file_exists($fileName2)) {
		require_once $fileName2;	
	}
	

}



// Запускает роутер
Route::start();
