<?php
namespace content\privacy;


class view
{
	public static function config()
	{
		\lib\data::page(T_('Privacy Policy'), 'title');
		\lib\data::page(T_('We wish to assure you that our main concern is to secure your privacy and protect your information against impermissible access.'), 'desc');
	}
}
?>