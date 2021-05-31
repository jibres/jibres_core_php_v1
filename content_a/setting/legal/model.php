<?php
namespace content_a\setting\legal;


class model
{
	public static function post()
	{
		$post                       = [];


		if(\dash\request::post('set_aboutus_page'))
		{
			$post['aboutus_page'] = \dash\request::post('aboutus_page');
		}

		if(\dash\request::post('set_refund_policy_page'))
		{
			$post['refund_policy_page'] = \dash\request::post('refund_policy_page');
		}

		if(\dash\request::post('set_privacy_policy_page'))
		{
			$post['privacy_policy_page'] = \dash\request::post('privacy_policy_page');
		}

		if(\dash\request::post('set_termsofservice_policy_page'))
		{
			$post['termsofservice_policy_page'] = \dash\request::post('termsofservice_policy_page');
		}

		if(\dash\request::post('set_shipping_policy_page'))
		{
			$post['shipping_policy_page'] = \dash\request::post('shipping_policy_page');
		}


		\lib\app\setting\policy_page::set($post);
	}
}
?>
