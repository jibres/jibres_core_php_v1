<?php
namespace dash\layout\search;

/**
 * This class describes a search filter.
 * Generate html of filter items
 */
class search_filter
{
	/**
	 * Save form input to not load in input hidden
	 *
	 * @var        array
	 */
	private static $form_loaded_input = [];

	/**
	 * When ganerate an input put name of that input in this method
	 *
	 * @param      <type>  $_name  The name
	 */
	private static function set_input_loaded($_name)
	{
		self::$form_loaded_input[] = $_name;
	}


	/**
	 * Get list of hidden input
	 *
	 * @return     <type>  The form hidden input.
	 */
	public static function get_form_loaded_input()
	{
		return self::$form_loaded_input;
	}


	/**
	 * Generate filters html
	 *
	 * @return     string  The html filters.
	 */
	public static function get_html_filters()
	{
		$html = '';

		if(is_array(\dash\data::listEngine_filter()))
		{
			$html .= '<p class="alert-info">'. T_("Organize your data so it's easier to analyze. Filter your data if you only want to display records that meet certain criteria."). '</p>';
			$html .= '<div class="filterList">';

			$first            = true;
			$lastGroup        = null;
			$apply_filter_btn = false;

			foreach (\dash\data::listEngine_filter() as $key => $value)
			{
				$mode = null;
				if(isset($value['mode']) && $value['mode'])
				{
					$mode = $value['mode'];
				}

				$special_name = null;

				if(\dash\str::strpos($mode, ':') !== false)
				{
					$explode = explode(':', $mode);
					$mode = $explode[0];
					$special_name = $explode[1];
				}

				switch ($mode)
				{
					case 'posts_search':
						$apply_filter_btn = true;
						$html .= self::html_post_search($value);
						break;

					case 'users_search':
						$apply_filter_btn = true;
						$html .= self::html_users_search($value, $special_name);
						break;

					case 'daterange':
						$apply_filter_btn = true;
						$html .= self::html_daterange($value, $special_name);
						break;

					case 'less_equal_large':
						$apply_filter_btn = true;
						$html .= self::html_less_equal_large($value, $special_name);
						break;

					case 'date':
						$apply_filter_btn = true;
						$html .= self::html_date($value);
						break;

					case 'time':
						$apply_filter_btn = true;
						$html .= self::html_time($value);
						break;

					case 'weekday':
						$apply_filter_btn = true;
						$html .= self::html_weekday($value);
						break;

					case 'factor_type':
						$apply_filter_btn = true;
						$html .= self::html_factor_type($value);
						break;

					case 'product_tag_search':
						$apply_filter_btn = true;
						$html .= self::html_product_tag_search($value);
						break;

					case 'product_unit_search':
						$apply_filter_btn = true;
						$html .= self::html_product_unit_search($value);
						break;

					case 'product_search':
						$apply_filter_btn = true;
						$html .= self::html_product_search($value);
						break;


					case 'form_answer_status':
						$apply_filter_btn = true;
						$html .= self::html_form_answer_status_search($value);
						break;

					case 'form_answer_tag_search':
						$apply_filter_btn = true;
						$html .= self::html_form_answer_tag_search($value);
						break;

					case 'form_search':
						$apply_filter_btn = true;
						$html .= self::html_form_search($value, $special_name);
						break;



					case 'product_status_search':
						$apply_filter_btn = true;
						$html .= self::html_product_status_search($value);
						break;

					case 'raw_file':
						if(isset($value['file_addr']) && is_string($value['file_addr']) && is_file($value['file_addr']))
						{
							require_once($value['file_addr']);
						}
						break;

					// default
					default:

						if($lastGroup !== $value['group'])
						{
							$html .= '<div>'. T_("Group by"). ' '. $value['group']. '</div>';
							$lastGroup = $value['group'];
						}

						$html .= '<a class="';

						if(a($value, 'is_active'))
						{
							$html .= 'btn-dark ';
						}
						else
						{
							$html .= 'btn-light ';
						}
						$html .= 'mx-1';
						$html .= '" href="'. \dash\url::current(). '?'. a($value, 'query_string'). '">'. a($value, 'title'). '</a>';

						break;
				}

				$first = false;
			}
			$html .= '</div>';

			$html .= self::html_apply_cancel_btn($apply_filter_btn);

		}

		return $html;
	}



