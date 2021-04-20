<?php
namespace lib\pagebuilder\tools;


class add
{
	public static function header_list($_args = [])
	{
		$list = [];

		$list[] = \lib\pagebuilder\header\h100\h100::detail();
		$list[] = \lib\pagebuilder\header\h300\h300::detail();


		return $list;
	}


	public static function body_list($_args = [])
	{
		$list = [];

		$list[] = \lib\pagebuilder\body\image\image::detail();
		$list[] = \lib\pagebuilder\body\news\news::detail();
		$list[] = \lib\pagebuilder\body\products\products::detail();
		$list[] = \lib\pagebuilder\body\text\text::detail();
		$list[] = \lib\pagebuilder\body\quote\quote::detail();
		$list[] = \lib\pagebuilder\body\subscribe\subscribe::detail();
		$list[] = \lib\pagebuilder\body\socialnetwork\socialnetwork::detail();
		$list[] = \lib\pagebuilder\body\application\application::detail();

		return $list;
	}


	public static function footer_list($_args = [])
	{
		$list = [];
		$list[] = \lib\pagebuilder\footer\f100\f100::detail();
		$list[] = \lib\pagebuilder\footer\f201\f201::detail();
		$list[] = \lib\pagebuilder\footer\f300\f300::detail();

		return $list;
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

		$check_header_exists = \lib\db\pagebuilder\get::header_footer_exists('homepage', 'header');

		if(isset($check_header_exists['id']))
		{
			$load_element = \lib\pagebuilder\tools\get::load_element($check_header_exists['type'], $check_header_exists['id']);
			$args =
			[
				'key'   => $element['key'],
			];

			$result = \lib\pagebuilder\tools\edit::edit($load_element, $args);

			if(isset($result['url']))
			{
				$result['url'] = \dash\url::this(). '/'. $element['key']. \dash\request::full_get(['id' => $check_header_exists['id']]);
			}

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

		$check_footer_exists = \lib\db\pagebuilder\get::header_footer_exists('homepage', 'footer');

		if(isset($check_footer_exists['id']))
		{
			$load_element = \lib\pagebuilder\tools\get::load_element($check_footer_exists['type'], $check_footer_exists['id']);
			$args =
			[
				'key'   => $element['key'],
			];

			$result = \lib\pagebuilder\tools\edit::edit($load_element, $args);

			if(isset($result['url']))
			{
				$result['url'] = \dash\url::this(). '/'. $element['key']. \dash\request::full_get(['id' => $check_footer_exists['id']]);
			}

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


	private static function add($_mode, $_element, $_args = [])
	{
		$element = $_element;

		$insert                     = [];
		$insert['mode']             = a($element, 'mode');
		$insert['type']             = a($element, 'key');

		$insert['platform']         = 'website';

		$insert['related']          = 'homepage';
		$insert['related_id']       = null;

		if(a($_args['line_title']))
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
			'related' => $insert['related'],
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
		$result['url'] = \dash\url::this(). '/'. $insert['type']. '?id='. $id;


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