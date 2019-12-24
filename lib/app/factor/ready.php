<?php
namespace lib\app\factor;



class ready
{


	/**
	 * ready data of factor to load in api
	 *
	 * @param      <type>  $_data  The data
	 */
	public static function row($_data)
	{

		$result = [];
		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'qty':
				case 'count':
					$value = \lib\number::down($value);
					$result[$key] = $value;
					break;


				case 'price':
					$value = \lib\price::down($value);
					$result[$key] = $value;
					break;

				case 'detailsum':
				case 'detailtotalsum':
				case 'sum':
					$value = \lib\price::down($value);
					$value = \lib\number::down($value);
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