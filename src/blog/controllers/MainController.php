<?php 

class MainController extends Controller
{
	public function indexAction($BoundleName)
	{

		// Curl
		$curl = new Curl();
		$curlResponse = $curl->curlParse(); 	

		// Pq
		$pq = new PQ();
		$pqResponse = $pq->pQParseChildren($curlResponse);

		// Model
		$model = new Model_MainController();
		$model->setData($pqResponse);
		// $data = $model->getData();

		// View
		$view = new View();
		$view->generate($BoundleName, "index.php", $data);

		
		
	}

}