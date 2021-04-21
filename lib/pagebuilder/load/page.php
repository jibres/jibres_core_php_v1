<?php
namespace lib\pagebuilder\load;


class page
{
	public static $is_page = false;

	public static function current_page()
	{
		// check loaded post with pagebuilder
		// load homepage detail

		$check_current_page = \lib\pagebuilder\tools\search::list();
		if(!$check_current_page)
		{
			return false;
		}

		self::$is_page = true;

		return $check_current_page;
	}
}
?>