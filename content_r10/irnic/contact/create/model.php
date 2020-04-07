<?php
namespace content_r10\irnic\contact\create;


class model
{
	public static function post()
	{
		$post = [];
		$post['title']        = \content_r10\tools::input_body('title');
		$post['firstname']    = \content_r10\tools::input_body('firstname');
		$post['lastname']     = \content_r10\tools::input_body('lastname');
		$post['nationalcode'] = \content_r10\tools::input_body('nationalcode');
		$post['email']        = \content_r10\tools::input_body('email');
		$post['country']      = \content_r10\tools::input_body('country');
		$post['province']     = \content_r10\tools::input_body('province');
		$post['city']         = \content_r10\tools::input_body('city');
		$post['postcode']     = \content_r10\tools::input_body('postcode');
		$post['phone']        = \content_r10\tools::input_body('phone');
		$post['address']      = \content_r10\tools::input_body('address');

		$create = \lib\app\nic_contact\add::create_new($post);

		\content_r10\tools::say($create);

	}
}
?>