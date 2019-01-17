<?php 
class Route 
{
	static $ControllerName;
	static $ActionName;
	static $BoundleName;
	static $Error;

	static function start()
	{

		self::$ControllerName = "Main"; 
		self::$ActionName = "index";
		self::$BoundleName = "blog";

		$route = explode("/", $_SERVER['REQUEST_URI']);

		if(!empty($route[1])){

			self::$BoundleName = $route[1];	

		}
		if(!empty($route[2])){

			self::$ControllerName = $route[2];	

		}
		if(!empty($route[3])){

			self::$ActionName = $route[3];	

		}
		
		self::$ControllerName = self::$ControllerName . "Controller"; 
		self::$ActionName = strtolower(self::$ActionName) . "Action";

		// Проверяем наличие файла
		if (file_exists("../src/" . self::$BoundleName . "/controllers/" . self::$ControllerName . ".php")) {

			require_once "../src/" . self::$BoundleName . "/controllers/" . self::$ControllerName . ".php";

		}
		else {

			Route::$Error[] = "File " . Route::$ControllerName . ".php does not exist"; // Файл не найден

		}

		// Проверяем наличие класса
		if(class_exists(Route::$ControllerName)){

			$Controller = self::$ControllerName;
			$Action = self::$ActionName;

			$Controller = new $Controller();
			$Controller->$Action(Route::$BoundleName);

		}
		else{

			Route::$Error[] = "Class " . Route::$ControllerName . " does not exist"; // Класс не найден

		}
		

		// Запускаем вывод ошибок
		Route::error();
	}

	static function error()
	{
		if (count(Route::$Error) >= 1) {

			foreach (Route::$Error as $key => $value) {
			echo $value . "<br>";
			}
		}
		
	} 
} 