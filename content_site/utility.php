<?php
namespace content_site;


class utility
{
	private static $fill_by_default_data = false;
	private static $need_redirect        = null;


	public static function fill_by_default_data($_set = null)
	{
		if($_set === false || $_set === true)
		{
			self::$fill_by_default_data = $_set;
		}
		else
		{
			return self::$fill_by_default_data;
		}
	}


	/**
	 * Redirect to back url
	 */
	public static function need_redirect_to_back()
	{
		\dash\redirect::to(\content_site\section\view::generate_back_url());
	}


	public static function need_redirect($_set = null)
	{
		if($_set === false || $_set === true)
		{
			self::$need_redirect = $_set;
		}
		else
		{
			return self::$need_redirect;
		}
	}


	public static function unset_option(&$_option_list, $_need_unset)
	{
		if(($myKey = array_search($_need_unset, $_option_list)) !== false)
		{
			unset($_option_list[$myKey]);
		}
	}

	private static $ul_li_started = false;
	private static $ul_li_closed = false;
	public static function ul_li_started($_set = null)
	{
		if($_set === true)
		{
			if(self::$ul_li_started === false)
			{
				self::$ul_li_started = $_set;
				return '<nav class="items long mT20"><ul>';
			}
		}
		else
		{
			return self::$ul_li_started;
		}
	}

	public static function ul_li_close()
	{
		if(self::$ul_li_started && !self::$ul_li_closed)
		{
			self::$ul_li_closed = true;
			return '</ul></nav>';
		}
	}


	public static function downloadjson()
	{
		$section_detail = \dash\data::currentSectionDetail();

		$load = \lib\db\pagebuilder\get::by_id(a($section_detail, 'id'));

		$need_unset =
		[
			'folder',
			'section',
			'model',
			'preview_key',
			'model',

			// post
			'post_order',
			'post_tag',
			'post_template',
		];

		$preview = a($load, 'preview');
		$preview = json_decode($preview, true);
		if(!is_array($preview))
		{
			$preview = [];
		}

		krsort($preview);

		$max_len = 0;
		foreach ($preview as $key => $value)
		{
			if(mb_strlen($key) > $max_len)
			{
				$max_len = mb_strlen($key);
			}
		}

		$folder      = a($section_detail, 'folder');
		$section_key = a($section_detail, 'section');
		$model       = a($section_detail, 'model');

		$code = '';
		$code .= '<?php ';
		$code .= "\n";
		$code .= "/** \n";
		$code .= " * This is options of one preview function \n";
		$code .= " * Put this code on content_site/$folder/$section_key/$type.php \n";
		$code .= " */ ";
		$code .= "\n\n\n";
		$code .= "\t\t\t[";
		$code .= "\n";

		foreach ($preview as $key => $value)
		{
			if(in_array($key, $need_unset))
			{
				continue;
			}

			if(!is_array($value))
			{
				if(is_numeric($value) || $value === '1')
				{
					$myValue = "$value";
				}
				elseif(is_null($value))
				{
					$myValue = "null";
				}
				elseif($value === 'View all')
				{
					$myValue = 'T_("View all")';
				}
				elseif($key === 'heading')
				{
					$myValue = '$_title';
				}
				else
				{
					$myValue = "'$value'";
				}

				$space = str_repeat(' ', $max_len - mb_strlen($key));

				$code .= "\t\t\t\t'$key'$space => $myValue, \n";
			}
		}
		$code .= "\t\t\t],";
		$code .= "\n\n\n";
		$code .= '?>';

		\dash\code::jsonBoom($code);
	}


	/**
	 * Everywhere need backgroun pack option use this function
	 *
	 * @return     array  The pack option list.
	 */
	public static function set_style_option($_model = null)
	{
		$list = [];

		if(is_array($_model))
		{
			$list = $_model;
		}
		else
		{

			switch ($_model)
			{
				default:
					$list =
					[
						'background_pack',


						'height',
						'coverratio',

						// skip draw this option in html
						'background_color',

						'background_position',
						'background_repeat',
						'background_size',
						'background_attachment',

						'background_image',

						'background_gradient',
						'background_gradient_type',

						'background_gradient_from',
						'background_gradient_via',
						'background_gradient_to',

						'background_gradient_attachment',
						'background_color_random',

						'color_text',

						'font',

						'type',
					];
					break;
			}

		}

		// set current option list
		\content_site\options\background\background_pack::current_background_pack_option($list);

		return $list;
	}



	/**
	 * Get class name
	 *
	 * @param      <type>  $_class  The class
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function className($_class)
	{
		$explode = explode('\\', $_class);
		return end($explode);
	}


}
?>