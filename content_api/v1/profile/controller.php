<?php
namespace content_api\v1\profile;


class controller
{
	public static function routing()
	{
		\content_api\v1::invalid_url();
	}

	public static function api_routing()
	{

		$profile = false;

		\content_api\v1::apikey_required();

		switch (\dash\url::dir(3))
		{
			case 'get':
				if(\dash\url::dir(4))
				{
					\content_api\v1::invalid_url();
				}

				if(!\dash\request::is('get'))
				{
					\content_api\v1::invalid_method();
				}
				$profile = self::get_profile();
				break;

			case 'update':
				if(\dash\url::dir(4) === 'avatar')
				{
					if(\dash\url::dir(5))
					{
						\content_api\v1::invalid_url();
					}

					if(!\dash\request::is('post'))
					{
						\content_api\v1::invalid_method();
					}

					$profile = self::update_profile(true);
				}
				elseif(!\dash\url::dir(4))
				{
					if(!\dash\request::is('post'))
					{
						\content_api\v1::invalid_method();
					}

					$profile = self::update_profile();
				}
				else
				{
					content_api\v1::invalid_url();
				}
				break;

			default:
				\content_api\v1::invalid_url();
				break;
		}

		\content_api\v1::say($profile);
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
				case 'username':
				case 'displayname':
				case 'gender':
				case 'title':
				case 'mobile':
				case 'verifymobile':
				case 'status':
				case 'avatar':
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

		// if(array_key_exists('twostep', $_POST))
		// {
		// 	$post['twostep']     = \content_api\v1::input_body('twostep');
		// }

		// if(array_key_exists('sidebar', $_POST))
		// {
		// 	$post['sidebar']     = \content_api\v1::input_body('sidebar') ? true : false;
		// }

		if(array_key_exists('language', $_POST))
		{
			$post['language']    = \content_api\v1::input_body('language');
		}

		if(array_key_exists('website', $_POST))
		{
			$post['website']     = \content_api\v1::input_body('website');
		}

		if(array_key_exists('instagram', $_POST))
		{
			$post['instagram']   = \content_api\v1::input_body('instagram');
		}

		if(array_key_exists('linkedin', $_POST))
		{
			$post['linkedin']    = \content_api\v1::input_body('linkedin');
		}

		if(array_key_exists('facebook', $_POST))
		{
			$post['facebook']    = \content_api\v1::input_body('facebook');
		}

		if(array_key_exists('twitter', $_POST))
		{
			$post['twitter']     = \content_api\v1::input_body('twitter');
		}

		if(array_key_exists('firstname', $_POST))
		{
			$post['firstname']   = \content_api\v1::input_body('firstname');
		}

		if(array_key_exists('lastname', $_POST))
		{
			$post['lastname']    = \content_api\v1::input_body('lastname');
		}

		if(array_key_exists('username', $_POST))
		{
			$post['username']    = \content_api\v1::input_body('username');
		}

		if(array_key_exists('title', $_POST))
		{
			$post['title']       = \content_api\v1::input_body('title');
		}

		if(array_key_exists('bio', $_POST))
		{
			$post['bio']         = \content_api\v1::input_body('bio');
		}

		if(array_key_exists('displayname', $_POST))
		{
			$post['displayname'] = \content_api\v1::input_body('displayname');
		}

		if(array_key_exists('birthday', $_POST))
		{
			$post['birthday']    = \content_api\v1::input_body('birthday');
		}


		if(array_key_exists('gender', $_POST))
		{
			$post['gender']      = \content_api\v1::input_body('gender');
		}

		if(array_key_exists('email', $_POST))
		{
			$post['email']       = \content_api\v1::input_body('email');
		}

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