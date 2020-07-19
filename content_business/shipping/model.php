<?php
namespace content_business\shipping;


class model
{
	public static function post()
	{
		if(\dash\user::login())
		{
			if(\dash\request::post('save_address') === 'new_address')
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
				$post['address2'] = \dash\request::post('address2');
				$post['company']  = \dash\request::post('company');

				$result = \dash\app\address::add($post);
				if(\dash\engine\process::status())
				{
					\dash\notif::ok(T_("Address successfully added"));
					\dash\redirect::pwd();
				}

			}

			if(\dash\request::post('button') === 'saveorder')
			{

				$post = [];

				$address_id = \dash\request::post('address_id');

				if(!\dash\validate::code($address_id, false))
				{
					$post['title']    = \dash\request::post('title');
					$post['name']     = \dash\request::post('xnm');
					$post['country']  = \dash\request::post('country');
					$post['city']     = \dash\request::post('city');
					$post['postcode'] = \dash\request::post('xpc');
					$post['phone']    = \dash\request::post('xph');
					$post['province'] = null;
					$post['mobile']   = \dash\request::post('xmd');
					$post['address']  = \dash\request::post('xad');
					$post['address2'] = \dash\request::post('address2');

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


		}
		else
		{
			if(\dash\request::post('button') === 'saveorder')
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
				$post['address2'] = \dash\request::post('address2');

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
}
?>
