<?php
namespace lib;


class website
{

	public static function logo()
	{
		$logo = \dash\get::index(\dash\data::website(), 'header_customized', 'header_logo');
		if($logo)
		{
			return \lib\filepath::fix($logo);
		}
		return null;
	}

}
?>