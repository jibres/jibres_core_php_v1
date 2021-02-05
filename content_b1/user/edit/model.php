<?php
namespace content_b1\user\edit;


class model
{
	public static function patch()
	{
		$post           = [];

		$user_code = \dash\request::get('id');

		$post      = self::get_post();

		$result    = \dash\app\user::edit($post, $user_code);

		\content_b1\tools::say($result);

	}




	private static function get_post()
	{

		$post = [];
		if(\dash\request::isset_input_body('username')) 				$post['username']              = \dash\request::input_body('username');
		if(\dash\request::isset_input_body('displayname')) 				$post['displayname']           = \dash\request::input_body('displayname');
		if(\dash\request::isset_input_body('gender')) 					$post['gender']                = \dash\request::input_body('gender');
		if(\dash\request::isset_input_body('mobile')) 					$post['mobile']                = \dash\request::input_body('mobile');
		if(\dash\request::isset_input_body('email')) 					$post['email']                 = \dash\request::input_body('email');
		if(\dash\request::isset_input_body('status')) 					$post['status']                = \dash\request::input_body('status');
		if(\dash\request::isset_input_body('accounttype')) 				$post['accounttype']           = \dash\request::input_body('accounttype');
		if(\dash\request::isset_input_body('permission')) 				$post['permission']            = \dash\request::input_body('permission');
		if(\dash\request::isset_input_body('subscribe')) 				$post['subscribe']             = \dash\request::input_body('subscribe');
		if(\dash\request::isset_input_body('birthday')) 				$post['birthday']              = \dash\request::input_body('birthday');
		if(\dash\request::isset_input_body('website')) 					$post['website']               = \dash\request::input_body('website');
		if(\dash\request::isset_input_body('facebook')) 				$post['facebook']              = \dash\request::input_body('facebook');
		if(\dash\request::isset_input_body('twitter')) 					$post['twitter']               = \dash\request::input_body('twitter');
		if(\dash\request::isset_input_body('instagram')) 				$post['instagram']             = \dash\request::input_body('instagram');
		if(\dash\request::isset_input_body('linkedin')) 				$post['linkedin']              = \dash\request::input_body('linkedin');
		if(\dash\request::isset_input_body('firstname')) 				$post['firstname']             = \dash\request::input_body('firstname');
		if(\dash\request::isset_input_body('lastname')) 				$post['lastname']              = \dash\request::input_body('lastname');
		if(\dash\request::isset_input_body('bio')) 						$post['bio']                   = \dash\request::input_body('bio');
		if(\dash\request::isset_input_body('father')) 					$post['father']                = \dash\request::input_body('father');
		if(\dash\request::isset_input_body('nationalcode')) 			$post['nationalcode']          = \dash\request::input_body('nationalcode');
		if(\dash\request::isset_input_body('nationality')) 				$post['nationality']           = \dash\request::input_body('nationality');
		if(\dash\request::isset_input_body('pasportcode')) 				$post['pasportcode']           = \dash\request::input_body('pasportcode');
		if(\dash\request::isset_input_body('pasportdate')) 				$post['pasportdate']           = \dash\request::input_body('pasportdate');
		if(\dash\request::isset_input_body('marital')) 					$post['marital']               = \dash\request::input_body('marital');
		if(\dash\request::isset_input_body('phone')) 					$post['phone']                 = \dash\request::input_body('phone');
		if(\dash\request::isset_input_body('companyname')) 				$post['companyname']           = \dash\request::input_body('companyname');
		if(\dash\request::isset_input_body('companyeconomiccode')) 		$post['companyeconomiccode']   = \dash\request::input_body('companyeconomiccode');
		if(\dash\request::isset_input_body('companynationalid')) 		$post['companynationalid']     = \dash\request::input_body('companynationalid');
		if(\dash\request::isset_input_body('companyregisternumber')) 	$post['companyregisternumber'] = \dash\request::input_body('companyregisternumber');

		return $post;
	}
}
?>