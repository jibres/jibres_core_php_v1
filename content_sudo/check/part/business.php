<?php
namespace content_sudo\check\part;


class business
{

	private static function error()
	{
		var_dump(func_get_args());
		exit;
	}

	private static $counter = [];
	private static function counter($_key, $_meta = [])
	{
		if(isset(self::$counter[$_key]))
		{
			self::$counter[$_key]++;
		}
		else
		{
			self::$counter[$_key] = 1;
		}

		if($_meta && \dash\url::isLocal())
		{
			file_put_contents(__DIR__. '/temp.me.log', date("Y-m-d H:i:s"). "\n". json_encode($_meta, JSON_UNESCAPED_UNICODE). "\n", FILE_APPEND);
		}
	}


	public static function call_fn_in_all_store($_fn)
	{
		$start = microtime(true);

		$list = \lib\db\store\get::all_store_fuel_detail();

		\dash\code::time_limit(0);

		foreach ($list as $key => $value)
		{
			if(a($value, 'subdomain') !== 'rezamohiti')
			{
				// continue;
			}

			\dash\temp::set("CurrentBusiness", $value);

			\dash\engine\store::force_lock($value);

			call_user_func($_fn);

			\dash\db::close();
		}

		var_dump(self::$counter);
		var_dump(microtime(true) - $start);
		exit();
	}

	public static function who()
	{
		return \dash\temp::get('CurrentBusiness');
	}
}
?>