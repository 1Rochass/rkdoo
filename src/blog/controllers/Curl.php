<?php

class Curl {

	public $html; // Parsed html

	public $curl_useragent;
	public $curl_useragent_path = "useragent.txt";

	public $curl_proxy;
	public $curl_proxy_path = "proxy.txt";

	// Construct
	public function __construct( ) {
		
	}

	// Curl parse
	public function curlParse( )
	{						
		$ch = curl_init( "https://rkdoo.ru/client/home/kindergarten-queue?scope=578" );

		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true ); // Сейвит результат в переменную

		//curl_setopt( $ch , CURLOPT_HEADER, true ); // Возвращает в переменную заголовки ( Для отладки )

		//curl_setopt( $ch, CURLOPT_NOBODY, true ); // Получает только заголовки ( HEADER )

		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true ); // Если редирект ( ошибка  302 на странице ) включает эту опцию 

		curl_setopt( $ch, CURLOPT_USERAGENT, 'Opera/9.80 (Windows NT 5.1; U; ru) Presto/2.9.168 Version/11.51' ); // хз

		

		// curl_setopt( $ch, CURLOPT_PROXY, '93.113.6.19' ); // хз 
		// http://free-proxy.cz	
		curl_setopt( $ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS4 ); // хз



		curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, false ); // Отключает проверки в https

		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false ); // Отключает проверки в https

		$html = curl_exec( $ch );

		curl_close( $ch );

		$this->html = $html;

		return $html;

	} 

}
