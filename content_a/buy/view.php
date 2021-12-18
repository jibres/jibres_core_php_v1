<?php
namespace content_a\buy;


class view extends \content_a\sale\view
{
	public static function config()
	{
		parent::config();

		\dash\face::title(T_('Buy invoicing'));
	}
}
?>
