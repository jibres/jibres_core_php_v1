<?php
namespace content_a\setting2\general\address;


class view extends \content_a\setting2\home\view
{
	public static function config()
	{
		parent::config();

		\dash\face::title(T_('Set your store address'));

		\dash\data::settingDisplayAddr(__DIR__. '/html.php');

	}

}
?>
