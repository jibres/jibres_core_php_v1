<?php
namespace lib\pagebuilder\tools;


class get
{
	public static function load_current_element()
	{

		$id   = \dash\request::get('id');
		$pid   = \dash\request::get('pid');


		$dir_1 = self::validate_element_name(\dash\url::dir(2));
		$dir_2 = self::validate_element_name(\dash\url::dir(3));
		$dir_3 = self::validate_element_name(\dash\url::dir(4));
		$dir_4 = self::validate_element_name(\dash\url::dir(5));

		if($dir_4)
		{
			\dash\header::status(404);
		}

		$args             = [];
		$args['moduel']   = $dir_1;
		$args['child']    = $dir_2;
		$args['subchild'] = $dir_3;

		$result =  self::load_element($dir_1, $id, $pid, $args);

		return $result;
	}



	private static function validate_element_name($_name)
	{
		$_name = \dash\validate::string_100($_name, false);

		if($_name)
		{
			if(!preg_match("/^[a-z][a-z0-9\_]+$/", $_name))
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



	public static function load_element($_element, $_id, $_pid, $_args = [])
	{
		$id = \dash\validate::code($_id);
		$id = \dash\coding::decode($id);
		if(!$id)
		{
			return false;
		}

		$post_detail = \lib\pagebuilder\tools\current_post::load($id);

		if(!$post_detail)
		{
			return false;
		}

		$pid = \dash\validate::id($_pid);

		if(!$pid)
		{
			return false;
		}

		$load_data = \lib\db\pagebuilder\get::by_id($pid);

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

		$result = self::check_element($load_data['mode'], $_element);

		if(!$result)
		{
			return false;
		}

		$current_module_detail = [];
		$current_module_lock = null;


		if(isset($_args['child']) && $_args['child'])
		{
			if(isset($_args['subchild']) && $_args['subchild'])
			{
				if(isset($result['elements']['contain'][$_args['child']]['contain'][$_args['subchild']]))
				{
					$current_module_lock = 'subchild';
					$current_module_detail = $result['elements']['contain'][$_args['child']]['contain'][$_args['subchild']];
					// ok
				}
				else
				{
					return false;
				}
			}
			else
			{
				if(isset($result['elements']['contain'][$_args['child']]))
				{
					$current_module_lock = 'child';
					$current_module_detail = $result['elements']['contain'][$_args['child']];
					// ok
				}
				else
				{
					return false;
				}
			}
		}
		else
		{
			$current_module_lock = 'module';

			if(isset($result['elements']['detail']))
			{
				$current_module_detail = $result['elements'];
			}
		}

		if(!is_array($current_module_detail))
		{
			$current_module_detail = [];
		}

		$current_module_detail['current_module'] = a($_args, $current_module_lock);

		$result['current_module_detail'] = $current_module_detail;

		// save curret page detail
		\lib\pagebuilder\tools\tools::current_module($current_module_detail);

		$result['post_detail'] = $post_detail;

		$result = array_merge($result, $load_data);

		$result = \lib\pagebuilder\tools\tools::global_ready_show($load_data['mode'], $_element, $result);

		// if need load special router
		if(isset($current_module_detail['detail']['router']) && $current_module_detail['detail']['router'])
		{
			if(is_callable(\lib\pagebuilder\tools\tools::get_fn($load_data['mode'], $_element, 'router')))
			{
				$result = \lib\pagebuilder\tools\tools::call_fn_args($load_data['mode'], $_element, 'router', $result);
			}
		}

		return $result;
	}


	public static function check_element($_folder, $_element)
	{
		$element = self::validate_element_name($_element);
		if(!$element)
		{
			return false;
		}


		$detail = \lib\pagebuilder\tools\tools::call_fn($_folder, $element, 'detail');

		if(!$detail)
		{
			return false;
		}

		$result            = $detail;

		$elements = \lib\pagebuilder\tools\tools::call_fn($_folder, $element, 'elements');

		if(!$elements)
		{
			return false;
		}

		$result['elements'] = $elements;

		return $result;
	}


	public static function current_line_list()
	{

		$id = \dash\request::get('id');

		$id = \dash\validate::code($id);

		$id = \dash\coding::decode($id);

		if(!$id)
		{
			return false;
		}

		$post_detail = \lib\pagebuilder\tools\current_post::load($id);


		$list = \lib\db\pagebuilder\get::line_list($id);


		$result                = [];

		$result['post_detail'] = $post_detail;

		$result['list']        = $list;

		return $result;
	}

}
?>