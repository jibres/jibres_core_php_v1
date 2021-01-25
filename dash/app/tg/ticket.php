<?php
namespace dash\app\tg;


class ticket
{
	public static function answer($_id, $_answer)
	{
		// save answer
		$args =
		[
			'content' => $_content,
		];

		\dash\app\ticket\answer::add($args, $_id);

		return true;
	}


	public static function create($_content)
	{
		$args =
		[
			'via' => 'telegram',
			'content' => $_content,
		];
		\dash\app\ticket\add\add($args);
	}


	public static function list($_id)
	{
		$_id = \dash\utility\convert::to_en_number($_id);
		$dataTable = \dash\app\ticket\get::conversation($_id);

		if(!$dataTable)
		{
			return false;
		}


		$msg = '';
		$msg .= "🆔#Ticket".$_id. "\n";

		if(is_array($dataTable))
		{
			foreach ($dataTable as $key => $value)
			{
				$msg .= "🗣 ". a($value, 'displayname'). " #user". a($value, 'user_id');

				if(isset($value['title']))
				{
					$msg .= "\n📬 ";
					$msg .= "<b>". strip_tags($value['title']). "</b>";
				}

				if(isset($value['content']))
				{
					$msg .= "\n". strip_tags($value['content']). "\n";
				}

				if(isset($value['datecreated']))
				{
					$msg .= "\n⏳ ". \dash\datetime::fit($value['datecreated'], true);
				}
				$msg .= "\n—————\n ";
			}
		}

		return $msg;
	}
}
?>