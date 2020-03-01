<?php
namespace content_v2\user;


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

		if(\content_v2\tools::isset_input_body('title')) 			 $post['title']       = \content_v2\tools::input_body('title');
		if(\content_v2\tools::isset_input_body('name')) 			 $post['name']        = \content_v2\tools::input_body('name');
		if(\content_v2\tools::isset_input_body('country')) 		 $post['country']     = \content_v2\tools::input_body('country');
		if(\content_v2\tools::isset_input_body('city')) 			 $post['city']        = \content_v2\tools::input_body('city');
		if(\content_v2\tools::isset_input_body('postcode')) 		 $post['postcode']    = \content_v2\tools::input_body('postcode');
		if(\content_v2\tools::isset_input_body('phone')) 			 $post['phone']       = \content_v2\tools::input_body('phone');
		if(\content_v2\tools::isset_input_body('province')) 		 $post['province']    = \content_v2\tools::input_body('province');
		if(\content_v2\tools::isset_input_body('mobile')) 		 $post['mobile']      = \content_v2\tools::input_body('mobile');
		if(\content_v2\tools::isset_input_body('address')) 		 $post['address']     = \content_v2\tools::input_body('address');
		if(\content_v2\tools::isset_input_body('address2')) 		 $post['address2']    = \content_v2\tools::input_body('address2');
		if(\content_v2\tools::isset_input_body('company')) 		 $post['company']     = \content_v2\tools::input_body('company');
		if(\content_v2\tools::isset_input_body('companyname')) 	 $post['companyname'] = \content_v2\tools::input_body('companyname');
		if(\content_v2\tools::isset_input_body('jobtitle')) 		 $post['jobtitle']    = \content_v2\tools::input_body('jobtitle');

		return $post;
	}
}
?>