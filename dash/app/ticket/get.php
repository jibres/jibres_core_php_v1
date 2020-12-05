<?php
namespace dash\app\ticket;

class get
{

	public static function conversation($_id)
	{
		$id = \dash\validate::id($_id);
		if(!$id)
		{
			return false;
		}

		$conversation = \dash\db\tickets\get::conversation($id);
		if(!is_array($conversation))
		{
			$conversation = [];
		}

		$conversation = array_map(['\\dash\\app\\ticket', 'ready'], $conversation);

		return $conversation;
	}
}
?>