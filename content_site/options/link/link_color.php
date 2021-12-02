<?php
namespace content_site\options\link;


class link_color
{

	public static function link_color()
	{
		$list = [];
		$list[] = ['key' => 'primary', ];
		$list[] = ['key' => 'secondary', ];
		$list[] = ['key' => 'success', ];
		$list[] = ['key' => 'danger', ];
		$list[] = ['key' => 'warning', ];
		$list[] = ['key' => 'info', ];
		$list[] = ['key' => 'light', ];
		$list[] = ['key' => 'dark', ];
		return $list;
	}

	public static function validator($_data)
	{
		$new_data                       = [];

		$new_data[self::db_key()]  = \dash\validate::enum(a($_data, self::db_key()), false, ['enum' => array_column(self::link_color(), 'key')]);

		\content_site\utility::need_redirect(true);

		return $new_data;
	}


	public static function db_key()
	{
		return 'link_color';
	}


	public static function checked()
	{
		return true;
	}

	public static function title()
	{
		return T_("Link mode");
	}


	public static function admin_html()
	{

		$link_color = \content_site\section\view::get_current_index_detail(self::db_key());

		$html = '';

		if(self::checked())
		{

			$html .= '<div class="mt-5 mb-5">';
			{
				$html .= "<label class='block mT10-f'>". self::title(). "</label>";
				$html .= '<div class="relative grid grid-cols-8 gap-1">';
				{
					$list = self::link_color();

					foreach ($list as $key => $value)
					{
						$selected = null;
						$checkColor = '#fff';
						if($value['key'] === 'light' )
						{
							$checkColor = '#333';
						}

						if($link_color == $value['key'] || (!$link_color && $value['key'] === 'outline'))
						{
							$selected = '<svg xmlns="http://www.w3.org/2000/svg" fill="'. $checkColor. '" width="24" height="24" viewBox="0 0 24 24" class="p-1.5 mx-auto"><path d="M20.285 2l-11.285 11.567-5.286-5.011-3.714 3.716 9 8.728 15-15.285z"/></svg>';
						}

						$json = json_encode(['opt_'. \content_site\utility::className(get_called_class()) => 1, 'multioption' => 'multi', self::db_key() => $value['key']]);

						$html .= "<button data-ajaxify data-data='$json' class='btn-$value[key] btn-circle transition shadow hover:shadow-md'>$selected</button>";

					}
				}
				$html .= '</div>';

			}
			$html .= '</div>';

		}

		return $html;
	}

}
?>