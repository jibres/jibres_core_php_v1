<?php
namespace dash\app\ticket;

class add
{

	public static function add($_args)
	{
		$args = \dash\app\ticket\check::variable($_args);
		if(!$args)
		{
			return false;
		}

		$args['parent'] = $master['id'];

		$sendmessage = false;

		if($args['sendmessage'])
		{
			$sendmessage = true;
		}

		unset($args['sendmessage']);


		var_dump($args);
		var_dump($_args, $master);exit();

	}


}
?>