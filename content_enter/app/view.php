<?php
namespace content_enter\app;


class view extends \content_enter\home\view
{

	public static function config()
	{
		parent::config();


		\dash\face::title(T_('Enter to :name', ['name' => \dash\face::hereTitle()]));
		\dash\face::desc(\dash\face::title());

	}
}
?>