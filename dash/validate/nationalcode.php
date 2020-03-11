<?php
namespace dash\validate;

class nationalcode
{

	public static function nationalcode($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{
		$data = \dash\validate\number::number($_data, $_notif, $_element, $_field_title, ['min' => 1111111111, 'max' => 9999999999]);

		if($data === false || $data === null)
		{
			return $data;
		}

		$check = false;

		$data = (string) $data;

		if(!ctype_digit($data))
		{
			if($_notif)
			{
				\dash\notif::error(T_("nationalcode must be a number"), ['element' => $_element]);
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
				\dash\notif::error(T_("Invalid nationalcode"), ['element' => $_element]);
			}
			return false;
		}

		return $data;
	}

}
?>
