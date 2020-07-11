<?php
namespace content_r10\location\province;


class view
{
	public static function config()
	{

		$new_data = [];
		$country = \dash\request::get('country');
		if($country)
		{
			$data = \dash\utility\location\provinces::$data;
			$new_data = [];
			foreach ($data as $key => $value)
			{
				if(is_array($value) && array_key_exists('country', $value) && array_key_exists('localname', $value))
				{
					if(mb_strtoupper($country) === mb_strtoupper($value['country']))
					{
						$temp         = $value;
						$temp['id']   = $key;
						$temp['text'] = $value['localname'] ? $value['localname'] : $value['name'];

						if(empty($new_data))
						{
							$new_data[] = ['id' => 0, 'text' => T_("Please choose province"), 'disable' => true];
						}

						$new_data[]   = $temp;
					}
				}
			}
			$data = $new_data;
		}
		$data = $new_data;

		\content_r10\tools::say($data);
	}
}
?>