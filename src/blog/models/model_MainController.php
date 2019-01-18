<?php 

class Model_MainController extends Model
{
	public function setData($data=NUll)
	{



		$host = '127.0.0.1';
	    $db   = 'children';
	    $user = 'root';
	    $pass = 'toor';
	    $charset = 'utf8';

	    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
	    $opt = [
	        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	        PDO::ATTR_EMULATE_PREPARES   => false,
	    ];
	    $pdo = new PDO($dsn, $user, $pass, $opt);
		

	    foreach ($data as $value) {
	    	// Дата записи в бд
	    	$dateOfRecord =  date('d-m-y', mktime (0, 0, 0, date('m'), date('d'), date('y')));
	    	// Очередь
			$queue = $value['queue ']; 
			// № заявления
			$applicationNumber = $value['applicationNumber']; 
			// Статус заявления
			$applicationStatus = $value['applicationStatus']; 
			// Тип льготы
			$facilities = $value['facilities']; 
			// Дата рождения
			$dateOfBirth = $value['dateOfBirth']; 
			// Дата регистрации
			$dateOfRegistration = $value['dateOfRegistration']; 

			// Fields
			// $Fields[] = "date";
			// $Fields[] = "queue";
			// $Fields[] = "applicationNumber";
			// $Fields[] = "applicationStatus";
			// $Fields[] = "facilities";
			// $Fields[] = "dateOfBirth";
			// $Fields[] = "dateOfRegistration";

			// Values
			$values[] = $dateOfRecord;
			$values[] = $queue;
			$values[] = $applicationNumber;
			$values[] = $applicationStatus;
			$values[] = $facilities;
			$values[] = $dateOfBirth;
			$values[] = $dateOfRegistration;


			$sql = "INSERT INTO children (dateOfRecord, queue, applicationNumber, applicationStatus, facilities, dateOfBirth, dateOfRegistration) VALUES ($dateOfRecord, $queue, $applicationNumber, $applicationStatus, $facilities, $dateOfBirth, $dateOfRegistration)";
			$stm = $pdo->prepare($sql);
			$stm->execute($values);


		}
	}

}