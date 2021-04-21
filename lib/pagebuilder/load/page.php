<?php
namespace lib\pagebuilder\load;


class page
{
	public static function current_page()
	{
		// check loaded post with pagebuilder
		// load homepage detail

		$check_current_page = \lib\pagebuilder\tools\search::list();
		if(!$check_current_page)
		{
			return false;
		}

		return $check_current_page;
	}



	public static function body_addr()
	{
		return root. 'lib/pagebuilder/load/body.php';
	}
}
?>