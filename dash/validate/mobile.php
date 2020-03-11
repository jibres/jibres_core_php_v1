<?php
namespace dash\validate;
/**
 * Class for validate args
 */
class mobile
{

	/**
	 * this function filter mobile value
	 * 1. remove space from mobile number if exist
	 * 2. remove + from first of number if exist
	 * 3. remove 0 from iranian number
	 * 4. start 98 to start of number for iranian number
	 *
	 * @param  [str] $_mobile
	 * @return [str] filtered mobile number
	 */
	public static function mobile($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{
		if($_data === null || $_data === '')
		{
			return null;
		}

		if(!is_string($data))
		{
			if($_notif)
			{
				\dash\notif::error(T_("Field :val must be string", ['val' => $_field_title]), ['element' => $_element, 'code' => 1600]);
			}
			return false;
		}

		$mymobile = str_replace(' ', '', $_data);

		// if user enter plus in start of number delete it
		if(substr($mymobile, 0, 1) === '+')
		{
			$mymobile = substr($mymobile, 1);
		}

		if(substr($mymobile, 0, 2) === '00')
		{
			// if user enter 00 in start of number delete it
			$mymobile = substr($mymobile, 2);
		}

		if(substr($mymobile, 0, 1) === '0')
		{
			$mymobile = substr($mymobile, 1);
		}

		if(!ctype_digit($mymobile))
		{
			if($_notif)
			{
				\dash\notif::error(T_("Mobile cannot be contained non digit character"), ['element' => $_element]);
			}
			return false;
		}

		if(floatval($mymobile) < 0)
		{
			if($_notif)
			{
				\dash\notif::error(T_("Invalid mobile number!"), ['element' => $_element]);
			}
			return false;
		}

		// check max and min number
		if(mb_strlen($mymobile) > 15 || mb_strlen($mymobile) < 8)
		{
			if($_notif)
			{
				\dash\notif::error(T_("Mobile must between 8 and 15 character"), ['element' => $_element]);
			}
			return false;
		}


		// if user type 10 number like 935 726 9759 and number start with 9 append 98 at first
		// Juest support Iranain mobile

		if(mb_strlen($mymobile) === 10 && substr($mymobile, 0, 1) === '9')
		{
			$mymobile = '98'.$mymobile;
		}


		if(isset($_meta['ir_mobile']) && $_meta['ir_mobile'])
		{
			if(mb_strlen($mymobile) !== 12)
			{
				if($_notif)
				{
					\dash\notif::error(T_("The IR mobile number must be contain exactly 12 character"), ['element' => $_element]);
				}
				return false;
			}

			if(substr($mymobile, 0, 3) !== '989')
			{
				if($_notif)
				{
					\dash\notif::error(T_("The IR mobile number must be start 989"), ['element' => $_element]);
				}
				return false;
			}
		}

		return $mymobile;
	}



	public static function ir_mobile($_data, $_notif, $_element = null, $_field_title = null, $_meta = [])
	{
		$meta              = $_meta;
		$meta['ir_mobile'] = true;

		return self::mobile($_data, $_notif, $_element, $_field_title, $meta);
	}


}
?>