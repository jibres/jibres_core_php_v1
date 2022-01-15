<?php
namespace content_sudo\fix\agent;


class view
{

	public static function config()
	{
		if(\dash\request::get('agent'))
		{
			self::find();
		}
	}


	public static function find()
	{
		$start = microtime(true);

		$list = \lib\db\store\get::all_store_fuel_detail();



		\dash\code::time_limit(0);

		$result = [];

		$param = [];
		$param['md5'] = \dash\request::get('agent');

		foreach ($list as $key => $value)
		{

			\dash\temp::set("CurrentBusiness", $value);

			\dash\engine\store::force_lock($value);

			$query = "	SELECT * FROM agents where agents.agentmd5= :md5 LIMIT 1 ";

			$find_agnet = \dash\pdo::get($query, $param, null, true);
			if($find_agnet)
			{
				$result[] = a($value, 'subdomain');
			}


			\dash\pdo::close();
		}

		\dash\log::to_supervisor('#Convert sitebuilder complete '. date("Y-m-d H:i:s"). ' In :'. (microtime(true) - $start). 's' );

		var_dump($result);

		var_dump(microtime(true) - $start);
		var_dump('Complete in '. \dash\utility\human::time(microtime(true) - $start));
		exit();
	}



}
?>