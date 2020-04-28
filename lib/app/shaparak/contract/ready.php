<?php
namespace lib\app\shaparak\contract;


class ready
{

	// remove useless field to send to shaparak
	public static function for_shaparak($_data)
	{
		$result = [];
		foreach ($_data as $key => $value)
		{
			switch ($key)
			{

				case 'contractDate':
				case 'serviceStartDate':
					if($value)
					{
						$result[$key] = strtotime($value). '000';
					}
					else
					{
						$result[$key] = null;
					}
					break;
				case 'contractNumber':
					$result[$key] = $value;
					break;

				default:
					// nothing
					break;
			}
		}

		return $result;
	}


	public static function ready($_data)
	{
		$result = [];
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