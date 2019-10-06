<?php
namespace lib\db\userstores;

class metafield
{
	public static function lastactivity($_id, $_date)
	{
		return "UPDATE userstores SET userstores.lastactivity = '$_date' WHERE userstores.id = $_id LIMIT 1";
	}


	public static function staff($_id, $_type, $_pay = false)
	{
		$query = null;

		if($_type === 'sale')
		{
			if($_pay)
			{

				// calculate sumsalestaff
			}
			else
			{
				// calculate countorderstaff
				$query = "UPDATE userstores SET userstores.countorderstaff = (SELECT COUNT(*) FROM factors WHERE factors.type = 'sale' AND factors.seller = $_id) WHERE userstores.id = $_id LIMIT 1";
			}
		}
		elseif($_type === 'buy')
		{
			if($_pay)
			{
				// calculate sumbuystaff
			}
			else
			{
				// calculate countorderbuystaff
				$query = "UPDATE userstores SET userstores.countorderbuystaff = (SELECT COUNT(*) FROM factors WHERE factors.type = 'buy' AND factors.seller = $_id) WHERE userstores.id = $_id LIMIT 1";
			}
		}

		return $query;
	}


	public static function supplier($_id, $_pay = false)
	{
		$query = null;

		if($_pay)
		{
			// calculate sumpaysupplier
		}
		else
		{
			// calculate countordersupplier
			$query = "UPDATE userstores SET userstores.countordersupplier = (SELECT COUNT(*) FROM factors WHERE factors.type = 'buy' AND factors.customer = $_id) WHERE userstores.id = $_id LIMIT 1";
		}

		return $query;
	}


	public static function customer($_id, $_pay = false)
	{
		$query = null;

		if($_pay)
		{
			// calculate sumpaycustomer
		}
		else
		{
			// calculate countordercustomer
			$query = "UPDATE userstores SET userstores.countordercustomer = (SELECT COUNT(*) FROM factors WHERE factors.type = 'sale' AND factors.customer = $_id) WHERE userstores.id = $_id LIMIT 1";
		}
		return $query;
	}
}
?>