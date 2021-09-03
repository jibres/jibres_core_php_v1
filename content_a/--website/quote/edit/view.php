<?php
namespace content_a\website\quote\edit;


class view extends \content_a\website\quote\add\view
{
	public static function config()
	{
		parent::config();

		\dash\face::title(T_('Edit quote page'));

	}
}
?>
