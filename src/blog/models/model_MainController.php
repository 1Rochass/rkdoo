<?php 

class Model_MainController extends Model
{
	public $childrenGroups; // Children groups/ 3-4 years, 4-5 years e.t.c.
	public $dateOfRecord; // Time now

	

	public function setData($data=NUll)
	{

	    foreach ($data as $value) {
	    	// Дата записи в бд
	    	$this->dateOfRecord =  date('Y-m-d', mktime (0, 0, 0, date('m'), date('d'), date('y')));
	    	// Очередь
			$queue = $value['queue ']; 
			// № заявления
			$applicationNumber = $value['applicationNumber']; 
			// Статус заявления
			$applicationStatus = $value['applicationStatus']; 
			// Тип льготы
			$facilities = $value['facilities']; 
			// Дата рождения
			$dateOfBirth = date('Y-m-d', strtotime($value['dateOfBirth'])); 
			// Дата регистрации
			$dateOfRegistration = date('Y-m-d', strtotime($value['dateOfRegistration'])); 

			// Fields
			// $Fields[] = "date";
			// $Fields[] = "queue";
			// $Fields[] = "applicationNumber";
			// $Fields[] = "applicationStatus";
			// $Fields[] = "facilities";
			// $Fields[] = "dateOfBirth";
			// $Fields[] = "dateOfRegistration";

			// Values
			$values[':dateOfRecord'] = $dateOfRecord;
			$values[':queue'] = $queue;
			$values[':applicationNumber'] = $applicationNumber;
			$values[':applicationStatus'] = $applicationStatus;
			$values[':facilities'] = $facilities;
			$values[':dateOfBirth'] = $dateOfBirth;
			$values[':dateOfRegistration'] = $dateOfRegistration;


			
			
			// Check
			$stm = $this->pdo->prepare("SELECT * FROM children WHERE applicationNumber = :applicationNumber");
			$stm->execute(array(':applicationNumber' => $applicationNumber));
			$result = $stm->fetchObject();

			// var_dump($result);
			// exit();

			if ($result != false) 
			{
			    // echo 'The telephone number: ' . $telephone. ' is already in the database<br />';
			}
			else 
			{
			      // Insert
				$stm = $this->pdo->prepare("INSERT INTO children (dateOfRecord, queue, applicationNumber, applicationStatus, facilities, dateOfBirth, dateOfRegistration) VALUES (:dateOfRecord, :queue, :applicationNumber, :applicationStatus, :facilities, :dateOfBirth, :dateOfRegistration)");
				$stm->execute($values);
			}
			

		}
		
	}
	// Get data fo children between 3 and 4 eyars old
	public function getData()
	{
		// Prepare for anti sqlinserting???
		$stm = $this->pdo->prepare("SELECT * FROM children WHERE dateOfBirth BETWEEN :startDate and :endDate");

		// Make dates for group 3-4 yars old
		$threeYarsLater = date("Y-m-d", mktime(0, 0, 0, date('m')-36, date('d'), date('y')));
		$fourYarsLaatter = date("Y-m-d", mktime(0, 0, 0, date('m')-48, date('d'), date('y')));

		// Execute
		$stm->execute(array(':startDate'=>$fourYarsLaatter, ':endDate'=>$threeYarsLater));

		// Get assoc with data
		 $this->childrenGroups['3_4'] =  $stm->fetchAll(PDO::FETCH_ASSOC);
		 return $this->childrenGroups;
	}
		
	// Grafic 
	public function grafic() {
		// Count of children
		$grafic['countOfChildren'] =  count($this->childrenGroups['3_4']);
		// Number in queue
		$grafic['numberInQueue'];
		// date
		$grafic['dateOfRecord'] = $this->dateOfRecord;

		// Find number in queue
		for ($i=0; $i < $grafic['countOfChildren']; $i++) { 
			if (array_search('2015-07-06', $this->childrenGroups['3_4'][$i])) {

				$grafic['numberInQueue'] = $i + 1; // + 1 because people must count from 1 and not from 0
			}
		}

		

		// Save to db
		// Check
		$stm = $this->pdo->prepare("SELECT * FROM grafic WHERE dateOfRecord = :dateOfRecord");
		$stm->execute([':dateOfRecord'=>$grafic['dateOfRecord']]);
		$result = $stm->fetchObject();
		if ($result != false) {
			# code...
		}
		else {
			// Insert
			$stm = $this->pdo->prepare("INSERT INTO grafic (dateOfRecord, countOfChildren, numberInQueue) VALUES (:dateOfRecord, :countOfChildren, :numberInQueue)");
			$stm->execute([
				':dateOfRecord'=>$grafic['dateOfRecord'],
				 ':countOfChildren'=>$grafic['countOfChildren'],
				  ':numberInQueue'=>$grafic['numberInQueue']]);
		}
		
		// Take from db
		$stm = $this->pdo->prepare("SELECT * FROM grafic");
		$stm->execute();
		$grafic = $stm->fetchAll(PDO::FETCH_ASSOC);

		return $grafic;

		// echo "<pre>";
		// var_dump($this->childrenGroups['3_4']);
		// echo "<pre>";
		// exit();
	}
}