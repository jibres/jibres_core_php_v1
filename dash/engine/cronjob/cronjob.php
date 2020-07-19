<?php

class cronjob
{
	public static function run()
	{
		// this directory
		$list_stores_addr = __DIR__;
		$list_stores_addr = str_replace('dash/engine/cronjob', '', $list_stores_addr);
		// master jibres directory
		$jibres_addr = $list_stores_addr;

		// store setting file directory
		$list_stores_addr = substr($list_stores_addr, 0, -7);
		$list_stores_addr .= 'jibres_temp/stores/subdomain/';

		if(!is_dir($list_stores_addr))
		{
			self::save_log('stores subdomain addr not found!');
			return;
		}

		// generate trust token by random
		$trust_token = self::generate_trust_token();

		// index.php directory
		$index_php_addr = $jibres_addr. "public_html/index.php";


		$SERVER_NAME = 'jibres.ir';

		// fake $_SERVER
		$server =
		[
			'trust_token'     => $trust_token,
			'HTTP_HOST'       => null, // "change by customer host",
			'SERVER_NAME'     => $SERVER_NAME,
			'SERVER_PORT'     => "443",
			'SERVER_PROTOCOL' => "HTTP/1.1",
			'REQUEST_URI'     => "/hook/crontab/". $trust_token,
			'REQUEST_METHOD'  => "POST",
			'SCRIPT_FILENAME' => $index_php_addr,
		];

		// execute list
		$exec                = [];

		// run jibres master crontab
		$HTTP_HOST           = $SERVER_NAME;
		$server['HTTP_HOST'] = $HTTP_HOST;
		$store_exec          = 'php '. $index_php_addr. " '". json_encode($server, JSON_UNESCAPED_UNICODE). "' ";
		$exec[]              = $store_exec;
		// load other store name
		$list_stores = glob($list_stores_addr. '*');

		if(empty($list_stores))
		{
			// self::save_log('stores subdomain folder is empty!');
		}
		else
		{
			foreach ($list_stores as $key => $value)
			{
				$subdomain           = str_replace($list_stores_addr, '', $value);
				$HTTP_HOST           = $subdomain. '.'. $SERVER_NAME;
				$server['HTTP_HOST'] = $HTTP_HOST;
				$store_exec = 'php '. $index_php_addr. " '". json_encode($server, JSON_UNESCAPED_UNICODE). "' ";
				$exec[] = $store_exec;
			}
		}

		$exec_addr = __DIR__. '/exec.me.php';

		$exec = implode(" && ", $exec);

		file_put_contents($exec_addr, $exec);

		$exec_php = 'cd '. $jibres_addr. 'public_html && sh '. $exec_addr;

		shell_exec($exec_php);

	}


	private static function generate_trust_token()
	{
		$engine_addr = __DIR__;
		$engine_addr = str_replace('/cronjob', '', $engine_addr);
		$engine_addr .= '/cronjob_server.me.token';
		$rand        = random_bytes(100). ' '. microtime(). ' '. rand(). ' '. rand();
		$token       = md5($rand);
		file_put_contents($engine_addr, $token);
		return $token;
	}


	private static function save_log($_text)
	{
		// save text to file
		$_text = date("Y-m-d H:i:s"). ' ----- '. $_text;
		file_put_contents(__DIR__. '/cronjob.me.log', $_text);
	}
}
cronjob::run();
?>