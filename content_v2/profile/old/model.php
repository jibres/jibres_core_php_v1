<?php
namespace content_v2\profile;


class controller
{
	public static function routing()
	{
		\content_v2\tools::invalid_url();
	}

	public static function api_routing()
	{

		$profile = false;

		\content_v2\tools::apikey_required();

		switch (\dash\url::dir(3))
		{
			case 'get':
				if(\dash\url::dir(4))
				{
					\content_v2\tools::invalid_url();
				}

				if(!\dash\request::is('get'))
				{
					\content_v2\tools::invalid_method();
				}
				$profile = self::get_profile();
				break;

			case 'update':
				if(\dash\url::dir(4) === 'avatar')
				{
					if(\dash\url::dir(5))
					{
						\content_v2\tools::invalid_url();
					}

					if(!\dash\request::is('post'))
					{
						\content_v2\tools::invalid_method();
					}

					$profile = self::update_profile(true);
				}
				elseif(!\dash\url::dir(4))
				{
					if(!\dash\request::is('post'))
					{
						\content_v2\tools::invalid_method();
					}

					$profile = self::update_profile();
				}
				else
				{
					content_v2\tools::invalid_url();
				}
				break;

			case 'address':

				// set user id as current logined user id
				// in crm call this function but set user id from api parameter
				\content_v2\user\address::set_user_id(\dash\user::id());

				$dir_4 = \dash\url::dir(4);

				if(\dash\url::dir(4) === 'add')
				{
					if(\dash\url::dir(5))
					{
						\content_v2\tools::invalid_url();
					}

					if(!\dash\request::is('post'))
					{
						\content_v2\tools::invalid_method();
					}

					$profile = \content_v2\user\address::add_address();

				}
				elseif(\dash\url::dir(4) === 'list')
				{
					if(\dash\url::dir(5))
					{
						\content_v2\tools::invalid_url();
					}

					if(!\dash\request::is('get'))
					{
						\content_v2\tools::invalid_method();
					}

					$profile = \content_v2\user\address::list_address();

				}
				elseif(\dash\coding::is($dir_4) && in_array(\dash\url::dir(5), ['edit', 'remove']) && !\dash\url::dir(6))
				{
					if(\dash\url::dir(5) === 'edit')
					{
						if(!\dash\request::is('patch'))
						{
							\content_v2\tools::invalid_method();
						}

						$profile = \content_v2\user\address::edit_address($dir_4);
					}
					elseif(\dash\url::dir(5) === 'remove')
					{
						if(!\dash\request::is('delete'))
						{
							\content_v2\tools::invalid_method();
						}
						$profile = \content_v2\user\address::remove_address($dir_4);
					}
				}
				else
				{
					\content_v2\tools::invalid_url();
				}
				break;

			default:
				\content_v2\tools::invalid_url();
				break;
		}

		\content_v2\tools::say($profile);
	}


	private static function update_profile($_get_avatar = false)
	{
		$request = self::getPost($_get_avatar);

		if(!array_filter($request))
		{
			\dash\notif::error(T_("No file sended"));
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

		return $result;
	}


	private static function get_profile()
	{
		$detail = \dash\user::detail();
		$result = [];
		foreach ($detail as $key => $value)
		{
			switch ($key)
			{
				case 'avatar':
					$value = \lib\filepath::fix($value);
					$result[$key] = $value;
					break;

				case 'username':
				case 'displayname':
				case 'gender':
				case 'title':
				case 'mobile':
				case 'verifymobile':
				case 'status':
				case 'datecreated':
				case 'datemodified':
				case 'birthday':
				case 'language':
				case 'firstname':
				case 'lastname':
				case 'bio':
					$result[$key] = $value;
					break;


				case 'detail':
					$result['email'] = null;
					if($value)
					{
						$myDetail = json_decode($value, true);
						if(isset($myDetail['email']))
						{
							$result['email'] = $myDetail['email'];
						}
					}
					break;
			}
		}

		return $result;
	}




	private static function getPost($_get_avatar = false)
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
			$avatar = \dash\upload\user::avatar_set();

			if($avatar)
			{
				$post['avatar'] = $avatar;
			}
		}

		return $post;
	}

}
?>