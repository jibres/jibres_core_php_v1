<?php
namespace lib\db\nic_domainbilling;

class search
{
	private static function ready_to_sql($_and, $_or, $_order_sort = null, $_meta = [])
	{
		$where = null;
		$q     = [];

		if($_and)
		{
			$_and = implode(' AND ', $_and);
			$q[] = "$_and";

		}

		if($_or)
		{
			$_or = implode(' OR ', $_or);
			$q[] = "($_or)";
		}

		if($q)
		{
			$where = 'WHERE '. implode(" AND ", $q);
		}

		$order = null;
		if($_order_sort && is_string($_order_sort))
		{
			$order = $_order_sort;
		}

		$pagination = null;
		if(array_key_exists('pagination', $_meta))
		{
			$pagination = $_meta['pagination'];
		}

		$limit = null;
		if(array_key_exists('limit', $_meta))
		{
			$limit = $_meta['limit'];
		}

		return
		[
			'where'      => $where,
			'order'      => $order,
			'pagination' => $pagination,
			'limit'      => $limit,
		];
	}





	public static function list($_and, $_or, $_order_sort = null, $_meta = [])
	{

		$q = \dash\pdo\prepare_query::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query = "SELECT COUNT(*) AS `count` FROM domainbilling LEFT JOIN domain ON domain.id = domainbilling.domain_id  $q[where] ";

		$limit = null;
		if($q['pagination'] !== false)
		{
			$limit = \dash\db\pagination::pagination_query($pagination_query, $q['limit'], 'nic');
		}

		$query = "SELECT domainbilling.*, domain.name, domain.verify FROM domainbilling LEFT JOIN domain ON domain.id = domainbilling.domain_id $q[where] $q[order] $limit ";

		$result = \dash\pdo::get($query, [], null, false, 'nic');

		return $result;
	}



	public static function buyers($_and, $_or, $_order_sort = null, $_meta = [])
	{

		$q = \dash\pdo\prepare_query::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query = "SELECT COUNT(*) AS `count` FROM domainbilling LEFT JOIN domain ON domain.id = domainbilling.domain_id  $q[where]  GROUP BY domainbilling.user_id";

		$limit = null;
		if($q['pagination'] !== false)
		{
			$limit = \dash\db\pagination::pagination_query($pagination_query, $q['limit'], 'nic');
		}

		$query =
		"
			SELECT
				domainbilling.user_id,
				SUM(domainbilling.price) AS `sum_price`,
				SUM(domainbilling.discount) AS `sum_discount`,
				SUM(domainbilling.finalprice) AS `sum_finalprice`,
				MIN(domainbilling.datecreated) AS `first_pay`,
				MAX(domainbilling.datecreated) AS `last_pay`,
				COUNT(domain.id) AS `domain_count`
			FROM domainbilling LEFT JOIN domain ON domain.id = domainbilling.domain_id $q[where]  GROUP BY domainbilling.user_id $q[order] $limit ";

		$result = \dash\pdo::get($query, [], null, false, 'nic');


		return $result;
	}




}
?>