<?php
namespace content_store\subdomain;


class model
{
	public static function post()
	{
		\dash\redirect::to(\dash\url::here());
	}
}
?>
