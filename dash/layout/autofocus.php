<?php
namespace dash\layout;

class autofocus
{

	public static function html()
	{
		if(!\dash\detect\device::detectPWA())
		{
			echo 'autofocus';
		}

	}
}
?>