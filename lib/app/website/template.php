<?php
namespace lib\app\website;

class template
{
	public static function get()
	{
		// check from file
		// get from query
		// save from file

		$result = [];

		$active_status = \lib\db\setting\get::platform_cat_key('website', 'status', 'active');

		if(!$active_status || !isset($active_status['value']))
		{
			$result['template'] = 'visitcard';
		}
		else
		{
			$result['template'] = $active_status['value'];
		}

		if($result['template'] === 'publish')
		{
			self::load_detail($result);
		}

		return $result;
	}


	private static function load_detail(&$result)
	{
		$load_all_website = \lib\db\setting\get::platform('website');
		$setting           = [];


		if(is_array($load_all_website))
		{
			foreach ($load_all_website as $key => $value)
			{
				if(!isset($setting[$value['cat']]))
				{
					$setting[$value['cat']] = [];
				}

				$myValue = $value['value'];
				if(substr($myValue, 0, 1) === '{' || substr($myValue, 0, 1) === '[' )
				{
					$myValue = json_decode($myValue, true);
				}

				$setting[$value['cat']][$value['key']] = $myValue;
			}
		}

		$result = array_merge($result, $setting);
	}
}
?>
