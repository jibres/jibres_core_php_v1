<?php
namespace content_b1\user\fetch;


class view
{
	public static function config()
	{
		$detail = \dash\app\user::list(null, []);
		if(is_array($detail))
		{
			$detail = array_map(['self', 'ready'], $detail);
		}

		\content_b1\tools::say($detail);
	}

	// call from user fetch and user detail
	public static function ready($_data)
	{
		$result = [];
		foreach ($_data as $key => $value)
		{
			switch($key)
			{
				case 'jibres_user_id':
				case 'title':
				case 'password':
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