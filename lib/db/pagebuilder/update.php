<?php
namespace lib\db\pagebuilder;


class update
{

	public static function bind_text($_text, $_id)
	{

		// return self::PDO_bind_text(...func_get_args());


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


	public static function PDO_bind_text($_text, $_id)
	{

		if($_text)
		{
			$_text = stripslashes($_text);
		}

		$query = "UPDATE pagebuilder SET pagebuilder.text = :text WHERE pagebuilder.id = :id LIMIT 1 ";
		$param =
		[
			':text' => $_text,
			':id'   => $_id,
		];

		$result = \dash\pdo::query($query, $param);

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


	public static function set_sort($_sort)
	{
		$query = [];

		foreach ($_sort as $sort => $id)
		{
			$query[] = "UPDATE pagebuilder SET pagebuilder.sort = $sort WHERE pagebuilder.id = $id LIMIT 1 ";
		}

		$result = \dash\db::query(implode(';', $query), null, ['multi_query' => true]);
		return $result;
	}
}
?>
