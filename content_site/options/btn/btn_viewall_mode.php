<?php
namespace content_site\options\btn;


class btn_viewall_mode
{

	public static function btn_mode()
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
		\content_site\utility::need_redirect(true);
		return \dash\validate::enum($_data, false, ['enum' => array_column(self::btn_mode(), 'key')]);
	}



	public static function admin_html($_section_detail)
	{

		$checked  = \content_site\section\view::get_current_index_detail('btn_viewall_check');
		$btn_mode = \content_site\section\view::get_current_index_detail('btn_viewall_mode');

		$html = '';

		if($checked)
		{
			$html .= '<div class="mt-5 mb-5">';
			{
				$html .= "<label class='block mT10-f'>". T_("Button view all mode"). "</label>";
				$html .= '<div class="relative grid grid-cols-8 gap-1">';
				{
					$list = self::btn_mode();

					foreach ($list as $key => $value)
					{
						$selected = null;
						$checkColor = '#fff';
						if($value['key'] === 'light' )
						{
							$checkColor = '#333';
						}
						if($btn_mode == $value['key'] || (!$btn_mode && $value['key'] === 'outline'))
						{
							$selected = '<svg xmlns="http://www.w3.org/2000/svg" fill="'. $checkColor. '" width="24" height="24" viewBox="0 0 24 24" class="p-1.5 mx-auto"><path d="M20.285 2l-11.285 11.567-5.286-5.011-3.714 3.716 9 8.728 15-15.285z"/></svg>';
						}

						$json = json_encode(['opt_btn_viewall_mode' => $value['key']]);

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