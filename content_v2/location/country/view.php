<?php
namespace content_v2\location\country;


class view
{
	public static function config()
	{
		$data = \dash\utility\location\countres::$data;
		$new_data = [];
		foreach ($data as $key => $value)
		{
			if(is_array($value) && array_key_exists('name', $value) && array_key_exists('localname', $value))
			{
				$temp         = $value;
				$temp['id']   = $key;
				$temp['text'] = $value['localname'] ? $value['localname'] : $value['name'];
				$temp['flag'] = \dash\url::site(). '/static/img/flags/png100px/'. mb_strtolower($key). '.png';

				if(empty($new_data))
				{
					$new_data[] = ['id' => 0, 'text' => T_("Please choose country"), 'disable' => true];
				}

				$new_data[]   = $temp;
			}
		}
		$data = $new_data;




		\content_v2\tools::say($data);
	}
}
?>