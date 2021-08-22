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


	public static function downloadjson()
	{
		$section_detail = \dash\data::currentSectionDetail();

		$load = \lib\db\pagebuilder\get::by_id(a($section_detail, 'id'));

		$need_unset =
		[
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

		$folder      = a($section_detail, 'mode');
		$section_key = a($preview, 'key');
		$type        = a($preview, 'type');

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



}
?>