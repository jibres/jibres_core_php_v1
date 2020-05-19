<?php
namespace content_a\website\slider\edit;


class view extends \content_a\website\slider\add\view
{
	public static function config()
	{
		parent::config();

		\dash\face::title(T_('Edit slider page'));

	}
}
?>
