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
		$group3_4 = $model->getData();
		$grafic = $model->grafic();

		// View
		$view = new View();
		$view->generate($BoundleName, "index.php", $data = array('group3_4'=>$group3_4, 'grafic'=>$grafic));

		
		
	}

}