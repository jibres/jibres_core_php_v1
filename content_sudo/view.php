<?php
namespace content_sudo;

class view
{
	public static function config()
	{
		\dash\data::include_adminPanel(true);

		\dash\data::dir_right(\dash\language::dir() == 'rtl'? 'left':  'right');
		\dash\data::dir_left(\dash\language::dir() == 'rtl'? 'right': 'left');

		if(\dash\url::directory())
		{
			\dash\face::title(T_(ucfirst( str_replace('/', ' ', \dash\url::directory()) )));
		}

		\dash\data::badge_shortkey(120);
		\dash\data::badge2_shortkey(121);
	}



	/**
	 * MAKE ORDER URL
	 *
	 * @param      <type>  $_args    The arguments
	 * @param      <type>  $_fields  The fields
	 */
	public static function orderUrl($_args, $_fields)
	{
		$orderUrl = [];
		foreach ($_fields as $key => $value)
		{

			if(isset($_args->get("sort")[0]))
			{
				if($_args->get("sort")[0] == $value)
				{
					if(\dash\str::mb_strtolower($_args->get("order")[0]) == \dash\str::mb_strtolower('ASC'))
					{
						$orderUrl[$value] = "sort=$value/order=desc";
					}
					else
					{
						$orderUrl[$value] = "sort=$value/order=asc";
					}
				}
				else
				{

					$orderUrl[$value] = "sort=$value/order=asc";
				}
			}
			else
			{
				$orderUrl[$value] = "sort=$value/order=asc";
			}
		}

		\dash\data::orderUrl($orderUrl);
	}




	public static function su_make_sortLink($_field, $_url)
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
		$get['order'] = \dash\str::mb_strtolower($get['order']);
		$get['sort']  = \dash\str::mb_strtolower($get['sort']);

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


	public static function su_createFilterMsg($_searchText, $_filterArray)
	{
		$result = null;

		if($_searchText)
		{
			$result = T_('Search with keyword :search', ['search' => '<b>'. $_searchText. '</b>']);
		}

		if($_filterArray)
		{
			$result .= ' '. T_('with condition'). ' ';
			$index  = 0;
			foreach ($_filterArray as $key => $value)
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
}
?>