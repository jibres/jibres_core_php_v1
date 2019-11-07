<?php
namespace lib\app\customer;

class metafield
{
	private static $query = [];


	public static function lastactivity($_customer_id)
	{
		if(!is_numeric($_customer_id))
		{
			return false;
		}

		$date          = date("Y-m-d H:i:s");
		self::$query[] = \lib\db\userstores\metafield::lastactivity($_customer_id, $date);
	}


	public static function staff($_staff_id, $_type)
	{
		self::lastactivity($_staff_id);
		self::$query[] = \lib\db\userstores\metafield::staff($_staff_id, $_type);
	}


	public static function customer($_customer_id)
	{
		self::lastactivity($_customer_id);
		self::$query[] = \lib\db\userstores\metafield::customer($_customer_id);
	}


	public static function supplier($_supplier_id)
	{
		self::lastactivity($_supplier_id);
		self::$query[] = \lib\db\userstores\metafield::supplier($_supplier_id);
	}


	public static function save()
	{
		$query  = self::$query;
		$query  = array_filter($query);
		$result = null;

		if(!empty($query))
		{
			$query = implode(';', $query);
			$result = \dash\db::query($query, true, ['multi_query' => true]);
		}

		self::$query = [];

		return $result;
	}
}
?>