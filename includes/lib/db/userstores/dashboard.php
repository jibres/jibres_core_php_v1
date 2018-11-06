<?php
namespace lib\db\userstores;

class dashboard
{
	private static $query = [];

// 	sumpaysupplier
// sumpaycustomer
// sumsalestaff
// countordercustomer
// countordersupplier
// countorderstaff
// lastpaycustomer
// lastactivity
// customercredit

	private static function query($_query)
	{
		self::$query[] = $_query;
		return true;
	}


	public static function save()
	{
		if(empty(self::$query))
		{
			return true;
		}
		elseif(count(self::$query) === 1)
		{
			return \dash\db::query(self::$query[0]);
		}
		else
		{
			return \dash\db::query(implode('; ', self::$query), true, ['mulity_query' => true]);
		}
	}


	public static function lastactivity($_userstore_id)
	{
		if(!is_numeric($_userstore_id))
		{
			return false;
		}

		$query = "UPDATE userstores SET userstores.lastactivity = '$date' WHERE userstores.id = $_userstore_id LIMIT 1";
		return self::query($query);
	}


	public static function staff($_userstore_id)
	{
		if(!is_numeric($_userstore_id))
		{
			return false;
		}

		$query =
		"
			UPDATE userstores SET
				userstores.lastactivity = '$date'
			WHERE
				userstores.id = $_userstore_id
			LIMIT 1
		";

		return self::query($query);
	}


	public static function supplier($_userstore_id)
	{

	}


	public static function customer($_userstore_id)
	{

	}
}
?>