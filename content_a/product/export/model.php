<?php
namespace content_a\product\export;


class model extends \content_a\main\model
{

	public function post_export($_args)
	{
		$file_name = \lib\url::subdomain(). '_products_'. \lib\utility\jdate::date("Ymd_Hi", time(), false);

		$exported = \lib\app\product::export($file_name);

		if(\lib\notif::$status)
		{
			\lib\notif::true(T_("Export product successfully complete"));
			\lib\redirect::to(\lib\url::here(). '/product');
		}

	}
}
?>
