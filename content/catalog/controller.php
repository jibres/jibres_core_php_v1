<?php
namespace content\catalog;


class controller
{
	public static function routing()
	{
		$lastVersion = '7.0';
		$dlLink      = \dash\url::cdn().'/catalog/Jibres-Catalog-v'. $lastVersion. '-preview.pdf';

		\dash\redirect::to($dlLink, false, T_('Jibres Catalog'));
	}
}
?>