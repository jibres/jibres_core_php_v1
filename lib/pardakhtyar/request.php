<?php
namespace lib\pardakhtyar;

class request
{
	private static $data = [];


	public static function start($_requestJson, $_type, $_addr)
	{
		self::clean();

		self::add('user_id', \dash\user::id());
		self::add('datecreated', date("Y-m-d H:i:s"));
		self::add('sendmd5', md5(json_encode($_requestJson, JSON_UNESCAPED_UNICODE)));
		self::add('send', json_encode($_requestJson, JSON_UNESCAPED_UNICODE));
		self::add('url', $_addr);
		self::add('sendtime', time());

		self::json_add('trackingNumber', $_requestJson);
		self::json_add('trackingNumberPsp', $_requestJson);
		self::json_add('requestRejectionReasons', $_requestJson);
		self::json_add('success', $_requestJson);
	}


	public static function save($_result)
	{
		self::add('responsemd5', md5(json_encode($_result, JSON_UNESCAPED_UNICODE)));
		self::add('response', json_encode($_result, JSON_UNESCAPED_UNICODE));
		self::add('responsetime', time());
		self::add('table', isset($_result['table']) ? $_result['table'] : null);
		self::add('request_id', isset($_result['request_id']) ? $_result['request_id'] : null);

		$diff = intval(self::get('sendtime'));
		self::add('diff', time() - $diff);

		self::save_db();
		self::clean();
	}


	private static function save_db()
	{
		if(!empty(self::$data))
		{
			\lib\pardakhtyar\db\check::insert(self::$data);
		}
	}


	private static function json_add($_index, $_array)
	{
		if(is_array($_array) && array_key_exists($_index, $_array))
		{
			self::add($_index, $_array[$_index]);
		}
	}


	private static function add($_key, $_value)
	{
		self::$data[$_key] = $_value;
	}

	private static function get($_key)
	{
		if(array_key_exists($_key, self::$data))
		{
			return self::$data[$_key];
		}
		return null;
	}


	// clean data to add new record
	private static function clean()
	{
		self::$data = [];
	}
}
?>
