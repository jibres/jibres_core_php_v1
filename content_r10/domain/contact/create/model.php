<?php
namespace content_r10\contact\create;


class model
{
	public static function post()
	{
		$post = [];
		$post['title']        = \dash\request::input_body('title');
		$post['firstname']    = \dash\request::input_body('firstname');
		$post['lastname']     = \dash\request::input_body('lastname');
		$post['nationalcode'] = \dash\request::input_body('nationalcode');
		$post['email']        = \dash\request::input_body('email');
		$post['country']      = \dash\request::input_body('country');
		$post['province']     = \dash\request::input_body('province');
		$post['city']         = \dash\request::input_body('city');
		$post['postcode']     = \dash\request::input_body('postcode');
		$post['phone']        = \dash\request::input_body('phone');
		$post['address']      = \dash\request::input_body('address');

		$create = \lib\app\nic_contact\add::create_new($post);

		\content_r10\tools::say($create);

	}
}
?>