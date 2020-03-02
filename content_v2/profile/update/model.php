<?php
namespace content_v2\profile\update;


class model
{
	public static function post()
	{
		$request = self::getPost();

		if(!array_filter($request))
		{
			\dash\notif::error(T_("No detail sended"));
			return false;
		}

		// ready request
		$id = \dash\coding::encode(\dash\user::id());

		$result = \dash\app\user::edit($request, $id);

		if(\dash\engine\process::status())
		{
			\dash\log::set('editProfileAPI', ['code' => \dash\user::id()]);
			\dash\user::refresh();
		}

		\content_v2\tools::say($result);

	}



	private static function getPost()
	{
		$post = [];
		if(\content_v2\tools::isset_input_body('language')) 	 $post['language']    = \content_v2\tools::input_body('language');
		if(\content_v2\tools::isset_input_body('website')) 		 $post['website']     = \content_v2\tools::input_body('website');
		if(\content_v2\tools::isset_input_body('instagram')) 	 $post['instagram']   = \content_v2\tools::input_body('instagram');
		if(\content_v2\tools::isset_input_body('linkedin')) 	 $post['linkedin']    = \content_v2\tools::input_body('linkedin');
		if(\content_v2\tools::isset_input_body('facebook')) 	 $post['facebook']    = \content_v2\tools::input_body('facebook');
		if(\content_v2\tools::isset_input_body('twitter')) 		 $post['twitter']     = \content_v2\tools::input_body('twitter');
		if(\content_v2\tools::isset_input_body('firstname')) 	 $post['firstname']   = \content_v2\tools::input_body('firstname');
		if(\content_v2\tools::isset_input_body('lastname')) 	 $post['lastname']    = \content_v2\tools::input_body('lastname');
		if(\content_v2\tools::isset_input_body('username')) 	 $post['username']    = \content_v2\tools::input_body('username');
		if(\content_v2\tools::isset_input_body('title')) 		 $post['title']       = \content_v2\tools::input_body('title');
		if(\content_v2\tools::isset_input_body('bio')) 			 $post['bio']         = \content_v2\tools::input_body('bio');
		if(\content_v2\tools::isset_input_body('displayname')) 	 $post['displayname'] = \content_v2\tools::input_body('displayname');
		if(\content_v2\tools::isset_input_body('birthday')) 	 $post['birthday']    = \content_v2\tools::input_body('birthday');
		if(\content_v2\tools::isset_input_body('gender')) 		 $post['gender']      = \content_v2\tools::input_body('gender');
		if(\content_v2\tools::isset_input_body('email')) 		 $post['email']       = \content_v2\tools::input_body('email');


		return $post;
	}

}
?>