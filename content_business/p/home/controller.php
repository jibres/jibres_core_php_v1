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
			return false;
		}

		\dash\data::dataRow($load_product);

		$allow = false;

		if(!is_null(\dash\url::subchild()))
		{
			if(\dash\data::dataRow_url() === urldecode(\dash\url::current()))
			{
				$allow = true;
			}
			else
			{
				$allow = false;
			}
		}
		else
		{
			$allow = true;
		}

		if($allow)
		{
			\dash\open::get();
			\dash\open::post();
		}


		if(array_key_exists('buy', $_GET))
		{
			$result = \lib\app\cart\add::new_cart_website($child, 1);
			if($result)
			{
				\dash\redirect::to(\dash\url::kingdom(). '/cart');
			}
		}
		elseif(array_key_exists('cart', $_GET))
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