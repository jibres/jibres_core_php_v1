<?php
namespace lib\app\form\item;


class get
{
	public static function items($_form_id, $_load_choice = true)
	{
		$_form_id = \dash\validate::id($_form_id);

		if(!$_form_id)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$list = \lib\db\form_item\get::by_form_id($_form_id);

		if(!is_array($list))
		{
			$list = [];
		}

		$all_choice = [];
		$choice = [];

		if($_load_choice)
		{

			$item_ids = array_column($list, 'id');


			$all_choice = \lib\db\form_choice\get::item_id_form_id(implode(',', $item_ids), $_form_id);

			if(!is_array($all_choice))
			{
				$all_choice = [];
			}

			$all_choice = array_map(['\\lib\\app\\form\\choice\\ready', 'row'], $all_choice);

			foreach ($all_choice as $key => $value)
			{
				if(!isset($choice[$value['item_id']]))
				{
					$choice[$value['item_id']] = [];
				}

				$choice[$value['item_id']][] = $value;
			}
		}

		$new_list = [];

		foreach ($list as $key => $value)
		{
			$new_list[] = \lib\app\form\item\ready::row($value, $choice);
		}

		return $new_list;
	}


	public static function items_answerable($_form_id)
	{
		$list = self::items($_form_id, false);
		if(!is_array($list))
		{
			return $list;
		}

		$new_list = [];

		foreach ($list as $key => $value)
		{
			if(isset($value['type']))
			{
				if($value['type'] === 'message')
				{
					continue;
				}
			}

			$new_list[] = $value;
		}

		return $new_list;

	}


	public static function items_comparable($_form_id)
	{
		$list = self::items($_form_id, false);
		if(!is_array($list))
		{
			return $list;
		}

		$new_list = [];

		foreach ($list as $key => $value)
		{
			if(isset($value['type_detail']['compare']) && $value['type_detail']['compare'])
			{
				$new_list[] = $value;
			}

		}

		return $new_list;

	}


	public static function get($_id)
	{

		$id = \dash\validate::id($_id);

		if(!$id)
		{
			return false;
		}

		$load = \lib\db\form_item\get::by_id($id);

		if(!$load)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$load = \lib\app\form\item\ready::row($load);

		return $load;
	}



	public static function get_by_id_form_id($_id, $_form_id)
	{
		$id = \dash\validate::id($_id);

		if(!$id)
		{
			return false;
		}

		$form_id = \dash\validate::id($_form_id);

		if(!$form_id)
		{
			return false;
		}


		$load = \lib\db\form_item\get::get_by_id_form_id($id, $form_id);

		if(!$load)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$load = \lib\app\form\item\ready::row($load);

		return $load;
	}
}
?>