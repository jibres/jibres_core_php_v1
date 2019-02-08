<?php
namespace content_a\setting\maximum;


class model
{
	public static function post()
	{
		$post                    = [];
		$post['maxbuyprice']     = \dash\request::post('maxbuyprice');
		$post['maxprice']        = \dash\request::post('maxprice');
		$post['maxdiscount']     = \dash\request::post('maxdiscount');
		$post['maxproductcount'] = \dash\request::post('maxproductcount');

		\lib\app\store\setting::set($post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}

	}
}
?>