<?php
namespace lib\app\form\view;


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
				default:
					$result[$key] = $value;
					break;
			}
		}


		return $result;
	}



}
?>