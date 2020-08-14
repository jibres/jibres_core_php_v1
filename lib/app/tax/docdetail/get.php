<?php
namespace lib\app\tax\docdetail;


class get
{


	public static function get($_id)
	{
		$id = \dash\validate::id($_id);

		if(!$id)
		{
			return false;
		}

		$result = \lib\db\tax_docdetail\get::by_id($id);

		if(!$result)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$result = \lib\app\tax\docdetail\ready::row($result);
		return $result;
	}


	public static function list($_id)
	{
		$id = \dash\validate::id($_id);

		if(!$id)
		{
			return false;
		}

		$result = \lib\db\tax_docdetail\get::by_doc_id($id);

		if(!is_array($result))
		{
			$result = [];
		}

		$result = array_map(['\\lib\\app\\tax\\docdetail\\ready', 'row'], $result);


		return $result;
	}

}
?>