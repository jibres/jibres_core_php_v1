<?php
namespace content_site\options\link;


class link_googleplay extends link_raw
{


	public static function name()
	{
		return \content_site\utility::className(get_called_class());
	}


	public static function db_key()
	{
		return \content_site\utility::className(get_called_class());
	}

	public static function title()
	{
		return T_("Google Play");
	}

	public static function placeholder()
	{
		return 'https://play.google.com/';
	}

}
?>