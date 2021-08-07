<?php
namespace content_site\options;


class coverratio
{

	private static function enum()
	{
		$enum   = [];

		$enum[] = ['key' => '3:1', 'title' => '3:1', 'class' => 'aspect-w-3 aspect-h-1'];
		$enum[] = ['key' => '16:9', 'title' => '16:9', 'class' => 'aspect-w-16 aspect-h-9'];
		$enum[] = ['key' => '1:1', 'title' => '1:1', 'class' => 'aspect-w-1 aspect-h-1'];

		// vertical
		$enum[] = ['key' => '3:4', 'title' => '3:4', 'class' => 'aspect-w-3 aspect-h-4'];

		// free
		$enum[] = ['key' => 'free',  'title' => 'Free' ,'class' => ''];

		return $enum;
	}

	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Cover ratio')]);
		return $data;
	}


	public static function default()
	{
		return '16:9';
	}


	public static function get_class($_key)
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



	public static function admin_html()
	{

		$default = \content_site\section\view::get_current_index_detail('coverratio');

		if(!$default)
		{
			$default = self::default();
		}


		$title = T_("Featured image ratio");

		$this_range = array_column(self::enum(), 'key');



		$html = '';
		$html .= '<form method="post" data-patch>';
		{
			$html .= "<label>$title</label>";

			$name       = 'opt_coverratio';

			$radio_html = '';

			foreach (self::enum() as $key => $value)
			{
				$selected = false;

				if($default === $value['key'])
				{
					$selected = true;
				}

				$radio_html .= \content_site\options\generate_radio_line::itemText($name, $value['key'], $value['title'], $selected);
			}
			$html .= \content_site\options\generate_radio_line::add_ul($name, $radio_html);
		}
		$html .= '</form>';

		return $html;
	}



}
?>