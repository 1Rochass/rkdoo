<?php 

// Require phpQuery
require "phpQuery.php";

class PQ {
	
	public $html; // Html what we need to parse

	public $children; // Product data
	
	// Construct
	public function __construct( ) {
		
	}	

	// pQ save to DB
	public function pQsave( $data=NULL) {

		
	}



	// Parse links
	public function pQParseLinks () {

		// Get html for parsing 
		$this->html = file_get_contents( $this->folderToSave . "/" . $this->file );
		// Make main object
		$pq = phpQuery::newDocument( $this->html );
		// Find "a" tags from class ".products"
		$elements = $pq->find( ".woocommerce-LoopProduct-link" );
		
		foreach ($elements as $a) {
			// Make phqQuery object	
			$a = pq( $a );	
			// Get attr
			$links[] = $a->attr( "href" );
		}

		// Check parsing links
		if ( count( $links ) == 0 ) {
			return "0 links has parsed";
		}

		// Save products links
		$links = array_unique( $links ); // Make unique links

		// Make, open and save file with data
		$fileName =  str_replace( "html_", "", $this->file ); // Delete prefix "html_"

		$file = fopen( $this->folderToSave . "/links_" . $fileName, "w+" ); // Open file
		fwrite( $file, implode("\r\n", $links) ); // Write data
		fclose( $file ); // Close file

		return count( $links ) . " links has parsed";
	} 

	// Parse images 
	public function pQParseImages() {

		// Make main object
		$pq = phpQuery::newDocument( $this->html );


		$element = $pq->find(".views2-img img");
		
		// Get attr from DOM element!!!
		foreach ($element as $value) {
			
			$attr = pq( $value );
			// $href[] = $attr->attr("src")


			// Get image link
			$src = $attr->attr("src");
			

			$src = "http://csv/sait-to-parse/" . $src; 

			// Basename for saving
			$imgBaseName = basename( $src );

			// Make and save piccture
			$img = file_get_contents( $src );
			file_put_contents( "img/" . $imgBaseName, $img );

		}
	}


	// Parse product
	public function pQParseChildren ( $html ) {

		// Make main phpquery object
		$pq = phpQuery::newDocument( $html );


		foreach ($pq->find("tbody tr") as $key => $value) {
			$tr = pq($value);
			// doo
			$doo = $tr->find("td:nth-child(1)");
			$children[$key]['doo'] = $doo->attr("class");
			// № заявления
			$children[$key]['applicationNumber'] = $tr->find("td:nth-child(2)")->text();
			// Статус заявления
			$children[$key]['statusOfApplication'] = $tr->find("td:nth-child(3)")->text();
			// Тип льготы
			$children[$key]['facilities'] = $tr->find("td:nth-child(4)")->text();
			// Дата рождения
			$children[$key]['dateOfBirth'] = $tr->find("td:nth-child(5)")->text();
			// Дата регистрации
			$children[$key]['dateOfRegistration'] = $tr->find("td:nth-child(6)")->text();

			

		}
		

			return $children;
		

		

	}

}


