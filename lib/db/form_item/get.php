<?php
namespace lib\db\form_item;


class get
{

	public static function by_multi_id($_ids)
	{
		$query = "SELECT * FROM form_item WHERE form_item.id IN ($_ids)";
		$result = \dash\pdo::get($query, []);
		return $result;
	}

	public static function by_id($_id)
	{
		$query = "SELECT * FROM form_item WHERE form_item.id = $_id LIMIT 1";
		$result = \dash\pdo::get($query, [], null, true);
		return $result;
	}



	public static function by_form_id($_form_id, $_deleted_itme = false, $_hidden_item = false)
	{
		$delted = "AND (form_item.status IS NULL OR form_item.status != 'deleted') ";
		// $delted = "AND (form_item.status IS NULL OR form_item.status != 'deleted') AND (form_item.hidden IS NULL OR form_item.hidden != 1 ) ";
		if($_deleted_itme)
		{
			$delted = '';
		}


		$hidden = "";
		if(!$_hidden_item)
		{
			$hidden = " AND (form_item.hidden IS NULL OR form_item.hidden != 1 ) ";
		}

		$query = "SELECT * FROM form_item WHERE form_item.form_id = $_form_id $delted $hidden ORDER BY IFNULL(form_item.sort, form_item.id) ASC ";
		$result = \dash\pdo::get($query);
		return $result;
	}


	public static function item_id_form_id($_ids, $_form_id)
	{
		$query = "SELECT * FROM form_item WHERE form_item.form_id = $_form_id AND form_item.id IN ($_ids) ";
		$result = \dash\pdo::get($query);
		return $result;

	}


	public static function get_by_id_form_id($_id, $_form_id)
	{
		$query = "SELECT * FROM form_item WHERE form_item.form_id = $_form_id AND form_item.id = $_id LIMIT 1";
		$result = \dash\pdo::get($query, [], null, true);
		return $result;
	}

    public static function by_type_form_id($_form_id, $_type)
    {
		$query = "SELECT * FROM form_item WHERE form_item.form_id = :form_id AND form_item.type = :type ";
		$param =
			[
				':form_id' => $_form_id,
				':type'    => $_type,
			];
		$result = \dash\pdo::get($query, $param);
		return $result;
    }


	public static function count_all($_form_id)
	{
		$query = "SELECT COUNT(*) AS `count` FROM form_item WHERE form_item.form_id = :form_id ";
		$param =
			[
				':form_id' => $_form_id,

			];
		$result = \dash\pdo::get($query, $param, 'count', true);
		return $result;
	}


}
?>
