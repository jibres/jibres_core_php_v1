<?php
namespace content_a\product\edit\delete;


class model extends \content_a\main\model
{
	public function post_delete($_args)
	{
		$url_product  = \lib\request::get('id');
		$post_product = \lib\request::post('delete');

		if($url_product === $post_product)
		{
			\lib\app\product::delete($url_product);

			if(\lib\engine\process::status())
			{
				\lib\redirect::to(\lib\url::here(). '/product');
			}
		}
		else
		{
			\lib\notif::error(T_("What are you doing?"));
		}
	}
}
?>
