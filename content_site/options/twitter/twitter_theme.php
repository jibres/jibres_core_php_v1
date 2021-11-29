<?php
namespace content_site\options\twitter;


trait twitter_theme
{

	public static function enum()
	{

		$list = [];
		$list[] = ['key' => '1', 'style' => 'linear-gradient(310deg,rgb(214,233,255),rgb(214,229,255),rgb(209,214,255),rgb(221,209,255),rgb(243,209,255),rgb(255,204,245),rgb(255,204,223),rgb(255,200,199),rgb(255,216,199),rgb(255,221,199))',];
		$list[] = ['key' => '2', 'style' => 'linear-gradient(160deg,rgb(204,251,252),rgb(197,234,254),rgb(189,211,255))',];
		$list[] = ['key' => '3', 'style' => 'linear-gradient(150deg,rgb(255,242,158),rgb(255,239,153),rgb(255,231,140),rgb(255,217,121),rgb(255,197,98),rgb(255,171,75),rgb(255,143,52),rgb(255,115,33),rgb(255,95,20),rgb(255,87,15))',];
		$list[] = ['key' => '4', 'style' => 'linear-gradient(345deg,rgb(211,89,255),rgb(228,99,255),rgb(255,123,247),rgb(255,154,218),rgb(255,185,208),rgb(255,209,214),rgb(255,219,219))',];
		$list[] = ['key' => '5', 'style' => 'linear-gradient(150deg,rgb(0,224,245),rgb(31,158,255),rgb(51,85,255))',];
		$list[] = ['key' => '6', 'style' => 'linear-gradient(330deg,rgb(255,25,125),rgb(45,13,255),rgb(0,255,179))',];
		$list[] = ['key' => '7', 'style' => 'linear-gradient(150deg,rgb(0,176,158),rgb(19,77,93),rgb(16,23,31))',];
		$list[] = ['key' => '8', 'style' => 'linear-gradient(150deg,rgb(95,108,138),rgb(48,59,94),rgb(14,18,38))',];

		return $list;
	}

	public static function validator($_data)
	{
		$new_data                       = [];

		$new_data[self::db_key()]  = \dash\validate::enum(a($_data, self::db_key()), false, ['enum' => array_column(self::enum(), 'key')]);

		\content_site\utility::need_redirect(true);

		return $new_data;
	}

	public static function get_style($_key)
	{
		$enum = self::enum();

		foreach ($enum as $key => $value)
		{
			if($value['key'] === $_key)
			{
				return $value['style'];
			}
		}

	}


	public static function db_key()
	{
		return 'twitter_theme';
	}


	public static function title()
	{
		return T_("Theme");
	}


	public static function admin_html()
	{

		$twitter_theme = \content_site\section\view::get_current_index_detail(self::db_key());

		$html = '';



		$html .= '<div class="mt-5 mb-5">';
		{
			$html .= "<label class='block mT10-f'>". self::title(). "</label>";
			$html .= '<div class="relative grid grid-cols-8 gap-1">';
			{
				$list = self::enum();

				foreach ($list as $key => $value)
				{
					$selected = null;
					$checkColor = '#fff';
					if($value['key'] === 'light' )
					{
						$checkColor = '#333';
					}

					if($twitter_theme == $value['key'])
					{
						$selected = '<svg xmlns="http://www.w3.org/2000/svg" fill="'. $checkColor. '" width="24" height="24" viewBox="0 0 24 24" class="p-1.5 mx-auto"><path d="M20.285 2l-11.285 11.567-5.286-5.011-3.714 3.716 9 8.728 15-15.285z"/></svg>';
					}

					$json = json_encode(['opt_'. \content_site\utility::className(__CLASS__) => 1, 'multioption' => 'multi', self::db_key() => $value['key']]);

					$html .= "<button data-ajaxify data-data='$json' class='btn btn-circle transition shadow hover:shadow-md' style='background: $value[style]'>$selected</button>";

				}
			}
			$html .= '</div>';

		}
		$html .= '</div>';



		return $html;
	}

}
?>