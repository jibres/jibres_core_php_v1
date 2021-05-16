<?php
namespace lib\app\tag;


class get
{

	public static function sitemap_list($_from, $_to)
	{
		$list = \lib\db\productcategory\get::sitemap_list($_from, $_to);

		if(!is_array($list))
		{
			return false;
		}

		$list = array_map(['\\lib\\app\\tag\\ready', 'row'], $list);

		return $list;
	}

	public static function all_category()
	{
		$result = \lib\db\productcategory\get::all_category();
		return $result;
	}

	public static function product_cat($_product_id)
	{
		$get_usage = \lib\db\productcategoryusage\get::usage($_product_id);
		return $get_usage;
	}


	public static function inline_get($_id)
	{
		$_id = \dash\validate::id($_id);

		if(!$_id)
		{
			\dash\notif::error(T_("Invalid category id"));
			return false;
		}

		$load = \lib\db\productcategory\get::one($_id);
		if(!$load)
		{
			\dash\notif::error(T_("Invalid category id"));
			return false;
		}

		return $load;
	}


	public static function get($_id)
	{
		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		\dash\permission::access('_group_products');

		$_id = \dash\validate::id($_id);

		if(!$_id)
		{
			\dash\notif::error(T_("Invalid category id"));
			return false;
		}

		$load = \lib\db\productcategory\get::one($_id);
		if(!$load)
		{
			\dash\notif::error(T_("Invalid category id"));
			return false;
		}

		$load['count'] = \lib\db\productcategory\get::get_count_product($_id);

		$load = \lib\app\tag\ready::row($load);
		return $load;
	}


	public static function parent_list($_id = null)
	{
		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		$_id = \dash\validate::id($_id);

		if(!$_id)
		{
			$_id = null;
		}

		$all_list = \lib\db\productcategory\get::parent_list($_id);
		if(!is_array($all_list))
		{
			$all_list = [];
		}

		$all_list = array_map(['\\lib\\app\\category\\ready', 'row'], $all_list);
		return $all_list;
	}



	public static function by_url($_url)
	{
		$url = \dash\validate::string_400($_url, false);

		if(!$url)
		{
			return false;
		}


		$split_url = explode('/', $url);
		$end = end($split_url);

		$load = \lib\db\productcategory\get::by_url($end);

		if(!$load)
		{
			return false;
		}

		$load = \lib\app\tag\ready::row($load);

		if(isset($load['full_slug']) && $load['full_slug'] === $url)
		{
			return $load;
		}
		else
		{
			return false;
		}
	}


	private  static function make_child_ready($list)
	{

		if(!is_array($list))
		{
			$list = [];
		}
		// add child index
		$list = array_map(function ($a){$a['child'] = []; return $a;}, $list);

		$list = array_combine(array_column($list, 'id'), $list);

		$new_list = [];

		foreach ($list as $key => $value)
		{
			$parent1 = a($value, 'parent1');
			$parent2 = a($value, 'parent2');
			$parent3 = a($value, 'parent3');
			$parent4 = a($value, 'parent4');


			if(!$parent1 && !$parent2 && !$parent3 && !$parent4)
			{
				$new_list[$key] = $value;
			}
		}


		foreach ($list as $key => $value)
		{
			$parent1 = a($value, 'parent1');
			$parent2 = a($value, 'parent2');
			$parent3 = a($value, 'parent3');
			$parent4 = a($value, 'parent4');


			if($parent1 && !$parent2 && !$parent3 && !$parent4)
			{
				$new_list[$parent1]['child'][$key] = $value;
			}
		}


		foreach ($list as $key => $value)
		{
			$parent1 = a($value, 'parent1');
			$parent2 = a($value, 'parent2');
			$parent3 = a($value, 'parent3');
			$parent4 = a($value, 'parent4');

			if($parent1 && $parent2 && !$parent3 && !$parent4)
			{
				$new_list[$parent1]['child'][$parent2]['child'][$key] = $value;
			}
		}


		foreach ($list as $key => $value)
		{
			$parent1 = a($value, 'parent1');
			$parent2 = a($value, 'parent2');
			$parent3 = a($value, 'parent3');
			$parent4 = a($value, 'parent4');

			if($parent1 && $parent2 && $parent3 && !$parent4)
			{
				$new_list[$parent1]['child'][$parent2]['child'][$parent3]['child'][$key] = $value;
			}

		}

		foreach ($list as $key => $value)
		{
			$parent1 = a($value, 'parent1');
			$parent2 = a($value, 'parent2');
			$parent3 = a($value, 'parent3');
			$parent4 = a($value, 'parent4');


			if($parent1 && $parent2 && $parent3 && $parent4)
			{
				$new_list[$parent1]['child'][$parent2]['child'][$parent3]['child'][$parent4]['child'][$key] = $value;
			}
		}


		return $new_list;
	}



