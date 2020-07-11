<?php
namespace content_r10\location\city;


class view
{
	public static function config()
	{
		$new_data = [];
		$province = \dash\request::get('province');
		if($province)
		{
			$data = \dash\utility\location\cites::$data;

			$new_data = [];
			foreach ($data as $key => $value)
			{
				if(is_array($value) && array_key_exists('province', $value) && array_key_exists('localname', $value))
				{
					if(mb_strtoupper($province) === mb_strtoupper($value['province']))
					{
						$temp         = $value;
						$temp['id']   = $key;
						$temp['text'] = $value['localname'] ? $value['localname'] : $value['name'];

						if(empty($new_data))
						{
							$new_data[] = ['id' => 0, 'text' => T_("Please choose city"), 'disable' => true];
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