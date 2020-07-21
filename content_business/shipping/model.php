<?php
namespace content_business\shipping;


class model
{
	public static function post()
	{
		if(\dash\user::login())
		{


			$post = [];

			$address_id = \dash\request::post('address_id');

			if(!\dash\validate::code($address_id, false) && $address_id == 'new_address')
			{
				$address_id = null;
				$post['title']    = \dash\request::post('title');
				$post['name']     = \dash\request::post('xnm');
				$post['country']  = \dash\request::post('country');
				$post['city']     = \dash\request::post('city');
				$post['postcode'] = \dash\request::post('xpc');
				$post['phone']    = \dash\request::post('xph');
				$post['province'] = null;
				$post['mobile']   = \dash\request::post('xmd');
				$post['address']  = \dash\request::post('xad');


			}

			$post['address_id'] = $address_id;
			$post['payway']     = \dash\request::post('payway');
			$post['desc']       = \dash\request::post('desc');

			$saveorder = \lib\app\factor\cart::to_factor($post);

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::kingdom(). '/orders');
			}
			return;



		}
		else
		{

			$post             = [];
			$post['title']    = \dash\request::post('title');
			$post['name']     = \dash\request::post('xnm');
			$post['country']  = \dash\request::post('country');
			$post['city']     = \dash\request::post('city');
			$post['postcode'] = \dash\request::post('xpc');
			$post['phone']    = \dash\request::post('xph');
			$post['province'] = null;
			$post['mobile']   = \dash\request::post('xmd');
			$post['address']  = \dash\request::post('xad');


			$post['payway']   = \dash\request::post('payway');
			$post['desc']     = \dash\request::post('desc');


			$saveorder = \lib\app\factor\cart::to_factor($post);

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::kingdom(). '/orders');
			}
			return;


		}

	}
}
?>
