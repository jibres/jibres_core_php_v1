<?php
namespace content_a\website\imageblock\edit;


class view extends \content_a\website\imageblock\add\view
{
	public static function config()
	{
		parent::config();

		\dash\face::title(T_('Edit imageblock page'));

	}
}
?>
