<?php
namespace content_a\website\specialslider\edit;


class view extends \content_a\website\specialslider\add\view
{
	public static function config()
	{
		parent::config();

		\dash\face::title(T_('Edit special slider page'));

	}
}
?>
