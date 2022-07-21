<?php
namespace lib\app\menu;


class ready
{

	public static function row($_data)
	{
		if(!is_array($_data))
		{
			$_data = [];
		}

		$result     = [];

		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'preview':
				case 'body':
					if($value && is_string($value))
					{
						$value = json_decode($value, true);
					}
					$result[$key] = $value;

					if(!is_array($result[$key]))
					{
						$result[$key] = [];
					}

					break;

				default:
					$result[$key] = $value;
					break;
			}
		}

		if(isset($result['pointer']) && $result['pointer'] === 'socialnetwork' && isset($result['socialnetwork']) && !a($result, 'url'))
		{
			$result['url'] = self::get_my_social($result['socialnetwork']);
		}
		elseif(isset($result['pointer']) && $result['pointer'] === 'selffile' && isset($result['file']))
		{
			$result['url'] = \lib\filepath::fix($result['file']);
		}
		elseif(isset($result['pointer']) && $result['pointer'] === 'homepage')
		{
			$result['url'] = \lib\store::url();
		}
		elseif(!a($result, 'related_id'))
		{
			$link = \lib\store::url();
			switch (a($result, 'pointer'))
			{
				case 'homepage':
					$link = $link;
					break;

				case 'products':
					$link .= '/p';
					break;

				case 'posts':
					$link .= '/n';
					break;

				case 'forms':
					$link .= '/f';
					break;

				case 'tags':
				case 'category':
					$link .= '/category';
					break;

				case 'hashtag':
					$link .= '/hashtag';
					break;

				case 'socialnetwork':
					if(!a($result, 'socialnetwork'))
					{
						// nothing
					}
					else
					{
						$social_detail = \lib\store::social($result['socialnetwork']);
						$link = a($social_detail, 'link');
					}
					break;

				case 'other':
					if(!a($result, 'url'))
					{
						// nothing
					}
					else
					{
						$target_blank = true;
						$link = $result['url'];
					}
					break;

				case 'title':
				case 'separator':
				case 'selffile':
				default:
					// have no link
					// nothing
					break;
			}

			$result['url'] = $link;
		}

		$result['child'] = [];
		return $result;
	}


	private static $get_my_social = [];
	private static function get_my_social($_social)
	{
		if(!self::$get_my_social)
		{
			self::$get_my_social = \lib\store::social();
		}

		if(isset(self::$get_my_social[$_social]['link']))
		{
			return self::$get_my_social[$_social]['link'];
		}

		return null;
	}
}
?>