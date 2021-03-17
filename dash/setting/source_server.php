<?php
namespace dash\setting;


class source_server
{

	private static $load = null;


	private static function load()
	{
		if(self::$load === null)
		{
			$json = \dash\file::read(__DIR__. '/secret/source_server.secret.json');
			if($json && is_string($json))
			{
				$json = json_decode($json, true);
			}

			if(!is_array($json))
			{
				$json = [];
			}
			self::$load = $json;

		}

	}

	/**
	 * Get list of source server
	 *
	 * @return     array  The list.
	 */
	public static function get_list()
	{
		self::load();

		$result = [];
		if(is_array(self::$load))
		{
			foreach ($load as $key => $value)
			{
				$temp = [];

				if(isset($value['title']))
				{
					$temp['title'] = $value['title'];
				}

				if(isset($value['fuel']))
				{
					$temp['fuel'] = $value['fuel'];
				}

				$result[$key] = $temp;
			}
		}

		return $result;
	}



	public static function amin_jibres_ip()
	{
		return self::ip('amin-jibres');
	}


	public static function amin_business_ip()
	{
		return self::ip('amin-business');
	}


	private static function ip($_server_key)
	{
		self::load();

		if(isset(self::$load[$_server_key]['ip']))
		{
			return self::$load[$_server_key]['ip'];
		}

		return null;
	}
}
?>