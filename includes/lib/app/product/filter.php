<?php
namespace lib\app\product;

class filter
{
	public static function sort_list()
	{
		$sort_list = [];
		$sort_list[] = ['title' => T_("Sort by price DESC"), 'query' => ['sort' => 'price', 'order' => 'desc']];
		$sort_list[] = ['title' => T_("Sort by price ASC"), 'query' => ['sort' => 'price', 'order' => 'asc']];

		$sort_list[] = ['title' => T_("Sort by title DESC"), 'query' => ['sort' => 'title', 'order' => 'desc']];
		$sort_list[] = ['title' => T_("Sort by title ASC"), 'query' => ['sort' => 'title', 'order' => 'asc']];


		foreach ($sort_list as $key => $value)
		{
			$sort_list[$key]['query_string'] = http_build_query($value['query']);
		}

		return $sort_list;
	}

}
?>