<?php
namespace content_v2\user;


class get
{
	public static function route_one($_user_id)
	{
		if(\dash\request::is('get'))
		{
			$user_code = \dash\coding::encode($_user_id);

			$detail = \dash\app\user::get($user_code);
			if(is_array($detail))
			{
				$detail = self::ready($detail);
			}
			\content_v2\tools::say($detail);
		}
		else
		{
			\content_v2\tools::invalid_method();
		}
	}


	public static function route_list()
	{
		if(\dash\request::is('get'))
		{
			$detail = \dash\app\user::list(null, []);
			if(is_array($detail))
			{
				$detail = array_map(['self', 'ready'], $detail);
			}

			\content_v2\tools::say($detail);
		}
		else
		{
			\content_v2\tools::invalid_method();
		}
	}


	private static function ready($_data)
	{
		$result = [];
		foreach ($_data as $key => $value)
		{
			switch($key)
			{
				case 'jibres_user_id':
				case 'title':
				case 'verifymobile':
				case 'verifyemail':
				case 'avatar_raw':
				case 'parent':
				case 'type':
				case 'pin':
				case 'ref':
				case 'twostep':
				case 'unit_id':
				case 'meta':
				case 'sidebar':
				case 'theme':
				case 'forceremember':
				case 'signature':
				case 'detail':
					// not show to user
					break;

				// case 'id':
				// case 'username':
				// case 'displayname':
				// case 'gender':
				// case 'mobile':
				// case 'email':
				// case 'status':
				// case 'permission':
				// case 'datecreated':
				// case 'datemodified':
				// case 'birthday':
				// case 'language':
				// case 'website':
				// case 'facebook':
				// case 'twitter':
				// case 'instagram':
				// case 'linkedin':
				// case 'gmail':
				// case 'firstname':
				// case 'lastname':
				// case 'bio':
				// case 'father':
				// case 'nationalcode':
				// case 'nationality':
				// case 'pasportcode':
				// case 'pasportdate':
				// case 'marital':
				// case 'foreign':
				// case 'phone':

				// 	break;
				case 'avatar':
					$value = \lib\filepath::fix($value);
					$result[$key] = $value;
					break;

				default:
					$result[$key] = $value;
					break;
			}
		}
		return $result;
	}
}
?>