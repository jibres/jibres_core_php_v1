<?php
namespace lib\app\form\form;


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
				case 'id':
					$result[$key] = $value;
					$result['url'] = \lib\store::url(). '/f/'. $value;
					break;

				case 'file':
					if($value)
					{
						$value = \lib\filepath::fix($value);
					}

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