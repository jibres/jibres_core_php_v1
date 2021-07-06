<?php
namespace lib\app\tax\doc;


class get
{
	public static function new_doc_number()
	{
		$default_year = \lib\app\tax\year\get::default_year();

		$year_id = null;
		if(isset($default_year['id']))
		{
			$year_id = $default_year['id'];
		}

		$get_last = \lib\db\tax_document\get::last_number($year_id);

		if(!$get_last || !is_numeric($get_last))
		{
			return 1;
		}
		else
		{
			return floatval($get_last) + 1;
		}
	}


	public static function get($_id)
	{
		$id = \dash\validate::id($_id);

		if(!$id)
		{
			return false;
		}

		$result = \lib\db\tax_document\get::by_id($id);

		if(!$result)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$result = \lib\app\tax\doc\ready::row($result);
		return $result;
	}


	public static function opening_doc($_year_id)
	{
		$year_id = \dash\validate::id($_year_id);
		if($year_id)
		{
			$result = \lib\db\tax_document\get::opening_doc($year_id);
			if($result)
			{
				$result = \lib\app\tax\doc\ready::row($result);
				return $result;
			}

		}

		return null;
	}

}
?>