	public static function sort_list()
	{

		$tag_list = \lib\app\tag\search::list(null, ['pagination' => false, 'sort_list' => 1]);

		if(!is_array($tag_list))
		{
			return null;
		}

		$tag_list = self::make_child_ready($tag_list);


        $defaul_option =
        [
            'subaddtitle'   => T_("Add sub tag"),
            'sublink'       => \dash\url::this(). '/edit',
            'sublink_args'  => [],
            'editlink'      => \dash\url::this(). '/edit',
            'editlink_args' => [],
        ];

		$result = '';
		$result .= '<ol class="items2" data-layer-limit="4" data-sortable>';
		$result .= self::generate_item($tag_list, $defaul_option);
		$result .= '</ol>';

		return $result;

	}



	private static function generate_item($_tag, $_option = [])
	{
        $result = '';

		foreach ($_tag as $index => $one_item)
		{
            $have_child = false;

			if(isset($one_item['child']) && is_array($one_item['child']) && $one_item['child'])
            {
                $have_child = true;
            }

			$result .= '<li>';
			$result .= '<div class="f item">';
            {
    			$result .= '<i class="sf-thumbnails" data-handle>';
                {
                    $result .= '<input type="hidden" name="sort[]" data-id="'. a($one_item, 'id'). '">';
                }
                $result .= '</i>';

                // $result .= '<i data-kerkere=".showMenu" data-kerkere-icon="open"></i>';

    			$result .= '<div class="key">'. a($one_item, 'title');
    			if(a($one_item, 'target'))
    			{
    				$result .= '<i class="sf-external-link fc-mute"></i>';
    			}
    			$result .= '</div>';

    			$result .= '<div class="value addChild pRa20-f s0">';
                {

                    $sublink_args = array_merge(['id' => a($one_item, 'id')], $_option['sublink_args']);

                    $result .= '<a href="'. $_option['sublink'] .'?'. \dash\request::build_query($sublink_args). '">'. $_option['subaddtitle']. '</a>';
                }
                $result .= '</div>';

    			$result .= '<div class="value">';
                {
                    $editlink_args = array_merge(['id' => a($one_item, 'id')], $_option['editlink_args']);

                    $result .= '<a href="'. $_option['editlink'] .'?'. \dash\request::build_query($editlink_args). '">'. T_("Edit"). '</a>';
                }
                $result .= '</div>';

                $result .= '<div class="value">';
                {
                    $editlink_args = array_merge(['id' => a($one_item, 'id')], $_option['editlink_args']);

                    $result .= '<div data-ajaxify data-data=\'{"remove": "'.a($one_item, 'id') .'"}\' href="'. $_option['editlink'] .'?'. \dash\request::build_query($editlink_args). '"><i class="sf-trash font-10 fc-red"></i></div>';
                }
                $result .= '</div>';
            }
			$result .= '</div>';

            if($have_child)
			{
				$result .= '<ol data-sortable>';
				$result .= self::generate_item($one_item['child'], $_option);
				$result .='</ol>';
			}
			else
			{
				$result .= '<ol data-sortable></ol>';
			}

			$result .= '</li>';
		}

        return $result;
	}
}
?>