<?php
namespace content_a;


class filter
{
	public static function createMsg($_args)
	{
		$result = null;
		$searchText = \dash\request::get('q');

		if($searchText)
		{
			$result = T_('Search with keyword :search', ['search' => '<b>'. $searchText. '</b>']);
		}

		$filterArray = self::filter_condition_msg($_args);

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
					$value = \dash\fit::number($value);
				}
				$result .= T_($key) . ' <b>'. T_(ucfirst($value)). '</b>';
				$index++;
			}
		}

		return $result;
	}



	private static function filter_condition_msg($_args)
	{
		$filter_array = $_args;

		unset($filter_array['sort']);
		unset($filter_array['order']);

		switch (\dash\url::module())
		{
			case 'factor':
				if(isset($filter_array['customer']))
				{
					$myDataTable = \dash\data::dataTable();
					if(is_array($myDataTable))
					{
						$customer_displayname   = array_column($myDataTable, 'customer_displayname', 'customer');
					}

					$temp = array_key_exists($filter_array['customer'], $customer_displayname) === false ? T_("Invalid") : $customer_displayname[$filter_array['customer']];
					unset($filter_array['customer']);
					$filter_array[T_('Customer')] = $temp;
				}
				break;
			case 'product':

				if(isset($filter_array['duplicatetitle']))
				{
					unset($filter_array['duplicatetitle']);
					$filter_array[T_("Duplicate title")] = '';
				}
				if(isset($filter_array['hbarcode']))
				{
					unset($filter_array['hbarcode']);
					$filter_array[T_("Have barcode")] = '';
				}
				if(isset($filter_array['hnotbarcode']))
				{
					unset($filter_array['hnotbarcode']);
					$filter_array[T_("Have not barcode")] = '';
				}
				if(isset($filter_array['justcode']))
				{
					unset($filter_array['justcode']);
					$filter_array[T_("Just code")] = '';
				}
				if(isset($filter_array['wcodbarcode']))
				{
					unset($filter_array['wcodbarcode']);
					$filter_array[T_("No barcode & code")] = '';
				}
				if(isset($filter_array['wbuyprice']))
				{
					unset($filter_array['wbuyprice']);
					$filter_array[T_("Without buyprice")] = '';
				}
				if(isset($filter_array['wprice']))
				{
					unset($filter_array['wprice']);
					$filter_array[T_("Without price")] = '';
				}
				if(isset($filter_array['wminstock']))
				{
					unset($filter_array['wminstock']);
					$filter_array[T_("Without min stock")] = '';
				}
				if(isset($filter_array['wmaxstock']))
				{
					unset($filter_array['wmaxstock']);
					$filter_array[T_("Without max stock")] = '';
				}
				if(isset($filter_array['wdiscount']))
				{
					unset($filter_array['wdiscount']);
					$filter_array[T_("Without discount")] = '';
				}

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


	public static function current($_field, $_url)
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
