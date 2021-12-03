<?php
namespace content_site\options\background;


class background_position
{

	public static function enum()
	{
		$enum   = [];

		$enum[] = ['key' => 'bottom', 			'title' => T_('Bottom'),];
		$enum[] = ['key' => 'center', 			'title' => T_('Center'),];
		$enum[] = ['key' => 'left', 			'title' => T_('Left'),];
		$enum[] = ['key' => 'left bottom', 		'title' => T_('Left Bottom'),];
		$enum[] = ['key' => 'left top', 		'title' => T_('Left Top'),];
		$enum[] = ['key' => 'right', 			'title' => T_('Right'),];
		$enum[] = ['key' => 'right bottom', 	'title' => T_('Right Bottom'),];
		$enum[] = ['key' => 'right top', 		'title' => T_('Right Top'),];
		$enum[] = ['key' => 'top', 				'title' => T_('Top'),];

		return $enum;
	}

	public static function extends_option()
	{
		return background_pack::extends_option();
	}


	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(static::enum(), 'key'), 'field_title' => T_('Background Position')]);
		return $data;
	}


	public static function default()
	{
		return 'center';
	}


	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('background_position');

		if(!$default)
		{
			$default = static::default();
		}


		$title = T_("Background Position");

		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::select(get_called_class(), static::enum(), $default, $title);
		}
  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>