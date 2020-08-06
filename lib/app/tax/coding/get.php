<?php
namespace lib\app\tax\coding;


class get
{
	public static function parent_list($_type)
	{
		switch ($_type)
		{
			case 'group':
				$list = [];
				break;

			case 'total':
				$list = \lib\db\tax_coding\get::parent_list_total();
				break;

			case 'assistant':
				$list = \lib\db\tax_coding\get::parent_list_assistant();
				break;

			case 'details':
			default:
				$list = \lib\db\tax_coding\get::parent_list_details($_type);
				break;
		}

		if(!is_array($list))
		{
			$list = [];
		}

		$list = array_map(['\\lib\\app\\tax\\coding\\ready', 'row'], $list);
		return $list;
	}


	public static function list_of($_type)
	{
		switch ($_type)
		{


			case 'assistant':
				$list = \lib\db\tax_coding\get::list_assistant();
				break;

			case 'details':
			default:
				$list = \lib\db\tax_coding\get::list_details($_type);
				break;
		}

		if(!is_array($list))
		{
			$list = [];
		}

		$list = array_map(['\\lib\\app\\tax\\coding\\ready', 'row'], $list);
		return $list;
	}


	public static function get($_id)
	{
		$id = \dash\validate::id($_id);

		if(!$id)
		{
			return false;
		}

		$result = \lib\db\tax_coding\get::by_id($id);

		if(!$result)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$result = \lib\app\tax\coding\ready::row($result);
		return $result;
	}

}
?>