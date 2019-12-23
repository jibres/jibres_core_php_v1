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
				case 'id':
				case 'store_id':
				case 'customer':
				case 'seller':
				case 'creator':

					if(isset($value))
					{
						$result[$key] = \dash\coding::encode($value);
					}
					else
					{
						$result[$key] = null;
					}
					break;

				case 'datecreated':
				case 'datemodified':

					break;

				default:
					$result[$key] = isset($value) ? $value : null;
					break;
			}
		}

		return $result;
	}
}
?>