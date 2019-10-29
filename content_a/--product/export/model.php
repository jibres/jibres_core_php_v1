<?php
namespace content_a\product\export;


class model
{

	public static function post()
	{
		$file_name = \dash\url::subdomain(). '_products_'. \dash\utility\jdate::date("Ymd_Hi", time(), false);

		$exported = \lib\app\product\export::all($file_name);

		if(\dash\engine\process::status())
		{
			\dash\notif::ok(T_("Export product successfully complete"));
			\dash\redirect::to(\dash\url::here(). '/product');
		}

	}
}
?>