	private static function html_post_search($value)
	{
		self::set_input_loaded('post_id');

		$html = '';
		$html .= "<div class='mB10'>";
		$html .= '<label>'. a($value, 'title'). '</label>';
		$html .= '<select name="post_id" class="select22"  data-model=\'html\'  data-ajax--url="'. \dash\url::kingdom(). '/cms/posts/api?json=true" data-shortkey-search data-placeholder="'. a($value, 'title'). '">';
		if(\dash\request::get('post_id'))
		{
			$userselected_detail = \dash\app\posts\get::get(\dash\request::get('post_id'));
			if($userselected_detail)
			{
				$html .= '<option value="'. a($userselected_detail, 'id'). '">';
				$html .= a($userselected_detail, 'title');
				$html .= '</option>';
			}
			// $html .= "<option value=''>". T_("None"). '</option>';
		}
		$html .= '</select>';
		$html .= "</div>";
		return $html;
	}



	private static function html_daterange($value, $_specail_name = null)
	{

		$html = '';
		$html .= "<div class='mB10'>";
		{
			$start_time_name = 'std';
			$end_time_name = 'end';

			if($_specail_name)
			{
				$explode = explode('_', $_specail_name);
				if(a($explode, 0))
				{
					$start_time_name = $explode[0];
				}

				if(a($explode, 1))
				{
					$end_time_name = $explode[1];
				}
			}
			$html .= '<label>'. a($value, 'title'). '</label>';

			$std  = \dash\request::get($start_time_name);
			$end  = \dash\request::get($end_time_name);
			$from = T_("From date");
			$to   = T_("To date");

			self::set_input_loaded($start_time_name);
			self::set_input_loaded($end_time_name);

			$html .= '<div class="row">';
			{

				$html .= '<div class="c-xs-6 c-sm-6">';
				{

					$html .= '<div class="input">';
					{
						$html .= '<input type="tel" name="'.$start_time_name.'" value="'.$std. '" data-format="date" placeholder="'.$from.'">';
					}
					$html .= '</div>';
				}
				$html .= '</div>';

				$html .= '<div class="c-xs-6 c-sm-6">';
				{

					$html .= '<div class="input">';
					{
						$html .= '<input type="tel" name="'.$end_time_name.'" value="'.$end. '" data-format="date" placeholder="'.$to.'">';
					}
					$html .= '</div>';
				}
				$html .= '</div>';
			}
			$html .= '</div>';

		}
		$html .= "</div>";
		return $html;
	}




