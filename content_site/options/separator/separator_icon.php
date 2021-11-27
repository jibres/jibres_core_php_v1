<?php
namespace content_site\options\separator;


class separator_icon
{
	private static function enum()
	{

		$enum   = [];
		$enum[] = ['key' => ''];
		$enum[] = ['key' => 'asterisk'];
		$enum[] = ['key' => 'activity'];
		$enum[] = ['key' => 'dash-lg'];
		$enum[] = ['key' => 'dot'];
		$enum[] = ['key' => 'hash'];



		return $enum;
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

					$html .= "<button data-ajaxify data-data='$json' class='btn-circle transition shadow hover:shadow-md $selected'>". \dash\utility\icon::bootstrap($value['key'])."</button>";

				}
			}
			$html .= '</div>';

		}
		$html .= '</div>';

		return $html;
	}

}
?>