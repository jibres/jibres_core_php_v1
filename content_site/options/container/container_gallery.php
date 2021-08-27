<?php
namespace content_site\options\container;


trait container_gallery
{

	private static function enum()
	{
		$enum   = [];


		$enum[] = ['key' => 'sm', 	 'title' => "S",    'hide' => self::hide_sm(), 'class' => 'max-w-screen-sm w-full px-2 sm:px-4 lg:px-5' ];
		$enum[] = ['key' => 'md', 	 'title' => "M",    'hide' => self::hide_md(), 'class' => 'max-w-screen-md w-full px-2 sm:px-4 lg:px-5'];
		$enum[] = ['key' => 'lg', 	 'title' => "L",    'hide' => false, 'class' => 'max-w-screen-lg w-full px-2 sm:px-4 lg:px-5'];
		$enum[] = ['key' => 'xl', 	 'title' => "XL",   'hide' => false, 'class' => 'max-w-screen-xl w-full px-2 sm:px-4 lg:px-5'];
		$enum[] = ['key' => '2xl', 	 'title' => "2XL",  'hide' => false, 'class' => 'max-w-screen-2xl w-full px-2 sm:px-4 lg:px-5'];
		$enum[] = ['key' => 'fluid', 	 'title' => "100%", 'hide' => false, 'class' => 'w-full'];

		return $enum;
	}


	public static function hide_sm()
	{
		return true;
	}


	public static function hide_md()
	{
		return true;
	}


	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Height')]);


		return $data;

	}


	public static function default()
	{
		return 'lg';
	}


	public static function class_name($_key)
	{
		$enum = self::enum();

		foreach ($enum as $key => $value)
		{
			if(!$_key)
			{
				if($value['key'] === self::default())
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
		return 'container';
	}


	public static function admin_html()
	{

		$default = \content_site\section\view::get_current_index_detail('container');

		if(!$default)
		{
			$default = self::default();
		}


		$title = T_("Container");

		$this_range = array_column(self::enum(), 'key');



		$html = '';
		$html .= '<form method="post" data-patch>';
		{
			$html .= "<label>$title</label>";

			$name       = 'opt_'. \content_site\utility::className(__CLASS__);

			$radio_html = '';
			foreach (self::enum() as $key => $value)
			{
				if(isset($value['hide']) && $value['hide'])
				{
					continue;
				}

				$selected = false;

				if($default === $value['key'])
				{
					$selected = true;
				}

				$radio_html .= \content_site\options\generate::radio_line_itemText($name, $value['key'], $value['title'], $selected);
			}

			$html .= \content_site\options\generate::radio_line_add_ul($name, $radio_html);
		}
		$html .= '</form>';



		return $html;
	}

}
?>