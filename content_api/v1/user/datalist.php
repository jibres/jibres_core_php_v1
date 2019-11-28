<?php
namespace content_api\v1\user;


class datalist
{
	public static function route()
	{
		if(\dash\request::is('get'))
		{
			$result = self::list();
			\content_api\v1::say($result);
		}
		else
		{
			\content_api\v1::invalid_method();
		}
	}


	private static function list()
	{
		$detail = \dash\app\user::list(null, []);
		if(is_array($detail))
		{
			$detail = array_map(['self', 'ready'], $detail);
		}
		return $detail;
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
				// case 'avatar':
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

				default:
					$result[$key] = $value;
					break;
			}
		}
		return $result;
	}
}
?>