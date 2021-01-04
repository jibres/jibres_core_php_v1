<?php
namespace content_b1\user;


class address
{

	private static $myUserId = null;


	public static function set_user_id($_user_id)
	{
		self::$myUserId = $_user_id;
	}


	private static function myUserId()
	{
		return self::$myUserId;
	}


	public static function add_address()
	{
		$post            = self::getPost_address();
		$post['user_id'] = self::myUserId();
		$result          = \dash\app\address::add($post);

		if(\dash\engine\process::status())
		{
			\dash\notif::ok(T_("Address successfully added"));
		}

		return $result;
	}

	public static function edit_address($_address_id)
	{
		$post = self::getPost_address();
		$result = \dash\app\address::edit($post, $_address_id);
		if(\dash\engine\process::status())
		{
			\dash\notif::ok(T_("Address successfully edited"));
		}

		return $result;
	}



	public static function list_address()
	{
		$args               = [];
		$args['user_id']    = self::myUserId();
		$args['pagenation'] = false;
		$args['status']     = 'enable';
		$dataTable          = \dash\app\address::list(null, $args);
		return $dataTable;
	}


	public static function remove_address($_address_id)
	{
		$result = \dash\app\address::remove($_address_id);
		return $result;
	}


	private static function getPost_address()
	{
		$post                = [];

		if(\dash\request::isset_input_body('title')) 			 $post['title']       = \dash\request::input_body('title');
		if(\dash\request::isset_input_body('name')) 			 $post['name']        = \dash\request::input_body('name');
		if(\dash\request::isset_input_body('country')) 		 $post['country']     = \dash\request::input_body('country');
		if(\dash\request::isset_input_body('city')) 			 $post['city']        = \dash\request::input_body('city');
		if(\dash\request::isset_input_body('postcode')) 		 $post['postcode']    = \dash\request::input_body('postcode');
		if(\dash\request::isset_input_body('phone')) 			 $post['phone']       = \dash\request::input_body('phone');
		if(\dash\request::isset_input_body('province')) 		 $post['province']    = \dash\request::input_body('province');
		if(\dash\request::isset_input_body('mobile')) 		 $post['mobile']      = \dash\request::input_body('mobile');
		if(\dash\request::isset_input_body('address')) 		 $post['address']     = \dash\request::input_body('address');
		if(\dash\request::isset_input_body('address2')) 		 $post['address2']    = \dash\request::input_body('address2');
		if(\dash\request::isset_input_body('company')) 		 $post['company']     = \dash\request::input_body('company');
		if(\dash\request::isset_input_body('companyname')) 	 $post['companyname'] = \dash\request::input_body('companyname');
		if(\dash\request::isset_input_body('jobtitle')) 		 $post['jobtitle']    = \dash\request::input_body('jobtitle');

		return $post;
	}
}
?>