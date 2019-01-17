<?php 

class AppController extends Controller
{
	public function abraAction($BoundleName)
	{
		$view = new View();
		$view->generate($BoundleName, "abra.php");
	}
}