	private static function html_less_equal_large($value, $_specail_name = null)
	{
		$html = '';
		$html .= "<div class='mB10'>";
		{
			$name = 'number';

			if($_specail_name)
			{
				$name = $_specail_name;
			}

			$html .= '<label>'. a($value, 'title'). '</label>';

			$name_less    = $name. 'less';
			$name_equal   = $name. 'equal';
			$name_larger  = $name. 'larger';

			$value_less   = \dash\request::get($name_less);
			$value_equal  = \dash\request::get($name_equal);
			$value_larger = \dash\request::get($name_larger);

			$placeholder_less   = a($value, 'title') . ' '. T_("less than");
			$placeholder_equal  = a($value, 'title') . ' '. T_("equal");
			$placeholder_larger = a($value, 'title') . ' '. T_("larger than");

			self::set_input_loaded($name_less);
			self::set_input_loaded($name_equal);
			self::set_input_loaded($name_larger);

			$html .= '<div class="row">';
			{
				$html .= '<div class="c-xs-4 c-sm-4">';
				{
					$html .= '<div class="input">';
					{
						$html .= '<input type="tel" name="'.$name_less.'" value="'.$value_less. '" data-format="price" placeholder="'.$placeholder_less.'">';
					}
					$html .= '</div>';
				}
				$html .= '</div>';

				$html .= '<div class="c-xs-4 c-sm-4">';
				{

					$html .= '<div class="input">';
					{
						$html .= '<input type="tel" name="'.$name_equal.'" value="'.$value_equal. '" data-format="price" placeholder="'.$placeholder_equal.'">';
					}
					$html .= '</div>';
				}
				$html .= '</div>';

				$html .= '<div class="c-xs-4 c-sm-4">';
				{

					$html .= '<div class="input">';
					{
						$html .= '<input type="tel" name="'.$name_larger.'" value="'.$value_larger. '" data-format="price" placeholder="'.$placeholder_larger.'">';
					}
					$html .= '</div>';
				}
				$html .= '</div>';
			}
			$html .= '</div>';

		}
		$html .= "</div>";
		return $html;
	}




	private static function html_date($value)
	{
		self::set_input_loaded('date');
		$html = '';
		$html .= "<div class='mB10'>";
		{
			$html .= '<label>'. a($value, 'title'). '</label>';

			$date = \dash\request::get('date');

			$html .= '<div class="input">';
			{
				$html .= '<input type="tel" name="date" value="'.$date.'" data-format="date" placeholder="'.T_("Date").'">';
			}
			$html .= '</div>';
		}
		$html .= "</div>";

		return $html;
	}




	private static function html_time($value)
	{
		self::set_input_loaded('time');
		$html = '';
		$html .= "<div class='mB10'>";
		{
			$html .= '<label>'. a($value, 'title'). '</label>';

			$time = \dash\request::get('time');

			$html .= '<div class="input">';
			{
				$html .= '<input type="tel" name="time" value="'.$time.'" data-format="time" placeholder="'.T_("Time").'">';
			}
			$html .= '</div>';
		}
		$html .= "</div>";

		return $html;
	}


