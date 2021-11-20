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
					$result[$key] = json_decode($value, true);
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

		if(isset($result['pointer']) && $result['pointer'] === 'selffile' && isset($result['file']))
		{
			$result['url'] = \lib\filepath::fix($result['file']);
		}

		if(isset($result['pointer']) && $result['pointer'] === 'homepage')
		{
			$result['url'] = \lib\store::url();
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