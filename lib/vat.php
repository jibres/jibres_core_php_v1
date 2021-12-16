<?php
namespace lib;

class vat
{

	/**
	 * Get vat percent
	 *
	 * @return     int   ( description_of_the_return_value )
	 */
	public static function percent()
	{
		/**
			TODO:
			- need check Country and setting to return this number
		 */

		return 9;
	}


	/**
	 * Vat decimal
	 *
	 * @return   0.09
	 */
	public static function decimal()
	{
		return self::percent() / 100;
	}


}
?>
