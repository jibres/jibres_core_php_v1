<?php
namespace content_site\options\video;


class video_option
{

	public static function name()
	{
		return 'option';
	}

	public static function title()
	{
		return T_("Option");
	}

	public static function gallery_mode()
	{
		return false;
	}

	public static function default()
	{
		return false;
	}


	public static function validator($_data)
	{
		$data = \dash\validate::checkbox(a($_data, static::name()));
		return $data;
	}


	public static function have_specialsave()
	{
		return false;
	}

	public static function specialsave($_data = [])
	{
		$data = \dash\validate::string_200(a($_data, static::name()));

		return \content_site\body\gallery\option::update_one_gallery_item([static::name() => $data]);
	}



	/**
	 * Use in other options
	 * @return [type] [description]
	 */
	public static function visible()
	{
		$data = \content_site\body\gallery\option::get_current_item();

		$my_file = a($data, 'preview', 'file');

		if($my_file)
		{
			$file_detail = \lib\filepath::get_detail($my_file);
			if(a($file_detail, 'type') === 'video')
			{
				return true;
			}
		}

		return false;
	}




	public static function admin_html()
	{
		if(static::gallery_mode() && !static::visible())
		{
			return '';
		}

		$default = \content_site\section\view::get_current_index_detail(static::name());

		if(!is_bool($default))
		{
			$default = static::default();
		}

		$html = '';
		$html .= \content_site\options\generate::form();
		{
			if(static::gallery_mode())
			{
				$html .= \content_site\options\generate::specialsave();
			}

			$html .= \content_site\options\generate::multioption();
			$html .= \content_site\options\generate::opt_hidden(get_called_class());
			$html .= \content_site\options\generate::checkbox(static::name(),  static::title(), $default);
		}

  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>