	/**
	 * Search in user
	 *
	 * @param      <type>  $value  The value
	 * @param      <type>  $_specail_name  The field name
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	private static function html_users_search($value, $_specail_name = null)
	{
		$request_get_name = 'user';

		if($_specail_name)
		{
			$request_get_name = $_specail_name;
		}

		self::set_input_loaded($request_get_name);

		$html = '';
		$html .= "<div class='mB10'>";
		$html .= '<label>'. a($value, 'title'). '</label>';
		$html .= '<select name="'.$request_get_name.'" class="select22"  data-model=\'html\'  data-ajax--url="'. \dash\url::kingdom(). '/crm/api?json=true" data-shortkey-search data-placeholder="'. a($value, 'title'). '">';
		if(\dash\request::get($request_get_name))
		{
			$userselected_detail = \dash\app\user::get(\dash\request::get($request_get_name));
			if($userselected_detail)
			{
				$html .= '<option value="'. a($userselected_detail, 'id'). '">';
				$html .= a($userselected_detail, 'displayname');
				$html .= '</option>';
			}
			// $html .= "<option value=''>". T_("None"). '</option>';
		}
		$html .= '</select>';
		$html .= "</div>";

		return $html;
	}


	private static function html_form_search($value, $_specail_name = null)
	{
		$request_get_name = 'form_id';

		if($_specail_name)
		{
			$request_get_name = $_specail_name;
		}

		self::set_input_loaded($request_get_name);

		$html = '';
		$html .= "<div class='mB10'>";
		$html .= '<label>'. a($value, 'title'). '</label>';
		$html .= '<select name="'.$request_get_name.'" class="select22"  data-model=\'html\'  data-ajax--url="'. \dash\url::kingdom(). '/a/form/api?json=true" data-shortkey-search data-placeholder="'. a($value, 'title'). '">';
		if(\dash\request::get($request_get_name))
		{
			$userselected_detail = \lib\app\form\form\get::public_get(\dash\request::get($request_get_name));
			if($userselected_detail)
			{
				$html .= '<option value="'. a($userselected_detail, 'id'). '">';
				$html .= a($userselected_detail, 'title');
				$html .= '</option>';
			}
			// $html .= "<option value=''>". T_("None"). '</option>';
		}
		$html .= '</select>';
		$html .= "</div>";

		return $html;
	}

	private static function html_form_answer_tag_search($value)
	{
		self::set_input_loaded('tagid');
		$html = '';
		$html .= "<div class='mB10'>";
		$html .= '<div class="row align-center">';
		$html .= '<div class="c"><label for="tag">'. T_("Tag"). '</label></div>';
		$html .= '<div class="c-auto os">';
		$html .= '<a class="font-12"';
		if(!\dash\detect\device::detectPWA())
		{ $html .= " target='_blank' ";
		}
		$html .= ' href="'. \dash\url::kingdom(). '/a/form/tag?id='.\dash\request::get('id').'">'. T_("Manage"). ' <i class="sf-link-external"></i></a>';
		$html .= '</div>';
		$html .= '</div>';

		$html .= '<div>';
		$html .= '<select name="tagid" id="tag" class="select22" data-model="tag" data-placeholder="'. T_("Select one tag"). '" data-ajax--delay="100" data-ajax--url="'. \dash\url::kingdom(). '/a/form/tag/api?json=true&getid=1&id='.\dash\request::get('id').'">';
		if(\dash\request::get('tagid'))
		{
				$html .= '<option value="0">'. T_("None"). '</option>';
				$loadTag = \lib\app\form\tag\get::inline_get(\dash\request::get('tagid'));
				$html .= '<option value="'. a($loadTag, 'id'). '" selected>'. a($loadTag, 'title') .'</option>';
		}
		else
		{
				$html .= '<option value=""></option>';
		}

		$html .= '</select>';
		$html .= '</div>';
		$html .= "</div>";
		return $html;
	}

	/**
	 * Search by product tag
	 *
	 * @param      <type>  $value  The value
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	private static function html_product_tag_search($value)
	{
		self::set_input_loaded('catid');
		$html = '';
		$html .= "<div class='mB10'>";
		$html .= '<div class="row align-center">';
		$html .= '<div class="c"><label for="tag">'. T_("Category"). '</label></div>';
		$html .= '<div class="c-auto os">';
		$html .= '<a class="font-12"';
		if(!\dash\detect\device::detectPWA())
		{ $html .= " target='_blank' ";
		}
		$html .= ' href="'. \dash\url::here(). '/category">'. T_("Manage"). ' <i class="sf-link-external"></i></a>';
		$html .= '</div>';
		$html .= '</div>';

		$html .= '<div>';
		$html .= '<select name="catid" id="tag" class="select22" data-model="tag" data-placeholder="'. T_("Select one category"). '" data-ajax--delay="100" data-ajax--url="'. \dash\url::kingdom(). '/a/category/api?json=true&getid=1">';
		if(\dash\request::get('catid'))
		{
				$html .= '<option value="0">'. T_("None"). '</option>';
				$loadCategory = \lib\app\category\get::get(\dash\request::get('catid'));
				$html .= '<option value="'. a($loadCategory, 'id'). '" selected>'. a($loadCategory, 'title') .'</option>';
		}
		else
		{
				$html .= '<option value=""></option>';
		}

		$html .= '</select>';
		$html .= '</div>';
		$html .= "</div>";
		return $html;
	}


	/**
	 * Search by product tag
	 *
	 * @param      <type>  $value  The value
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	private static function html_product_search($value)
	{
		self::set_input_loaded('product');
		$html = '';
		$html .= "<div class='mB10'>";
		$html .= '<label for="product">'. T_("Product"). '</label>';

		$html .= '<select name="product" id="product" class="select22" data-model="tag" data-placeholder="'. T_("Search in product"). '" data-ajax--delay="100" data-ajax--url="'. \dash\url::kingdom(). '/a/products/api?json=true">';
		if(\dash\request::get('product'))
		{
				$html .= '<option value="0">'. T_("None"). '</option>';
				$loadCategory = \lib\app\product\get::get(\dash\request::get('product'));
				$html .= '<option value="'. a($loadCategory, 'id'). '" selected>'. a($loadCategory, 'title') .'</option>';
		}
		else
		{
				$html .= '<option value=""></option>';
		}

		$html .= '</select>';
		$html .= "</div>";
		return $html;
	}



	/**
	 * Search in product unit
	 *
	 * @param      <type>  $value  The value
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	private static function html_product_unit_search($value)
	{
		self::set_input_loaded('unitid');
		$html = '';
		$html .= "<div class='mB10'>";
		$html .= '<div class="row align-center">';
		$html .= '<div class="c"><label for="unit">'. T_("Unit"). '</label></div>';
		$html .= '<div class="c-auto os">';
		$html .= '<a class="font-12"';
		if(!\dash\detect\device::detectPWA())
		{
			$html .= " target='_blank' ";
		}
		$html .= ' href="'. \dash\url::here(). '/units">'. T_("Manage"). ' <i class="sf-link-external"></i></a>';
		$html .= '</div>';
		$html .= '</div>';

		$html .= '<div>';
		$html .= '<select name="unitid" id="unit" class="select22" data-model="tag" data-placeholder="'. T_("like Qty, kg, etc"). '">';
		if(\dash\request::get('unitid'))
		{
				$html .= '<option value="0">'. T_("None"). '</option>';
		}
		else
		{
				$html .= '<option value=""></option>';
		}

		if(is_array(\dash\data::listUnits()))
		{
			foreach (\dash\data::listUnits() as $k => $v)
			{
					$html .= '<option value="'. $v['id']. '" ';
					if(\dash\request::get('unitid') === $v['id'])
					{
						$html .= 'selected';
					}
					$html .= '> '.$v['title']. '</option>';
			}
		}

		$html .= '</select>';
		$html .= '</div>';
		$html .= "</div>";
		return $html;
	}


	private static function html_form_answer_status_search($value)
	{
		self::set_input_loaded('status');

		$html = '';
		$html .= "<div class='mB10'>";
		$html .= '<label for="status">'. T_("Status"). '</label>';
		$html .= '<div>';
		$html .= '<select name="status" id="status" class="select22"  data-placeholder="'. T_("Answer Status"). '">';
		if(\dash\request::get('status'))
		{
				$html .= '<option value="0">'. T_("None"). '</option>';
		}
		else
		{
				$html .= '<option value=""></option>';
		}

		foreach (['draft','active','spam', 'archive', 'deleted'] as $k => $v)
		{
				$html .= '<option value="'. $v. '" ';
				if(\dash\request::get('status') === $v)
				{
					$html .= 'selected';
				}
				$html .= '> '. T_(ucfirst($v)). '</option>';
		}
		$html .= '</select>';
		$html .= '</div>';
		$html .= '</div>';
		return $html;

	}


	/**
	 * Search in product status
	 *
	 * @param      <type>  $value  The value
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	private static function html_product_status_search($value)
	{
		self::set_input_loaded('status');
		$html = '';
		$html .= "<div class='mB10'>";
		$html .= '<label for="status">'. T_("Status"). '</label>';
		$html .= '<div>';
		$html .= '<select name="status" id="status" class="select22"  data-placeholder="'. T_("Product Status"). '">';
		if(\dash\request::get('status'))
		{
				$html .= '<option value="0">'. T_("None"). '</option>';
		}
		else
		{
				$html .= '<option value=""></option>';
		}
		foreach (['draft','active','archive', 'deleted'] as $k => $v)
		{
				$html .= '<option value="'. $v. '" ';
				if(\dash\request::get('status') === $v)
				{
					$html .= 'selected';
				}
				$html .= '> '. T_(ucfirst($v)). '</option>';
		}
		$html .= '</select>';
		$html .= '</div>';
		$html .= '</div>';
		return $html;
	}


	private static function html_weekday($value)
	{
		self::set_input_loaded('weekday');
		$html = '';
		$weekday_list = \dash\datetime::weekday_list();

		$html .= "<div class='mB10'>";
		{
			$html .= '<label>'. T_("Weekday"). '</label>';
			$html .= '<div class="row">';
			{
				foreach ($weekday_list as $key => $weekday)
				{
				  $html .= '<div class="c">';
				  {
				 	$html .= '<div class="radio3">';
				    {
				      $html .= '<input type="radio" name="weekday" value="'.$weekday.'" id="weekday'.$weekday.'" '. (\dash\request::get('weekday') == $weekday ? 'checked' : null). '>';
				      $html .= '<label for="weekday'.$weekday.'">'. T_($weekday). '</label>';
				    }
				    $html .= '</div>';
				  }
				  $html .= '</div>';
				}
			}
			$html .= '</div>';
		}
		$html .= '</div>';

		return $html;
	}



	private static function html_factor_type($value)
	{
		self::set_input_loaded('type');
		$html = '';
		$factor_type = ['sale', 'buy'];

		$html .= "<div class='mB10'>";
		{
			$html .= '<label>'. T_("Type"). '</label>';
			$html .= '<div class="row">';
			{
				foreach ($factor_type as $key => $value)
				{
				  $html .= '<div class="c">';
				  {
				 	$html .= '<div class="radio3">';
				    {
				      $html .= '<input type="radio" name="type" value="'.$value.'" id="type'.$value.'" '. (\dash\request::get('type') == $value ? 'checked' : null). '>';
				      $html .= '<label for="type'.$value.'">'. T_($value). '</label>';
				    }
				    $html .= '</div>';
				  }
				  $html .= '</div>';
				}
			}
			$html .= '</div>';
		}
		$html .= '</div>';

		return $html;
	}


	/**
	 * Btn apply and cancel
	 *
	 * @param      <type>  $apply_filter_btn  The apply filter button
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	private static function html_apply_cancel_btn($apply_filter_btn)
	{
		$html = '';
		$html .= '<div class="row align-center mt-2">';
		{

			$html .= '<div class="c">';
			{
				$total_rows = \dash\utility\pagination::get_total_rows();
				$html .= '<div class="text-gray-400"><span class="font-bold">'. \dash\fit::number($total_rows). '</span> '. T_("Record founded"). '</div>';
			}
			$html .= '</div>';

			$html .= '<div class="c-auto">';
			{

				if(\dash\request::get())
				{
					if(\dash\data::listEngine_newActionByCurrentFilterURL() && \dash\data::listEngine_newActionByCurrentFilterTitle())
					{
						$html .= '<a class="btn-outline-success m-1" href="';
						$html .= \dash\data::listEngine_newActionByCurrentFilterURL();
						$html .= '"> '. \dash\data::listEngine_newActionByCurrentFilterTitle(). '</a>';
					}

					$html .= '<a class="btn-outline-secondary m-1" href="';
					if(\dash\data::listEngine_cleanFilterUrl())
					{
						$html .= \dash\data::listEngine_cleanFilterUrl();
					}
					else
					{
						$html .= \dash\url::that();
					}
					$html .= '"> '. T_("Clear filters"). '</a>';
				}
				if($apply_filter_btn)
				{
					$html .= '<button class="btn-outline-primary m-1">'. T_("Apply filter"). '</button>';
				}
			}
			$html .= '</div>';
		}
		$html .= '</div>';

		return $html;
	}
}
?>