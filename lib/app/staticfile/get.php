<?php
namespace lib\app\staticfile;


class get
{
	public static function get_list()
	{

		$cat   = 'staticfile_verify';

		$result = \lib\app\setting\get::load_setting_once($cat);

		if(!is_array($result))
		{
			$result = [];
		}

		$setting = [];

		foreach ($result as $key => $value)
		{
			if(isset($value['key']) && array_key_exists('value', $value))
			{
				$setting[$value['key']] = $value['value'];
			}
		}


		return $setting;

	}

}
?>