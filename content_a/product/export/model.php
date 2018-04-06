<?php
namespace content_a\product\export;


class model extends \content_a\main\model
{

	public function post_export($_args)
	{
		$file_name = \dash\url::subdomain(). '_products_'. \dash\utility\jdate::date("Ymd_Hi", time(), false);

		$exported = \lib\app\product::export($file_name);

		if(\lib\engine\process::status())
		{
			\dash\notif::ok(T_("Export product successfully complete"));
			\dash\redirect::to(\dash\url::here(). '/product');
		}

	}
}
?>
