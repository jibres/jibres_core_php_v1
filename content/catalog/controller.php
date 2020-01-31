<?php
namespace content\catalog;


class controller
{
	public static function routing()
	{
		$lastVersion = '6.0';
		$dlLink      = \dash\url::base().'/static/catalog/Jibres-Catalog-v'. $lastVersion. '-preview.pdf';

		\dash\redirect::to($dlLink);
	}
}
?>