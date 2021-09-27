<?php
namespace content_a\order\address;


class model
{

	public static function post()
	{
		if(\dash\request::post('changecustomer') === 'changecustomer')
		{
			$post                = [];
			$post['customer']    = \dash\request::post('customer');
			$post['mobile']      = \dash\request::post('memberTl');
			$post['gender']      = \dash\request::post('memberGender') ? \dash\request::post('memberGender') : null;
			$post['displayname'] = \dash\request::post('memberN');

			\lib\app\factor\edit::edit_customer($post, \dash\request::get('id'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}

			return false;
		}

		if(\dash\request::post('removecustomer') === 'removecustomer')
		{

			\lib\app\factor\edit::remove_customer(\dash\request::get('id'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}

			return false;
		}

		if(\dash\request::post('updateaddress'))
		{

			$customer_id = $customer = a(\dash\data::orderDetail(), 'factor', 'customer');
			$customer_id = \dash\coding::decode($customer_id);
			if(!$customer_id)
			{
				\dash\notif::error(T_("User not found"));
				return false;
			}

			$load_address = \dash\app\address::get_user_address($customer_id, \dash\request::post('updateaddress'));
			if(!$load_address)
			{
				\dash\notif::error(T_("Address not found"));
				return false;
			}

			$post             = [];
			$post['name']     = a($load_address, 'name');
			$post['country']  = a($load_address, 'country');
			$post['province'] = a($load_address, 'province');
			$post['city']     = a($load_address, 'city');
			$post['address']  = a($load_address, 'address');
			$post['postcode'] = a($load_address, 'postcode');
			$post['phone']    = a($load_address, 'phone');
			$post['mobile']   = a($load_address, 'mobile');

			\lib\app\factor\edit::edit_address($post, \dash\request::get('id'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
			return;
		}



		$post             = [];
		$post['name']     = \dash\request::post('name');
		$post['country']  = \dash\request::post('country');
		$post['province'] = \dash\request::post('province');
		$post['city']     = \dash\request::post('city');
		$post['address']  = \dash\request::post('address');
		$post['postcode'] = \dash\request::post('postcode');
		$post['phone']    = \dash\request::post('phone');
		$post['mobile']   = \dash\request::post('mobile');

		\lib\app\factor\edit::edit_address($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
