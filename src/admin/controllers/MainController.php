<?php 

class MainController extends Controller
{
	public function indexAction($BoundleName)
	{
		$view = new View();
		$view->generate($BoundleName, "index.php");
	}

}