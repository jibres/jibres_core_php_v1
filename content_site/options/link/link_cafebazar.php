<?php
namespace content_site\options\link;


class link_cafebazar extends link_raw
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
		return T_("Cafebazar");
	}

	public static function visible()
	{
		if(\dash\language::current() === 'fa')
		{
			return true;
		}

		return false;
	}

	public static function placeholder()
	{
		return 'https://cafebazaar.ir/app/';
	}

}
?>