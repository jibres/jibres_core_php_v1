<?php
namespace lib\app\form\item;


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
				case 'type':
					$result[$key] = $value;
					$result['type_detail'] = \lib\app\form\item\type::get($value);
					break;

				case 'setting':
				case 'choice':
					if($value && is_string($value))
					{
						$value = json_decode($value, true);
					}

					if(!is_array($value))
					{
						$value = [];
					}

					$result[$key] = $value;

					break;

				default:
					$result[$key] = $value;
					break;
			}
		}

		$random_choice = false;
		if(isset($result['setting']) && is_array($result['setting']))
		{
			foreach ($result['setting'] as $k => $v)
			{
				if(isset($v['random']) && $v['random'])
				{
					$random_choice = true;
				}
			}
		}

		if($random_choice && isset($result['choice']) && is_array($result['choice']) && $result['choice'] && \dash\url::content() != 'a')
		{
			shuffle($result['choice']);
		}

		return $result;
	}



}
?>