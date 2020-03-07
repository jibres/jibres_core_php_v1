<?php
namespace content_r10\queue\app;


class model
{
	public static function post()
	{
		$status   = \dash\request::post('status');
		$store    = \dash\request::post('store');
		$filename = \dash\request::post('version');
		$meta     = \dash\request::post('meta');

		\lib\app\application\queue::set_status($store, $status, $filename, $meta);
	}
}
?>