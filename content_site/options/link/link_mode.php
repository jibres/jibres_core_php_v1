<?php
namespace content_site\options\link;


class link_mode
{

	public static function link_mode()
	{
		$list = [];
		// $list[] = ['key' => 'primary', ];
		// $list[] = ['key' => 'secondary', ];
		$list[] = ['key' => 'accent', ];
		$list[] = ['key' => 'info', ];
		$list[] = ['key' => 'success', ];
		$list[] = ['key' => 'warning', ];
		$list[] = ['key' => 'error', ];
		$list[] = ['key' => 'outline', ];
		$list[] = ['key' => 'active', ];
		return $list;
	}

	public static function validator($_data)
	{
		$new_data                       = [];

		$new_data['link_mode']  = \dash\validate::enum(a($_data, 'link_mode'), false, ['enum' => array_column(self::link_mode(), 'key')]);

		\content_site\utility::need_redirect(true);

		return $new_data;
	}





	public static function admin_html()
	{

		$link_mode = \content_site\section\view::get_current_index_detail('link_mode');

		$html = '';

		$html .= '<div class="mt-5 mb-5">';
		{
			$html .= "<label class='block mT10-f'>". T_("Link mode"). "</label>";
			$html .= '<div class="relative flex flex-none items-center">';
			{
				$list = self::link_mode();

				foreach ($list as $key => $value)
				{
					$selected = null;
					if($link_mode == $value['key'] || (!$link_mode && $value['key'] === 'outline'))
					{
						$selected = '<svg xmlns="http://www.w3.org/2000/svg" fill="whitesmoke" width="24" height="24" viewBox="0 0 24 24"><path d="M20.285 2l-11.285 11.567-5.286-5.011-3.714 3.716 9 8.728 15-15.285z"/></svg>';
					}

					$json = json_encode(['opt_link_mode' => 1, 'multioption' => 'multi', 'link_mode' => $value['key']]);

					$html .= "<div data-ajaxify data-data='$json' class='ml-1 jbtn jbtn-circle jbtn-$value[key]'>$selected</div>";

				}
			}
			$html .= '</div>';

		}
		$html .= '</div>';


		return $html;
	}

}
?>