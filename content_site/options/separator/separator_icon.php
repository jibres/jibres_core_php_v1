<?php
namespace content_site\options\separator;


class separator_icon
{
	private static function enum()
	{

		$enum   = [];
		$enum[] = ['key' => ''];

		if(\content_site\utility::is_enterprise('rafiei'))
		{
			$enum[] = ['key' => 'rafiei'];
		}

		$enum[] = ['key' => 'asterisk'];
		$enum[] = ['key' => 'activity'];
		$enum[] = ['key' => 'dash-lg'];
		$enum[] = ['key' => 'dot'];
		$enum[] = ['key' => 'hash'];



		return $enum;
	}

	public static function rafiei_svg()
	{
		return  '<svg version="1.0" xmlns="http://www.w3.org/2000/svg" class="mx-auto" height="20" viewBox="0 0 300 142" fill="currentColor"><path d="M66.2 24.3C57.3 33.2 50 41 50 41.5s7.3 8.3 16.2 17.2L82.5 75l16.7-16.7L116 41.5l16.8 16.8L149.5 75l16.8-16.7L183 41.5l16.8 16.8L216.5 75l16.8-16.7L250 41.5l-16.7-16.7L216.5 8l-16.7 16.7L183 41.5l-16.7-16.8L149.5 8l-16.7 16.7L116 41.5 99.2 24.7 82.5 8 66.2 24.3z"/><path d="M32.7 83.8L16 100.5l16.8 16.8L49.5 134l16.8-16.7L83 100.5l16.8 16.8 16.7 16.7 16.8-16.7 16.7-16.8 16.8 16.8 16.7 16.7 16.8-16.7 16.7-16.8 16.8 16.8 16.7 16.7 16.3-16.3c8.9-8.9 16.2-16.7 16.2-17.2s-7.3-8.3-16.2-17.2L250.5 67l-16.7 16.7-16.8 16.8-16.7-16.8L183.5 67l-16.7 16.7-16.8 16.8-16.8-16.8L116.5 67 99.7 83.7 83 100.5 66.2 83.7 49.5 67 32.7 83.8z"/></svg>';
	}


	public static function validator($_data)
	{
		$data = \dash\validate::enum(a($_data, 'separator_icon'), true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Icon')]);
		return $data;
	}


	public static function default()
	{
		return 'solid';
	}


	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('separator_icon');

		if(!$default)
		{
			$default = self::default();
		}


		$title = T_("Icon");

		$html = '';

		$html .= '<div class="mt-5 mb-5">';
		{
			$html .= "<label class='block mT10-f'>". $title. "</label>";
			$html .= '<div class="relative grid grid-cols-8 gap-1">';
			{
				$list = self::enum();

				foreach ($list as $key => $value)
				{
					$selected = null;

					if($default == $value['key'])
					{
						$selected = 'bg-red-500';
					}

					$json = json_encode(['opt_'. \content_site\utility::className(__CLASS__) => 1, 'multioption' => 'multi', 'separator_icon' => $value['key']]);

					if($value['key'] === 'rafiei')
					{
						$svg = self::rafiei_svg();
					}
					else
					{
						$svg = \dash\utility\icon::bootstrap($value['key']);
					}

					$html .= "<button data-ajaxify data-data='$json' class='btn-circle transition shadow hover:shadow-md $selected'>". $svg."</button>";

				}
			}
			$html .= '</div>';

		}
		$html .= '</div>';

		return $html;
	}

}
?>