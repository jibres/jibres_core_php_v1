<?php
namespace dash;

/**
 * Class for store.
 */
class store_coding
{


	public static function decode($_code)
	{
		// check string and exist
		if(!$_code || !is_string($_code))
		{
			return false;
		}

		// check lenght
		if(mb_strlen($_code) !== 6)
		{
			return false;
		}
		// check $
		if(substr($_code, 0, 1) !== '$')
		{
			return false;
		}

		$_code = substr($_code, 1);

		return self::decode_raw($_code);

	}


	public static function decode_raw($_code)
	{
		$id = \dash\coding::decode($_code, 'store');

		if($id && intval($id) > 1000000 && intval($id) < 1100000)
		{
			return $id;
		}
		else
		{
			return false;
		}
	}


	public static function encode($_id = null)
	{
		$code = self::encode_raw($_id);

		if($code)
		{
			return '$'. $code;
		}

		return null;
	}


	public static function encode_raw($_id = null)
	{
		if(!$_id)
		{
			$_id = \lib\store::id();
		}

		if($_id)
		{
			return \dash\coding::encode($_id, 'store');
		}

		return null;
	}









}
?>