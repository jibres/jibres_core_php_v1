<?php
namespace lib\app\tax\coding;


class get
{
	public static function generate_code_details($_assistant_id)
	{
		$last_code = \lib\db\tax_coding\get::last_code_assistant($_assistant_id);
		if(!$last_code)
		{
			return '10'; // first detail item in thsi assistant
		}
		else
		{
			$code = substr($last_code, 6);
			$code = intval($code) + 1;

			if($code < 10)
			{
				$code = '0'. $code;
			}

			return (string) $code;
		}

	}



	public static function get_count_group()
	{
		$result = \lib\db\tax_coding\get::get_count_group();
		if(!is_array($result))
		{
			$result = [];
		}

		$result['all'] = array_sum($result);
		return $result;
	}

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
			case 'group':
				$list = \lib\db\tax_coding\get::list_group($_type);
				break;

			case 'total':
				$list = \lib\db\tax_coding\get::list_total($_type);
				break;

			case 'assistant':
				$list = \lib\db\tax_coding\get::list_assistant();
				break;

			case 'details':
			default:
				$list = \lib\db\tax_coding\get::list_details($_type);
				return $list;
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