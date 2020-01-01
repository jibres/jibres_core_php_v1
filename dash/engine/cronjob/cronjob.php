<?php

class cronjob
{
	public static function run()
	{
		$list_stores_addr = __DIR__;
		$list_stores_addr = str_replace('dash/engine/cronjob', '', $list_stores_addr);
		$jibres_addr = $list_stores_addr;

		$list_stores_addr .= 'includes/stores/subdomain/';
		if(!is_dir($list_stores_addr))
		{
			self::save_log('stores subdomain addr not found!');
			return;
		}

		$list_stores = glob($list_stores_addr. '*');

		if(empty($list_stores))
		{
			self::save_log('stores subdomain folder is empty!');
			return;
		}

		// cun cronjob by this code
	// php /home/reza/projects/jibres/public_html/index.php '{"trust_token":"123","HTTP_HOST":"mohiti.jibres.local","SERVER_NAME":"jibres.local","SERVER_PORT":"80","SERVER_PROTOCOL":"HTTP/1.1","REQUEST_URI":"/a","REQUEST_METHOD":"POST","SCRIPT_FILENAME":"/home/reza/projects/jibres/public_html/index.php"}' &

		$trust_token = self::trust_token();

		$index_php_addr = $jibres_addr. "public_html/index.php";

		$server =
		[
			'trust_token'     => $trust_token,
			'HTTP_HOST'       => null, // "mohiti.jibres.local",
			'SERVER_NAME'     => null, // "jibres.local",
			'SERVER_PORT'     => "443",
			'SERVER_PROTOCOL' => "HTTP/1.1",
			'REQUEST_URI'     => "/aaahook/cronjob11",
			'REQUEST_METHOD'  => "POST",
			'SCRIPT_FILENAME' => $index_php_addr,

		];
		$SERVER_NAME = 'jibres.local';

		$exec = [];
		foreach ($list_stores as $key => $value)
		{
			$subdomain           = str_replace($list_stores_addr, '', $value);
			$HTTP_HOST           = $subdomain. '.'. $SERVER_NAME;
			$server['HTTP_HOST'] = $HTTP_HOST;
			$store_exec = 'php '. $index_php_addr. " '". json_encode($server, JSON_UNESCAPED_UNICODE). "' ";
			$exec[] = $store_exec;
		}

		if(empty($exec))
		{
			self::save_log('Exec list is empty!');
			return false;
		}

		$exec_addr = __DIR__. '/exec.me.php';
		$exec = implode(" & \n", $exec);

		file_put_contents($exec_addr, $exec);


		$exec_php = 'cd '. $jibres_addr. 'public_html && '. $exec;
		var_dump($exec_php);exit();

		exec($exec_php);

	}


	private static function trust_token()
	{
		return 111;
	}


	private static function save_log($_text)
	{
		// save text to file
	}

}
cronjob::run();
?>