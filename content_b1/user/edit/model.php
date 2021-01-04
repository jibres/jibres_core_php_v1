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
		if(\dash\request::isset_input_body('language')) 	 $post['language']    = \dash\request::input_body('language');
		if(\dash\request::isset_input_body('website')) 		 $post['website']     = \dash\request::input_body('website');
		if(\dash\request::isset_input_body('instagram')) 	 $post['instagram']   = \dash\request::input_body('instagram');
		if(\dash\request::isset_input_body('linkedin')) 	 $post['linkedin']    = \dash\request::input_body('linkedin');
		if(\dash\request::isset_input_body('facebook')) 	 $post['facebook']    = \dash\request::input_body('facebook');
		if(\dash\request::isset_input_body('twitter')) 		 $post['twitter']     = \dash\request::input_body('twitter');
		if(\dash\request::isset_input_body('firstname')) 	 $post['firstname']   = \dash\request::input_body('firstname');
		if(\dash\request::isset_input_body('lastname')) 	 $post['lastname']    = \dash\request::input_body('lastname');
		if(\dash\request::isset_input_body('username')) 	 $post['username']    = \dash\request::input_body('username');
		if(\dash\request::isset_input_body('title')) 		 $post['title']       = \dash\request::input_body('title');
		if(\dash\request::isset_input_body('bio')) 			 $post['bio']         = \dash\request::input_body('bio');
		if(\dash\request::isset_input_body('displayname')) 	 $post['displayname'] = \dash\request::input_body('displayname');
		if(\dash\request::isset_input_body('birthday')) 	 $post['birthday']    = \dash\request::input_body('birthday');
		if(\dash\request::isset_input_body('gender')) 		 $post['gender']      = \dash\request::input_body('gender');
		if(\dash\request::isset_input_body('email')) 		 $post['email']       = \dash\request::input_body('email');

		return $post;
	}
}
?>