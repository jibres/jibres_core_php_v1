<?php
namespace content_subdomain\shiping;


class model
{
	public static function post()
	{
		if(\dash\request::post('button') === 'saveorder')
		{
			$address_id = \dash\request::post('address_id');
			if(!\dash\validate::code($address_id, false))
			{
				\dash\notif::error(T_("Please choose any address"));
				return false;
			}

			\dash\redirect::to(\dash\url::kingdom(). '/payment?address='. $address_id);
			return;
		}

		if(\dash\request::post('save_address') === 'new_address')
		{
			$post                = [];
			$post['title']       = \dash\request::post('title');
			$post['name']        = \dash\request::post('name');
			$post['country']     = \dash\request::post('country');
			$post['city']        = \dash\request::post('city');
			$post['postcode']    = \dash\request::post('postcode');
			$post['phone']       = \dash\request::post('phone');
			$post['province']    = null;
			$post['mobile']      = \dash\request::post('mobile');
			$post['address']     = \dash\request::post('address');
			$post['address2']    = \dash\request::post('address2');
			$post['company']     = \dash\request::post('company');


			$result = \dash\app\address::add($post);
			if(\dash\engine\process::status())
			{
				\dash\notif::ok(T_("Address successfully added"));
				\dash\redirect::pwd();
			}

		}

	}
}
?>
