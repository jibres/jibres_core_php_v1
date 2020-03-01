<?php
namespace content_v2\user;


class add
{
	public static function route_add()
	{
		if(\dash\request::is('post'))
		{
			$post           = [];
			$post['mobile'] = \content_v2\tools::input_body('mobile');

			$result = \dash\app\user::add($post);

			unset($result['user_id']);

			\content_v2\tools::say($result);
		}
		else
		{
			\content_v2\tools::invalid_method();
		}
	}



	public static function route_edit_avatar($_user_id)
	{
		if(\dash\request::is('post'))
		{
			$result = null;
			$post   = [];
			$avatar = \dash\upload\user::avatar_set($_user_id);

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
			\content_v2\tools::say($result);
		}
		else
		{
			\content_v2\tools::invalid_method();
		}
	}

	public static function route_edit($_user_id)
	{
		if(\dash\request::is('patch'))
		{
			$post      = self::get_post(null, $_user_id);
			$user_code = \dash\coding::encode($_user_id);
			$result    = \dash\app\user::edit($post, $user_code);
			\content_v2\tools::say($result);
		}
		else
		{
			\content_v2\tools::invalid_method();
		}
	}




	private static function get_post($_get_avatar = false, $_user_id = null)
	{
		$post = [];
		if(\content_v2\tools::isset_input_body('language')) 		 $post['language']    = \content_v2\tools::input_body('language');
		if(\content_v2\tools::isset_input_body('website')) 		 $post['website']     = \content_v2\tools::input_body('website');
		if(\content_v2\tools::isset_input_body('instagram')) 		 $post['instagram']   = \content_v2\tools::input_body('instagram');
		if(\content_v2\tools::isset_input_body('linkedin')) 		 $post['linkedin']    = \content_v2\tools::input_body('linkedin');
		if(\content_v2\tools::isset_input_body('facebook')) 		 $post['facebook']    = \content_v2\tools::input_body('facebook');
		if(\content_v2\tools::isset_input_body('twitter')) 		 $post['twitter']     = \content_v2\tools::input_body('twitter');
		if(\content_v2\tools::isset_input_body('firstname')) 		 $post['firstname']   = \content_v2\tools::input_body('firstname');
		if(\content_v2\tools::isset_input_body('lastname')) 		 $post['lastname']    = \content_v2\tools::input_body('lastname');
		if(\content_v2\tools::isset_input_body('username')) 		 $post['username']    = \content_v2\tools::input_body('username');
		if(\content_v2\tools::isset_input_body('title')) 			 $post['title']       = \content_v2\tools::input_body('title');
		if(\content_v2\tools::isset_input_body('bio')) 			 $post['bio']         = \content_v2\tools::input_body('bio');
		if(\content_v2\tools::isset_input_body('displayname')) 	 $post['displayname'] = \content_v2\tools::input_body('displayname');
		if(\content_v2\tools::isset_input_body('birthday')) 		 $post['birthday']    = \content_v2\tools::input_body('birthday');
		if(\content_v2\tools::isset_input_body('gender')) 		 $post['gender']      = \content_v2\tools::input_body('gender');
		if(\content_v2\tools::isset_input_body('email')) 			 $post['email']       = \content_v2\tools::input_body('email');

		if($_get_avatar)
		{
			$avatar = \dash\upload\user::avatar_set($_user_id);

			if($avatar)
			{
				$post['avatar'] = $avatar;
			}
		}

		return $post;
	}
}
?>
