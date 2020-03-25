<?php
namespace dash;

class face
{
	private static $data = [];

	/**
	 * set and get values of html head
	 * @param  [type] $_variable [description]
	 * @param  [type] $_value    [description]
	 * @return [type]            [description]
	 */
	public static function __callStatic($_variable, $_value)
	{
		// if value is send, set it
		if(array_key_exists(0, $_value))
		{
			self::$data[$_variable] = $_value[0];
		}

		// return value
		if(isset(self::$data[$_variable]))
		{
			return self::$data[$_variable];
		}
		// if key is not set return null
		return null;
	}
}
?>