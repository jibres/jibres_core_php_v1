<?php
namespace content_a;


class filter
{
	public function createFilterMsg($_args)
	{
		$result = null;
		$searchText = \dash\request::get('q');

		if($searchText)
		{
			$result = T_('Search with keyword :search', ['search' => '<b>'. $searchText. '</b>']);
		}

		$filterArray = $this->filter_condition_msg($_args);

		if($filterArray)
		{
			$result .= ' '. T_('with condition'). ' ';
			$index  = 0;
			foreach ($filterArray as $key => $value)
			{
				if($result && $index > 0)
				{
					$result .= T_(', ');
				}
				if($value === 1)
				{
					$value = 'enable';
				}
				elseif($value === 0)
				{
					$value = 'disable';
				}
				if(is_numeric($value))
				{
					$value = \dash\utility\human::fitNumber($value);
				}
				$result .= T_($key) . ' <b>'. T_(ucfirst($value)). '</b>';
				$index++;
			}
		}

		return $result;
	}



	public function filter_condition_msg($_args)
	{
		$filter_array = $_args;

		unset($filter_array['sort']);
		unset($filter_array['order']);

		switch (\dash\url::module())
		{
			case 'factor':
				if(isset($filter_array['customer']))
				{
					if(is_array($this->data->dataTable))
					{
						$customer_displayname   = array_column($this->data->dataTable, 'customer_displayname', 'customer');
					}

					$temp = array_key_exists($filter_array['customer'], $customer_displayname) === false ? T_("Invalid") : $customer_displayname[$filter_array['customer']];
					unset($filter_array['customer']);
					$filter_array[T_('Customer')] = $temp;
				}
				break;

			case 'thirdparty':
				if(isset($filter_array['supplier']))
				{
					$filter_array['type'] = T_("Supplier");
					unset($filter_array['supplier']);
				}
				if(isset($filter_array['staff']))
				{
					$filter_array['type'] = T_("Staff");
					unset($filter_array['staff']);
				}
				if(isset($filter_array['customer']))
				{
					$filter_array['type'] = T_("Customer");
					unset($filter_array['customer']);
				}
				break;

			default:
				# code...
				break;
		}
		return $filter_array;
	}


	public static function make_sort_link($_field, $_url)
	{
		$get = \dash\request::get();
		if(!is_array($get))
		{
			$get = [];
		}

		$default_get =
		[
			'q'     => null,
			'sort'  => null,
			'order' => null,
		];

		$get          = array_merge($default_get, $get);
		$get['order'] = mb_strtolower($get['order']);
		$get['sort']  = mb_strtolower($get['sort']);

		$link = [];

		foreach ($_field as $key => $field)
		{
			$temp_link         = [];
			$temp_link['sort'] = $field;

			if($field === $get['sort'])
			{
				$temp_link['order'] = 'asc';
				if($get['order'] === 'asc')
				{
					$temp_link['order'] = 'desc';
				}
				$link[$field]['order'] = $temp_link['order'] === 'asc' ? 'desc' : 'asc';
			}
			else
			{
				$temp_link['order']    = 'asc';
				$link[$field]['order'] = null;
			}

			$temp_link['q']    = $get['q'];

			if(is_array(\dash\request::get()))
			{
				foreach (\dash\request::get() as $query_key => $query_value)
				{
					if(!in_array($query_key, ['q', 'sort', 'order']))
					{
						$temp_link[$query_key] = $query_value;
					}
				}
			}

			$link[$field]['link'] = $_url . '?'.  http_build_query($temp_link);
		}
		return $link;
	}
}
?>
