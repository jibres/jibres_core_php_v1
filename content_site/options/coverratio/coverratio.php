<?php
namespace content_site\options\coverratio;


class coverratio
{

	public static function enum()
	{
		$enum   = [];

		if(static::have_free_ratio())
		{
			// free
			$enum[] = ['key' => 'free',  'title' => 'Free' ,		'class' => ''];
		}

		$enum[] = ['key' => '1:1', 		'title' => '1:1', 		'class' => 'aspect-square'];
		$enum[] = ['key' => '4:3', 		'title' => '4:3', 		'class' => 'aspect-[4/3]'];
		$enum[] = ['key' => '16:9', 	'title' => '16:9', 		'class' => 'aspect-video'];
		$enum[] = ['key' => '32:9', 	'title' => '32:9', 		'class' => 'aspect-[32/9]'];
		$enum[] = ['key' => '64:9', 	'title' => '64:9', 		'class' => 'aspect-[64/9]'];

		// less common
		$enum[] = ['key' => '3:1', 		'title' => '3:1', 		'class' => 'aspect-[3/1]'];
		$enum[] = ['key' => '4:1', 		'title' => '4:1', 		'class' => 'aspect-[4/1]'];
		$enum[] = ['key' => '5:3', 		'title' => '5:3', 		'class' => 'aspect-[5/3]'];
		$enum[] = ['key' => '16:10', 	'title' => '16:10', 	'class' => 'aspect-[16/10]'];
		$enum[] = ['key' => '19:10', 	'title' => '19:10', 	'class' => 'aspect-[19/10]'];
		$enum[] = ['key' => '64:27', 	'title' => '64:27', 	'class' => 'aspect-[64/27]'];


		// vertical
		$enum[] = ['key' => '9:16', 	'title' => '9:16',	  'class' => 'aspect-[9/16]'];
		$enum[] = ['key' => '2:3', 		'title' => '2:3', 		'class' => 'aspect-[2/3]'];
		$enum[] = ['key' => '3:4', 		'title' => '3:4', 		'class' => 'aspect-[3/4]'];
		$enum[] = ['key' => '4:5', 		'title' => '4:5', 		'class' => 'aspect-[4/5]'];


		return $enum;
	}

	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(static::enum(), 'key'), 'field_title' => T_('Cover ratio')]);
		return $data;
	}


	public static function have_free_ratio()
	{
		return true;
	}

	public static function default()
	{
		return '16:9';
	}


	public static function get_class($_key)
	{
		$enum = static::enum();

		foreach ($enum as $key => $value)
		{
			if(!$_key)
			{
				if($value['key'] === static::default())
				{
					return $value['class'];
				}
			}
			else
			{
				if($value['key'] === $_key)
				{
					return $value['class'];
				}
			}
		}
	}


	public static function db_key()
	{
		return 'coverratio';
	}




	public static function admin_html()
	{

		$html = '';
		$default = \content_site\section\view::get_current_index_detail(static::db_key());

		if(!$default)
		{
			$default = static::default();
		}

		$title = T_("Featured image ratio");

		$name       = 'opt_'. \content_site\utility::className(get_called_class());

		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::select(get_called_class(), static::enum(), $default, $title);
		}
		$html .= \content_site\options\generate::_form();

		return $html;

	}



}
?>