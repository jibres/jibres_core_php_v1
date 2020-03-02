<?php
namespace content_v2\profile\get;


class view
{
	public static function config()
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
		\content_v2\tools::say($result);
	}

}
?>