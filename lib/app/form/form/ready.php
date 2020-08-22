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

				default:
					$result[$key] = $value;
					break;
			}
		}


		return $result;
	}



}
?>