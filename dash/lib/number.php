<?php
namespace dash;


class number
{

	public static function is($_check)
	{
		if(!is_numeric($_check))
		{
			return false;
		}

		// infinity number
		if(is_infinite($_check))
		{
			return false;
		}

		return true;
	}


	public static function is_larger($_number, $_max)
	{
		if(!self::is($_max))
		{
			return null;
		}

		if(!self::is($_number))
		{
			return null;
		}

		$len_number = strlen($_number);
		$len_max    = strlen($_max);

		if($len_number > $len_max)
		{
			return true;
		}
		elseif($len_number === $len_max)
		{
			for ($i = 0; $i < $len_number; $i++)
			{
				$n = substr($_number, $i, 1);
				$m = substr($_max, $i, 1);

				if(intval($n) > intval($m))
				{
					return true;
				}
			}

			return false;
		}
		elseif($len_number < $len_max)
		{
			return false;
		}
	}

}
?>