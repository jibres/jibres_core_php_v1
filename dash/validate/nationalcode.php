<?php
namespace dash\validate;

class nationalcode
{

	public static function nationalcode($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{
		$data = \dash\validate\text::string($_data, $_notif, $_element, $_field_title);

		if($data === false || $data === null)
		{
			return $data;
		}

		$check = false;

		$data = (string) $data;

		$data = \dash\number::clean($data);

		if(mb_strlen($data) !== 10)
		{
			if($_notif)
			{
				\dash\notif::error(T_("National code must be exactly 10 character"), ['element' => $_element]);
			}
			return false;
		}

		if(!ctype_digit($data))
		{
			if($_notif)
			{
				\dash\notif::error(T_("National code must be a number"), ['element' => $_element]);
			}
			return false;
		}


		$split      = str_split($data);
		$main_place = [];
		$i          = 10;
		$p          = 0;

		foreach ($split as $n => $value)
		{
			$main_place[$i] = $value;

			if ($i != 1)
			{
				$p = $p + ($value * $i);
			}
			$i--;
		}

		$b = fmod($p, 11);

		if ($b < 2)
		{
			if (intval($main_place[1]) === intval($b))
			{
				$check = true;
			}
			else
			{
				$check = false;
			}
		}
		else
		{
			if (intval($main_place[1]) === intval(11 - $b))
			{
				$check = true;
			}
			else
			{
				$check = false;
			}
		}

		if(!$check)
		{
			if($_notif)
			{
				\dash\notif::error(T_("Invalid national code"), ['element' => $_element]);
			}
			return false;
		}

		return $data;
	}

}
?>
