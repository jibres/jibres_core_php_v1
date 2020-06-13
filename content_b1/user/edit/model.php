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
		if(\content_b1\tools::isset_input_body('language')) 	 $post['language']    = \content_b1\tools::input_body('language');
		if(\content_b1\tools::isset_input_body('website')) 		 $post['website']     = \content_b1\tools::input_body('website');
		if(\content_b1\tools::isset_input_body('instagram')) 	 $post['instagram']   = \content_b1\tools::input_body('instagram');
		if(\content_b1\tools::isset_input_body('linkedin')) 	 $post['linkedin']    = \content_b1\tools::input_body('linkedin');
		if(\content_b1\tools::isset_input_body('facebook')) 	 $post['facebook']    = \content_b1\tools::input_body('facebook');
		if(\content_b1\tools::isset_input_body('twitter')) 		 $post['twitter']     = \content_b1\tools::input_body('twitter');
		if(\content_b1\tools::isset_input_body('firstname')) 	 $post['firstname']   = \content_b1\tools::input_body('firstname');
		if(\content_b1\tools::isset_input_body('lastname')) 	 $post['lastname']    = \content_b1\tools::input_body('lastname');
		if(\content_b1\tools::isset_input_body('username')) 	 $post['username']    = \content_b1\tools::input_body('username');
		if(\content_b1\tools::isset_input_body('title')) 		 $post['title']       = \content_b1\tools::input_body('title');
		if(\content_b1\tools::isset_input_body('bio')) 			 $post['bio']         = \content_b1\tools::input_body('bio');
		if(\content_b1\tools::isset_input_body('displayname')) 	 $post['displayname'] = \content_b1\tools::input_body('displayname');
		if(\content_b1\tools::isset_input_body('birthday')) 	 $post['birthday']    = \content_b1\tools::input_body('birthday');
		if(\content_b1\tools::isset_input_body('gender')) 		 $post['gender']      = \content_b1\tools::input_body('gender');
		if(\content_b1\tools::isset_input_body('email')) 		 $post['email']       = \content_b1\tools::input_body('email');

		return $post;
	}
}
?>