<?php
namespace content_api\v1\user;


class add
{
	public static function route_add()
	{
		if(\dash\request::is('post'))
		{
			$post           = [];
			$post['mobile'] = \content_api\v1::input_body('mobile');

			$result = \dash\app\user::add($post);

			unset($result['user_id']);

			\content_api\v1::say($result);
		}
		else
		{
			\content_api\v1::invalid_method();
		}
	}



	public static function route_edit_avatar($_user_id)
	{
		if(\dash\request::is('post'))
		{
			$result = null;
			$post   = [];
			$avatar = \dash\app\file::upload_quick('avatar');

			if($avatar)
			{
				$post['avatar'] = $avatar;
			}

			if(!$avatar)
			{
				\dash\notif::warn(T_("Please upload a file"));
			}
			else
			{

				$user_code = \dash\coding::encode($_user_id);
				$result    = \dash\app\user::edit($post, $user_code);

			}
			\content_api\v1::say($result);
		}
		else
		{
			\content_api\v1::invalid_method();
		}
	}

	public static function route_edit($_user_id)
	{
		if(\dash\request::is('patch'))
		{
			$post      = self::get_post();
			$user_code = \dash\coding::encode($_user_id);
			$result    = \dash\app\user::edit($post, $user_code);
			\content_api\v1::say($result);
		}
		else
		{
			\content_api\v1::invalid_method();
		}
	}




	private static function get_post($_get_avatar = false)
	{
		$post = [];
		if(\content_api\v1::isset_input_body('language')) 		 $post['language']    = \content_api\v1::input_body('language');
		if(\content_api\v1::isset_input_body('website')) 		 $post['website']     = \content_api\v1::input_body('website');
		if(\content_api\v1::isset_input_body('instagram')) 		 $post['instagram']   = \content_api\v1::input_body('instagram');
		if(\content_api\v1::isset_input_body('linkedin')) 		 $post['linkedin']    = \content_api\v1::input_body('linkedin');
		if(\content_api\v1::isset_input_body('facebook')) 		 $post['facebook']    = \content_api\v1::input_body('facebook');
		if(\content_api\v1::isset_input_body('twitter')) 		 $post['twitter']     = \content_api\v1::input_body('twitter');
		if(\content_api\v1::isset_input_body('firstname')) 		 $post['firstname']   = \content_api\v1::input_body('firstname');
		if(\content_api\v1::isset_input_body('lastname')) 		 $post['lastname']    = \content_api\v1::input_body('lastname');
		if(\content_api\v1::isset_input_body('username')) 		 $post['username']    = \content_api\v1::input_body('username');
		if(\content_api\v1::isset_input_body('title')) 			 $post['title']       = \content_api\v1::input_body('title');
		if(\content_api\v1::isset_input_body('bio')) 			 $post['bio']         = \content_api\v1::input_body('bio');
		if(\content_api\v1::isset_input_body('displayname')) 	 $post['displayname'] = \content_api\v1::input_body('displayname');
		if(\content_api\v1::isset_input_body('birthday')) 		 $post['birthday']    = \content_api\v1::input_body('birthday');
		if(\content_api\v1::isset_input_body('gender')) 		 $post['gender']      = \content_api\v1::input_body('gender');
		if(\content_api\v1::isset_input_body('email')) 			 $post['email']       = \content_api\v1::input_body('email');

		if($_get_avatar)
		{
			$avatar = \dash\app\file::upload_quick('avatar');

			if($avatar)
			{
				$post['avatar'] = $avatar;
			}
		}

		return $post;
	}
}
?>
