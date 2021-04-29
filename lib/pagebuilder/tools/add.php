<?php
namespace lib\pagebuilder\tools;


class add
{

	/**
	 * Loads a list.
	 * Checl allow to load list and if have permission load it
	 *
	 * @param      string  $_mode  The mode
	 * @param      array   $_list  The list
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	private static function load_list(string $_mode, array $_list)
	{
		$list = [];

		foreach ($_list as $key => $value)
		{
			if(\lib\pagebuilder\tools\tools::call_fn($_mode, $value, 'allow'))
			{
				$list[] = \lib\pagebuilder\tools\tools::call_fn($_mode, $value, 'detail');
			}
		}

		return $list;
	}


	/**
	 * Headers list
	 *
	 * @param      array   $_args  The arguments
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function header_list($_args = [])
	{
		$headers =
		[
			'rafiei',
			'h100',
			'h300',
		];

		return self::load_list('header', $headers);
	}


	/**
	 * Body items list
	 *
	 *
	 * @param      array   $_args  The arguments
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function body_list($_args = [])
	{
		$body =
		[
			'image',
			'news',
			'products',
			'text',
			'quote',
			'subscribe',
			'socialnetwork',
			'application',
		];

		return self::load_list('body', $body);
	}


	/**
	 * Footer list
	 *
	 * @param      array   $_args  The arguments
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function footer_list($_args = [])
	{
		$footer =
		[
			'rafiei',
			'f100',
			'f201',
			'f300',
		];

		return self::load_list('footer', $footer);
	}




	public static function header($_element)
	{
		$element = \lib\pagebuilder\tools\get::check_element('header', $_element);

		if(!$element)
		{
			\dash\notif::error(T_("Invalid detail!"));
			return false;
		}

		$args =
		[
			'line_title' => a($element, 'title'),
		];

		$check_header_exists = \lib\db\pagebuilder\get::header_footer_exists(self::current_post_id(), 'header');

		if(isset($check_header_exists['id']))
		{
			\dash\notif::warn(T_("This page header was choose before"));

			$url           = [];
			$result['url'] = \dash\url::this(). '/build/'. $check_header_exists['type']. \dash\request::full_get(['pid' => $check_header_exists['id']]);

			return $result;

		}
		else
		{
			return self::add('header', $element, $args);
		}

	}


	public static function footer($_element)
	{
		$element = \lib\pagebuilder\tools\get::check_element('footer', $_element);

		if(!$element)
		{
			\dash\notif::error(T_("Invalid detail!"));
			return false;
		}

		$args =
		[
			'line_title' => a($element, 'title'),
		];

		$check_footer_exists = \lib\db\pagebuilder\get::header_footer_exists(self::current_post_id() , 'footer');

		if(isset($check_footer_exists['id']))
		{
			\dash\notif::warn(T_("This page footer was choose before"));

			$url           = [];
			$result['url'] = \dash\url::this(). '/build/'. $check_footer_exists['type']. \dash\request::full_get(['pid' => $check_footer_exists['id']]);

			return $result;

			return $result;

		}
		else
		{
			return self::add('footer', $element, $args);
		}

	}



	public static function body($_element)
	{
		$element = \lib\pagebuilder\tools\get::check_element('body', $_element);

		if(!$element)
		{
			\dash\notif::error(T_("Invalid detail!"));
			return false;
		}

		return self::add('body', $element);
	}


	private static function current_post_id()
	{
		$id = \dash\request::get('id');
		$id = \dash\validate::code($id);
		$id = \dash\coding::decode($id);
		if(!$id)
		{
			return false;
		}

		return $id;
	}


	private static function add($_mode, $_element, $_args = [])
	{
		$id = self::current_post_id();

		if(!$id)
		{
			return false;
		}

		$element = $_element;

		$insert                     = [];
		$insert['mode']             = a($element, 'mode');
		$insert['type']             = a($element, 'key');

		$insert['platform']         = 'website';

		$insert['related']          = 'posts';
		$insert['related_id']       = $id;

		if(a($_args, 'line_title'))
		{
			$insert['title'] = $_args['line_title'];
		}
		else
		{
			$insert['title']            = self::get_suggested_name($element);
		}

		$insert['titlesetting']     = null;
		$insert['background']       = null;
		$insert['avand']            = null;
		$insert['margin']           = null;
		$insert['padding']          = null;
		$insert['radius']           = null;
		$insert['meta']             = null;
		$insert['sort']             = null;
		$insert['status']           = 'draft';
		$insert['ifloginshow']      = null;
		$insert['ifpermissionshow'] = null;

		$insert['puzzle']           = null;
		$insert['infoposition']     = null;
		$insert['detail']           = null;
		$insert['text']             = null;
		$insert['datecreated']      = date("Y-m-d H:i:s");
		$insert['datemodified']     = null;

		$get_last_sort_args =
		[
			'related'    => $insert['related'],
			'related_id' => $insert['related_id'],
			// need add some args later
		];

		$get_last_sort = \lib\db\pagebuilder\get::last_sort($get_last_sort_args);

		if(!$get_last_sort || !is_numeric($get_last_sort))
		{
			$insert['sort'] = 10;
		}
		else
		{
			$insert['sort'] = (floor(intval($get_last_sort) / 10) * 10) + 10;

		}

		$id = \lib\db\pagebuilder\insert::new_record($insert);

		if(!$id)
		{
			\dash\notif::error(T_("No way to save data"));
			return false;
		}

		$add_msg = T_("Data successfully added");

		if(!a($element, 'add_msg'))
		{
			$add_msg = a($element, 'add_msg');
		}

		\dash\notif::ok($add_msg);

		$result        = [];
		$result['id']  = $id;
		$result['url'] = \dash\url::this(). '/build/'. $insert['type']. \dash\request::full_get(['pid' => $id]);


		return $result;

	}



	private static function get_suggested_name($_element)
	{
		if(isset($_element['key']) && isset($_element['title']))
		{
			$suggested_name = $_element['title'];

			$count = \lib\db\pagebuilder\get::count_by_type($_element['key']);

			if(is_numeric($count))
			{
				$count = intval($count) + 1;
			}
			else
			{
				$count = 1;
			}
		}
		else
		{
			$suggested_name = T_("New line");
			$count          = \dash\fit::number(rand(1, 99));
		}

		return $suggested_name. ' '. \dash\fit::text($count);
	}

}
?>