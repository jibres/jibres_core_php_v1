<?php
namespace lib\db\pagebuilder;


class update
{

	public static function bind_text($_text, $_id)
	{
		if($_text)
		{
			$_text = stripslashes($_text);
		}

		$args =
		[
			'query' => "UPDATE pagebuilder SET pagebuilder.text = ? WHERE pagebuilder.id = ? LIMIT 1 ",
			'mode'  => 'query',
			'types' => 'sd',
			'param' => [$_text, $_id]
		];

		$result = \dash\db::bind($args);

		return $result;
	}


	public static function record($_args, $_id)
	{
		$set = \dash\db\config::make_set($_args);
		if(!$set)
		{
			return false;
		}

		$query  = "UPDATE pagebuilder SET $set WHERE pagebuilder.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}
}
?>
