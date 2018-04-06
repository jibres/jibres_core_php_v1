<?php
namespace content_a\product\edit\delete;


class model extends \content_a\main\model
{
	public function post_delete($_args)
	{
		$url_product  = \dash\request::get('id');
		$post_product = \dash\request::post('delete');

		if($url_product === $post_product)
		{
			\lib\app\product::delete($url_product);

			if(\lib\engine\process::status())
			{
				\dash\redirect::to(\dash\url::here(). '/product');
			}
		}
		else
		{
			\dash\notif::error(T_("What are you doing?"));
		}
	}
}
?>
