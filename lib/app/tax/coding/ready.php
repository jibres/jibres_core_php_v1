<?php
namespace lib\app\tax\coding;


class ready
{

	public static function row($_data)
	{
		if(!is_array($_data))
		{
			$_data = [];
		}

		$result     = [];
		$full_title = [];

		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'title':
					$full_title[] = $value;
					$result[$key] = $value;
					break;

				case 'code':
					$full_title[] = \dash\fit::text($value);
					$result[$key] = $value;
					break;

				default:
					$result[$key] = $value;
					break;
			}
		}

		$result['full_title'] = implode(' - ', $full_title);
		return $result;
	}

}
?>