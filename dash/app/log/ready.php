<?php
namespace dash\app\log;


class ready
{



	public static function row($_data)
	{
		if(!is_array($_data))
		{
			return false;
		}

		$result = [];

		$caller = null;


		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'id':
					$result[$key]     = $value;
					$result['id_raw'] = $value;
					break;

				case 'from':
				case 'to':
					$result[$key]          = $value;
					$result[$key. '_user'] = $value ? \dash\coding::encode($value) : null;
					break;

				case 'data':
					if($value && is_string($value))
					{
						$result['data'] = json_decode($value, true);
					}
					break;

				case 'caller':
					$result[$key] = $value;
					$caller       = $value;
					break;

					case 'displayname':
					if(!$value && $value != '0')
					{
						$value = T_("Without name");
					}
					$result[$key] = $value;
					break;


				case 'avatar':
					if($value)
					{
						$avatar = \lib\filepath::fix_avatar($value);
					}
					else
					{
						$avatar = \dash\app::static_avatar_url('unknown');
					}
					$result[$key] = $avatar;
					break;

				default:
					$result[$key] = $value;
					break;
			}
		}

		if($caller)
		{
			$result_fn = \dash\log::call_fn($caller, 'site', $result);
			if($result_fn && !is_array($result_fn))
			{
				$result['title'] = $result_fn;
			}
			elseif($result_fn && is_array($result_fn))
			{
				$result = array_merge($result, $result_fn);
			}
			else
			{
				$title = T_("Unknown");

				switch ($caller)
				{
					case 'kavenegar:service:411:call': $title = T_("Unknown"); break;
				}
				$result['title'] = $title;

			}
		}


		return $result;
	}
}
?>