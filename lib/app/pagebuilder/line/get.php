<?php
namespace lib\app\pagebuilder\line;


class get
{
	public static function load_current_element()
	{

		$id   = \dash\request::get('id');


		$dir_1 = self::validate_element_name(\dash\url::dir(1));
		$dir_2 = self::validate_element_name(\dash\url::dir(2));
		$dir_3 = self::validate_element_name(\dash\url::dir(3));
		$dir_4 = self::validate_element_name(\dash\url::dir(4));

		if($dir_4)
		{
			\dash\header::status(404);
		}

		$args             = [];
		$args['moduel']   = $dir_1;
		$args['child']    = $dir_2;
		$args['subchild'] = $dir_3;

		return self::load_element($dir_1, $id, $args);
	}



	private static function validate_element_name($_name)
	{
		$_name = \dash\validate::string_100($_name, false);

		if($_name)
		{
			if(!preg_match("/^[a-z\_]+$/", $_name))
			{
				return false;
			}
		}
		else
		{
			$_name = null;
		}

		return $_name;
	}



	public static function load_element($_element, $_id, $_args = [])
	{
		$id = \dash\validate::id($_id);

		if(!$id)
		{
			return false;
		}

		$result = self::check_element($_element);

		if(!$result)
		{
			return false;
		}

		if(isset($_args['child']) && $_args['child'])
		{
			if(isset($_args['subchild']) && $_args['subchild'])
			{
				if(isset($result['elements'][$_args['child']]['contain'][$_args['subchild']]))
				{
					// ok
				}
				else
				{
					return false;
				}
			}
			else
			{
				if(isset($result['elements'][$_args['child']]))
				{
					// ok
				}
				else
				{
					return false;
				}
			}
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

		$result = \lib\app\pagebuilder\line\tools::global_ready_show($_element, $result);

		return $result;
	}


	public static function check_element($_element)
	{
		$element = self::validate_element_name($_element);
		if(!$element)
		{
			return false;
		}


		$detail = \lib\app\pagebuilder\line\tools::call_fn($element, 'detail');

		if(!$detail)
		{
			return false;
		}

		$result            = $detail;

		$elements = \lib\app\pagebuilder\line\tools::call_fn($element, 'elements');

		if(!$elements)
		{
			return false;
		}

		$result['elements'] = $elements;

		return $result;
	}


}
?>