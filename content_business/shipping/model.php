<?php
namespace content_business\shipping;


class model
{
	public static function post()
	{
		$check_schedule_order = \lib\app\factor\schedule_order::check();

		if(!$check_schedule_order)
		{
			return false;
		}

		$args = [];
		if(\dash\user::login())
		{
			$address_id = \dash\request::post('address_id');

			if(!\dash\validate::code($address_id, false) || $address_id == 'new_address')
			{
				$address_id = null;
				$args['title']    = \dash\request::post('title');
				$args['name']     = \dash\request::post('xnm');
				$args['country']  = \dash\request::post('country');
				$args['city']     = \dash\request::post('city');
				$args['postcode'] = \dash\request::post('xpc');
				$args['phone']    = \dash\request::post('xph');
				$args['province'] = null;
				$args['mobile']   = \dash\request::post('xmd');
				$args['address']  = \dash\request::post('xad');
			}

			$args['address_id'] = $address_id;
			$args['payway']     = \dash\request::post('payway');
			$args['desc']       = \dash\request::post('desc');

		}
		else
		{

			$args['title']    = \dash\request::post('title');
			$args['name']     = \dash\request::post('xnm');
			$args['country']  = \dash\request::post('country');
			$args['city']     = \dash\request::post('city');
			$args['postcode'] = \dash\request::post('xpc');
			$args['phone']    = \dash\request::post('xph');
			$args['province'] = null;
			$args['mobile']   = \dash\request::post('xmd');
			$args['address']  = \dash\request::post('xad');
			$args['payway']   = \dash\request::post('payway');
			$args['desc']     = \dash\request::post('desc');
		}


		if(\dash\data::shippingSurveyForm())
		{
			$post  = \dash\request::post();
			$files = \dash\request::files();

			$answer              = [];
			$answer['form_id']   = \dash\data::shippingSurveyForm();
			$answer['factor_id'] = null;
			$answer['startdate'] = \dash\request::post('startdate');
			$answer['user_id']   = \dash\user::id();
			$answer['answer']    = [];

			foreach ($post as $key => $value)
			{
				if(preg_match("/^a_(\d+)$/", $key, $split))
				{
					$answer['answer'][$split[1]] = $value;
				}
			}

			foreach ($files as $key => $value)
			{
				if(preg_match("/^a_(\d+)$/", $key, $split))
				{
					$answer['answer'][$split[1]] = 1; // get the file in other place
				}
			}

			$args['shipping_form_answer'] = $answer;
		}

		$saveorder = \lib\app\factor\cart::to_factor($args);

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::kingdom(). '/orders');
		}
		return;

	}
}
?>
