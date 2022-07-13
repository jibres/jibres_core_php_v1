<?php
namespace content_site;


class utility
{
	private static $fill_by_default_data = false;
	private static $iframe_size          = 'desktop';
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
				return '<nav class="items long mt-4"><ul>';
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
			self::$ul_li_started = false;
			return '</ul></nav>';
		}
	}

	public static function wow_update_all_section()
	{
		// \dash\pdo::transaction();

		// \dash\temp::set('siteBuilderForceDisableRedirect', true);
		// \dash\temp::set('clesnse_not_end_with_error', true);
		// \dash\code::time_limit(0);

		// $list = \dash\data::previewSectionList();
		// foreach ($list as $key => $value)
		// {
		// 	$add_new_section =
		// 	[
		// 		'section'     => a($value, 'section'),
		// 		'opt_model'   => a($value, 'opt_model'),
		// 		'preview_key' => a($value, 'preview_key'),
		// 	];

		// 	\dash\request::overwrite_POST($add_new_section);

		// 	\content_site\section\model::post();

		// 	$sid = \dash\temp::get('siteBuilderNewSectionIDAdded');

		// 	$page_id    = \dash\coding::decode(\dash\request::get('id'));
		// 	$section_detail = \lib\db\sitebuilder\get::by_id_related_id($sid, $page_id);


		// 	$section_detail = \content_site\section\view::ready_section_list($section_detail);

		// 	\dash\temp::set('putJsonInFile', true);

		// 	$downloadjson = self::downloadjson($section_detail, false, true);



		// }

		// \dash\pdo::rollback();
	}


	public static function downloadjson($_section_detail = null, $_multiple = true, $_return = false)
	{
		if(!$_section_detail)
		{
			$section_detail = \dash\data::currentSectionDetail();
		}
		else
		{
			$section_detail = $_section_detail;
		}

		$load = \lib\db\sitebuilder\get::by_id(a($section_detail, 'id'));

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


			// prdouct
			'product_order',
			'product_tag',
		];

		$preview = a($load, 'preview');
		$preview = json_decode($preview, true);
		if(!is_array($preview))
		{
			$preview = [];
		}

		krsort($preview);


		if($_multiple)
		{
			$need_unset = [];

			$preview['_mode']        = a($section_detail, 'mode');
			$preview['_folder']      = a($section_detail, 'folder');
			$preview['_section']     = a($section_detail, 'section');
			$preview['_model']       = a($section_detail, 'model');
			$preview['_preview_key'] = a($section_detail, 'preview_key');
		}

		if(\dash\temp::get('maxArrayKeyLen'))
		{
			$max_len = \dash\temp::get('maxArrayKeyLen');
		}
		else
		{
			$max_len = 0;
			foreach ($preview as $key => $value)
			{
				if(mb_strlen($key) > $max_len)
				{
					$max_len = mb_strlen($key);
				}
			}
		}

		$folder      = a($section_detail, 'folder');
		$section_key = a($section_detail, 'section');
		$model       = a($section_detail, 'model');
		$preview_key = a($section_detail, 'preview_key');
		$file_path   = "content_site/$folder/$section_key/$model.php";
		$code = '';
		if(!$_multiple)
		{
			$code .= '<?php ';
			$code .= "\n";
			$code .= "/** \n";
			$code .= " * @author ".\dash\user::detail('email')." \n";
			$code .= " * @date ".date("Y-m-d H:i:s")." \n";
			$code .= " * \n";
			$code .= " * This is options of one preview function \n";
			$code .= " * Put this code on $file_path \n";
			$code .= " * @preview: $preview_key \n";
			$code .= " */ ";
			$code .= "\n\n\n";
		}

		if(\dash\temp::get('putJsonInFile'))
		{
			$code = '';
		}

		$code .= "\t\t\t[";
		$code .= "\n";

		// $code .= "\t\t\t\t// $folder / $section_key / $model / $preview_key \n";

		foreach ($preview as $key => $value)
		{
			if(in_array($key, $need_unset))
			{
				continue;
			}

			if(!is_array($value))
			{
				if(is_bool($value))
				{
					$myValue = $value ? 'true' : 'false';
				}
				elseif(is_numeric($value))
				{
					$myValue = "$value";
				}
				elseif(is_null($value))
				{
					$myValue = "null";
				}
				elseif($value === 'View all' || $value === 'نمایش همه')
				{
					$myValue = 'T_("View all")';
				}
				elseif($key === 'heading' && !$_multiple)
				{
					if($section_key === 'blog')
					{
						$myValue = 'T_("Latest Posts")';
					}
					elseif($section_key === 'product')
					{
						$myValue = 'T_("Products")';
					}
					else
					{
						$myValue = "null";
					}
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
		$code .= "\n";

		if(\dash\temp::get('putJsonInFile'))
		{
			$code_function = '';

			$code_function .= "\n\n";
			$code_function .= "\n\t/**";
			$code_function .= "\n\t * Auto Generate Function ";
			$code_function .= "\n\t * @date ". date("Y-m-d H:i:s");
			$code_function .= "\n\t * @author ". \dash\user::detail('email');
			$code_function .= "\n\t *";
			$code_function .= "\n\t * @path ". $file_path;
			$code_function .= "\n\t * $folder / $section_key / $model / $preview_key" ;
			$code_function .= "\n\t *";
			$code_function .= "\n\t*/\n";
			$code_function .= "\tpublic static function $preview_key()\n";
			$code_function .= "\t{\n";

			$code_function .= "\t\treturn\n";
			$code_function .= "\t\t[\n";
			$code_function .= "\t\t\t'version' => 1,\n";
			$code_function .= "\t\t\t'options' =>\n";
			$code_function .= $code;
			$code_function .= "\t\t];\n";
			$code_function .= "\t}\n";

			$code_function .= "\t// path ". $file_path;
			$code_function .= "\n\t// $folder / $section_key / $model / $preview_key" ;

			$read_file = file((root. $file_path));

			$before_function = [];
			$after_function  = [];
			$start_function = false;
			$end_function = false;
			foreach ($read_file as $line)
			{
				if(strpos($line, "public static function $preview_key(") !== false)
				{
					$start_function = true;
				}

				if($start_function && strpos($line, "}") !== false)
				{
					$end_function = true;
				}

				else
				{
					if(!$start_function)
					{
						$before_function[] = $line;
					}
					else
					{
						if($end_function)
						{
							$after_function[] = $line;
						}
					}
				}
			}

			$new_file_content = implode('', $before_function);
			$new_file_content .= $code_function;
			$new_file_content .= implode('', $after_function);
			// var_dump($new_file_content);exit;
			// if(\dash\url::isLocal())
			// {
			// 	file_put_contents(root. $file_path, $new_file_content);
			// }

			return;
		}

		if(!$_multiple)
		{
			$code .= "\n\n";
			$code .= '?>';
		}

		if($_multiple || $_return)
		{
			return $code;
		}

		\dash\code::jsonBoom($code);
	}


	public static function multiple_downloadjson($_list)
	{

		$list = $_list;

		if(is_array($list))
		{

			$max_len = 0;
			foreach ($list as $value)
			{
				if(is_array(a($value, 'preview')))
				{
					foreach ($value['preview'] as $key => $v)
					{
						if(mb_strlen($key) > $max_len)
						{
							$max_len = mb_strlen($key);
						}
					}
				}
			}

			\dash\temp::set('maxArrayKeyLen', $max_len);

			$result = '<?php '. PHP_EOL;

			foreach ($list as $key => $value)
			{
				$result .= \content_site\utility::downloadjson($value, true);
			}

			$result .= PHP_EOL. '?>';

			\dash\code::jsonBoom($result);
		}
	}


	public static function all_preview_export_json()
	{
		$list = \content_site\section\controller::all_section_name();




		$section_list = [];

		foreach ($list as $section)
		{
			$detail = \content_site\call_function::preview_list($section);

			$section_list[$section] = [];

			if(is_array($detail))
			{
				foreach ($detail as $value)
				{
					if(!isset($section_list[$section][$value['opt_model']]))
					{
						$section_list[$section][$value['opt_model']] = [];
					}

					$section_list[$section][$value['opt_model']][] = $value['preview_key'];
				}
			}
		}

		\dash\code::jsonBoom($section_list, true);
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



	/**
	 * CHeck is private by entery prise
	 *
	 * @param      <type>  $_enterprise  The enterprise
	 *
	 * @return     bool    True if the specified enterprise is private enterprise, False otherwise.
	 */
	public static function is_private_enterprise($_enterprise)
	{
		if(self::is_enterprise($_enterprise))
		{
			return false;
		}

		return true;

	}


	public static function is_enterprise($_enterprise)
	{
		return \lib\store::enterprise() === $_enterprise;
	}


	public static function set_iframe_on($_size = null)
	{
		$cookie_name = 'siteiframesize';
		if($_size)
		{
			\dash\utility\cookie::write($cookie_name, $_size, (60*60*24*7));
		}

		self::$iframe_size = \dash\utility\cookie::read($cookie_name);

		\dash\data::pageBuilderIframeSize(self::$iframe_size);

		return self::$iframe_size;
	}



}
?>