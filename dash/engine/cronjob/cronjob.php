<?php

class cronjob
{
	private static function server_detail()
	{
		$array = [];

		$dir = '/home/nora/jibres/dash/setting/secret/servername.secret.json';

		// $dir = '/home/reza/projects/jibres/dash/setting/secret/servername.secret.json';

		if(is_file($dir))
		{
			$json = file_get_contents($dir);
			$array = json_decode($json, true);
			if(!is_array($array))
			{
				$array = [];
			}
		}

		return $array;
	}


	public static function run()
	{
		$gethostname = gethostname();

		$server_detail = self::server_detail();

		// run jibres for public cronjob. sql error ...
		$run_jibres   = true;

		// run business cronjb if enabled
		$run_business = false;

		$tld = 'ir';

		foreach ($server_detail as $key => $value)
		{
			if(isset($value['hostname']) && $value['hostname'] === $gethostname)
			{
				if(isset($value['cronjob_tld']) && $value['cronjob_tld'])
				{
					$tld = $value['cronjob_tld'];
				}

				if(isset($value['cronjob']) && is_array($value['cronjob']))
				{
					if(in_array('business', $value['cronjob']))
					{
						$run_business = true;
					}
				}
			}
		}

		// this directory
		$list_stores_addr = __DIR__;
		$list_stores_addr = str_replace('dash/engine/cronjob', '', $list_stores_addr);
		// master jibres directory
		$jibres_addr = $list_stores_addr;

		// store setting file directory
		$list_stores_addr = substr($list_stores_addr, 0, -7);
		$list_stores_addr .= 'jibres_temp/stores/subdomain/';

		// generate trust token by random
		$trust_token = self::generate_trust_token();

		// index.php directory
		$index_php_addr = $jibres_addr. "public_html/index.php";

		$SERVER_NAME = 'jibres.'. $tld;

		// fake $SERVER
		$server =
		[
			'trust_token'     => $trust_token,
			'HTTP_HOST'       => null, // "change by customer host",
			'SERVER_NAME'     => $SERVER_NAME,
			'SERVER_PORT'     => "443",
			'SERVER_PROTOCOL' => "HTTP/1.1",
			'REQUEST_URI'     => "/hook/crontab/". $trust_token,
			'REQUEST_METHOD'  => "POST",
			'SERVER_ADDR'     => '1.1.1.1',
			'REMOTE_ADDR'     => '1.1.1.1',
			'HTTP_USER_AGENT' => 'Jibres-cronjob',
			'HTTP_COOKIE'     => 'Jibres-cronjob-cookie',
			'SCRIPT_FILENAME' => $index_php_addr,
		];

		// execute list
		$exec                = [];

		if($tld === 'store')
		{
			// run jibres master crontab
			$server['HTTP_HOST'] = 'jibres.ir';
		}
		else
		{
			$server['HTTP_HOST'] = 'jibres.'. $tld;
		}

		$store_exec = 'php '. $index_php_addr. " '". json_encode($server, JSON_UNESCAPED_UNICODE). "' ";
		$exec[]     = $store_exec;


		$list_stores = [];

		if(is_dir($list_stores_addr) && $run_business)
		{
			// load other store name
			$list_stores = glob($list_stores_addr. '*.conf');
		}

		if(!empty($list_stores))
		{
			foreach ($list_stores as $key => $value)
			{
				$subdomain           = str_replace($list_stores_addr, '', $value);
				$subdomain           = str_replace('.conf', '', $subdomain);
				$HTTP_HOST           = $subdomain. '.'. $SERVER_NAME;
				$server['HTTP_HOST'] = $HTTP_HOST;
				$store_exec = 'php '. $index_php_addr. " '". json_encode($server, JSON_UNESCAPED_UNICODE). "' ";
				$exec[] = $store_exec;
			}
		}

		$exec_addr = __DIR__. '/exec.me.php';

		$chunk = array_chunk($exec, 10);

		$new_exec = [];

		foreach ($chunk as $part)
		{
			$new_exec[] = implode(' & ', $part);
		}

		$exec = implode(' && ', $new_exec);

		// $exec = implode(" & ", $exec);

		file_put_contents($exec_addr, $exec);

		$exec_php = 'cd '. $jibres_addr. 'public_html && sh '. $exec_addr;

		$result = shell_exec($exec_php);

		file_put_contents(__DIR__. '/resultexect.me.log', $result);

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