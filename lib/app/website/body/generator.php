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
}
?>