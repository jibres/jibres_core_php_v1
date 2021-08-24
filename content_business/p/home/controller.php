<?php
namespace content_business\p\home;

class controller
{
	public static function routing()
	{
		$child = \dash\url::child();


		$load_product = \lib\app\product\load::site($child);

		if(!$load_product)
		{
			\dash\redirect::to(\dash\url::kingdom());
			return false;
		}

		if(a($load_product, 'status') === 'deleted')
		{
			\dash\header::status(404, T_("Product not found"));
		}


		if(a($load_product, 'status') === 'draft')
		{
			if(\dash\request::get('preview'))
			{
				// ok
			}
			else
			{
				\dash\header::status(404, T_("Product is not published"));
			}
		}

		\dash\data::dataRow($load_product);


		$allow = false;

		if(!is_null(\dash\url::subchild()))
		{
			if(\dash\data::dataRow_slug() === urldecode(\dash\url::subchild()))
			{
				$allow = true;
			}
			else
			{
				\dash\redirect::to(a($load_product, 'url'));
			}
		}
		else
		{
			$allow = true;
		}

		if(\dash\url::dir(3))
		{
			$allow = false;
		}

		if($allow)
		{
			\dash\open::get();
			\dash\open::post();
		}


		if(\dash\request::key_exists('buy', 'GET'))
		{
			$result = \lib\app\cart\add::new_cart_website($child, 1);
			if($result)
			{
				\dash\redirect::to(\dash\url::kingdom(). '/cart');
			}
		}
		elseif(\dash\request::key_exists('cart', 'GET'))
		{
			$result = \lib\app\cart\add::new_cart_website($child, 1);
			if($result)
			{
				\dash\redirect::to(\dash\url::that());
			}

		}

	}
}
?>