<?php
namespace dash\app\comment;


class ready
{
	public static function row($_data)
	{
		$_data = \dash\app::fix_avatar($_data);
		$result = [];
		foreach ($_data as $key => $value)
		{

			switch ($key)
			{
				case 'user_id':
				case 'post_id':
					if(isset($value))
					{
						$result[$key] = \dash\coding::encode($value);
					}
					else
					{
						$result[$key] = null;
					}
					break;

				case 'status':
					$result['html_class'] = null;
					switch ($value)
					{
						case 'approved': 	$result['html_class'] = 'check ok'; break;
						case 'awaiting': 	$result['html_class'] = 'info'; break;
						case 'unapproved': 	$result['html_class'] = 'times nok'; break;
						case 'spam': 		$result['html_class'] = 'stop nok'; break;
						case 'deleted': 	$result['html_class'] = ''; break;
						case 'filter': 		$result['html_class'] = ''; break;

					}
					$result[$key]      = $value;
					$result['tstatus'] = T_(ucfirst($value));
					break;

				case 'product_thumb':
				case 'post_thumb':
					if($value)
					{
						$result[$key] = \lib\filepath::fix($value);
					}
					else
					{
						$result[$key] = \dash\app::static_image_url();
					}
					break;


				default:
					$result[$key] = $value;
					break;
			}
		}

		if(isset($result['user_id']) && $result['user_id'] && isset($result['user_displayname']))
		{
			$result['displayname'] = $result['user_displayname'];
		}

		// unset some variable in api
		if(\dash\temp::get('isApi'))
		{
			unset($result['gender_string']);
			unset($result['gender']);
			unset($result['tstatus']);
			unset($result['html_class']);
			unset($result['factor_id']);
			unset($result['agent_id']);
		}

		return $result;
	}

}
?>