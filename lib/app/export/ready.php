<?php
namespace lib\app\export;


class ready
{

	public static function row($_data, $_option = [])
	{
		$default_option =
		[
			'load_gallery' => false,
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
					// skipp show this fields
					break;

				case 'status':
					$result[$key] = $value;
					$result['tstatus'] = T_(ucfirst($value));
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