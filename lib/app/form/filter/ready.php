<?php
namespace lib\app\form\filter;


class ready
{

	public static function row($_data, $_choice = [])
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

				default:
					$result[$key] = $value;
					break;
			}
		}


		return $result;
	}


	public static function row_where($_data, $_field_title = [])
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
				case 'field':
					$result[$key] = $value;
					if(isset($_field_title[$value]['title']))
					{
						$result['field_title'] = $_field_title[$value]['title'];
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