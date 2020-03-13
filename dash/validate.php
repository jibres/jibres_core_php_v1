<?php
namespace dash;
/**
 * Class for validate
 */
class validate
{

	public static function __callStatic($_function, $_args)
	{
		$data = null;

		if(isset($_args[0]))
		{
			$data = $_args[0];
		}

		$notif = false;

		if(isset($_args[1]))
		{
			$notif = $_args[1];
		}

		return \dash\cleanse::data($_function, $data, $notif);
	}
}
?>