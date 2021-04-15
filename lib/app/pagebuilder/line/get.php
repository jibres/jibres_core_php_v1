<?php
namespace lib\app\pagebuilder\line;


class get
{
	public static function load_element($_element, $_contain, $_id, $_args = [])
	{
		$id = \dash\validate::id($_id);

		if(!$id)
		{
			return false;
		}

		$result = self::check_element($_element, $_contain);

		if(!$result)
		{
			return false;
		}

		$load_data = \lib\db\pagebuilder\get::by_id($id);

		if(!isset($load_data['id']))
		{
			return false;
		}

		if(a($load_data, 'type') === $_element)
		{
			// ok
		}
		else
		{
			\dash\notif::error(T_("Invalid type"));
			return false;
		}

		$result = array_merge($result, $load_data);

		if($_contain)
		{
			$result['btnSave'] = 'form1';
		}

		$result = \lib\app\pagebuilder\line\tools::global_ready_show($_element, $result);

		return $result;
	}


	public static function check_element($_element, $_contain = null)
	{
		$element = \dash\validate::string_100($_element);
		if(!$element)
		{
			return false;
		}

		if(!preg_match("/^[a-z\_]+$/", $element))
		{
			return false;
		}


		$detail = \lib\app\pagebuilder\line\tools::call_fn($element, 'detail');

		if(!$detail)
		{
			return false;
		}

		$contain = null;
		if($_contain)
		{
			$contain = \dash\validate::string_100($_contain);
			if(!$contain)
			{
				return false;
			}

			if(!preg_match("/^[a-z\_]+$/", $contain))
			{
				return false;
			}
		}

		$result            = $detail;

		$the_contain = \lib\app\pagebuilder\line\tools::global_contain();

		$element_contain = \lib\app\pagebuilder\line\tools::call_fn_args($element, 'contain', $the_contain);

		if($element_contain)
		{
			$the_contain = $element_contain;
		}

		$result['contain'] = $the_contain;

		$design_map = \lib\app\pagebuilder\line\tools::call_fn($element, 'design_map');

		if($design_map)
		{
			$result['design_map'] = $design_map;
		}


		if($contain)
		{
			if(is_array($result['contain']) && in_array($contain, $result['contain']))
			{
				// no problem
			}
			else
			{
				// invalid contain
				return false;
			}
		}

		return $result;
	}


}
?>