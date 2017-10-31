<?php
namespace lib\app\staff;

trait datalist
{
	/**
	 * Gets the staff.
	 *
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     <type>  The staff.
	 */
	public static function list($_args = [])
	{
		if(!\lib\user::id())
		{
			return false;
		}

		$meta            = [];
		$result          = \lib\db\staffs::search(\lib\user::id(), $meta);
		$temp            = [];
		foreach ($result as $key => $value)
		{
			$check = self::ready($value);
			if($check)
			{
				$temp[] = $check;
			}
		}

		return $temp;
	}
}
?>