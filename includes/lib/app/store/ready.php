<?php
namespace lib\app\store;


class ready
{

	public static function row($_data, $_option = [])
	{
		$default_option =
		[

		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);

		$result = [];

		if(!is_array($_data))
		{
			return null;
		}

		foreach ($_data as $key => $value)
		{

			switch ($key)
			{

				case 'creator':
				case 'owner':
					if(isset($value))
					{
						$result[$key] = \dash\coding::encode($value);
					}
					else
					{
						$result[$key] = null;
					}
					break;

				case 'logo':
					if(!$value)
					{
						$value = \dash\app::static_logo_url();
					}
					$result[$key] = $value;
					break;

				case 'ip':
				case 'dbip':
					$result[$key. '_raw'] = $value;
					if($value)
					{
						if(!is_int($value))
						{
							$value = intval($value);
						}
						$result[$key] = long2ip($value);
					}
					break;

				case 'subdomain':
					$result[$key] = $value;
					$result['url'] = \dash\url::protocol(). '://'. $value. '.'. \dash\url::domain();
					break;

				case 'status':
				case 'plan':
					$result[$key] = $value;
					if($value)
					{
						$result['t_'. $key] = T_(ucfirst($value));
					}

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