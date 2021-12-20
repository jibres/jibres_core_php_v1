<?php
namespace content_a\products\bulk;


class view extends \content_a\products\home\view
{
	public static function config()
	{
		parent::config();

		\dash\face::title(T_('Buil editor'));

	}
}
?>
