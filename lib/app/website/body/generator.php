<?php
namespace lib\app\website\body;

class generator
{

	public static function lines()
	{
		$website = \dash\data::website();
		if(isset($website['lines']['list']) && is_array($website['lines']['list']))
		{
			return $website['lines']['list'];
		}

		return [];
	}


	public static function body_raw()
	{
		$website = \dash\data::website();
		if(isset($website['body_raw']) && $website['body_raw'])
		{
			return $website['body_raw'];
		}

		return null;
	}
}
?>