<?php
namespace content_site\options\btn;


class btn_viewall
{

	public static function btn_mode()
	{
		$list = [];
		$list[] = ['key' => '', ];
		$list[] = ['key' => 'primary', ];
		$list[] = ['key' => 'secondary', ];
		$list[] = ['key' => 'info', ];
		$list[] = ['key' => 'success', ];
		$list[] = ['key' => 'warning', ];
		$list[] = ['key' => 'error', ];

		return $list;
	}

	public static function validator($_data)
	{
		$new_data                       = [];

		$new_data['btn_viewall_check'] = \dash\validate::bit(a($_data, 'btn_viewall_check'));
		$new_data['btn_viewall']       = \dash\validate::string_100(a($_data, 'btn_viewall'));
		$new_data['btn_viewall_mode']  = \dash\validate::enum(a($_data, 'btn_viewall_mode'), false, ['enum' => array_column(self::btn_mode(), 'key')]);

		if($new_data['btn_viewall_mode'])
		{
			\content_site\utility::need_redirect(true);

			unset($new_data['btn_viewall_check']);
			unset($new_data['btn_viewall']);
		}
		else
		{
			unset($new_data['btn_viewall_mode']);

		}

		return $new_data;
	}


	public static function default()
	{
		return T_("View all");
	}


	public static function admin_html($_section_detail)
	{
		$checked            = null;
		$data_response_hide = ' data-response-hide';

		if(isset($_section_detail['preview']['btn_viewall_check']) && $_section_detail['preview']['btn_viewall_check'])
		{
			$checked            = ' checked';
			$data_response_hide = null;
		}

		if(isset($_section_detail['preview']['btn_viewall']) && $_section_detail['preview']['btn_viewall'])
		{
			$default            = $_section_detail['preview']['btn_viewall'];
		}
		else
		{
			$default = self::default();
		}

		$btn_mode = null;
		if(isset($_section_detail['preview']['btn_viewall_mode']) && $_section_detail['preview']['btn_viewall_mode'])
		{
			$btn_mode = $_section_detail['preview']['btn_viewall_mode'];
		}

		$html = '';
		$html .= '<form method="post" data-patch autocomplete="off">';
		{
	    	$html .= '<input type="hidden" name="multioption" value="multi">';
	    	$html .= '<input type="hidden" name="not_redirect" value="1">';

			$html .= '<div class="check1 py-0">';
			{
				$html .= '<input type="checkbox" name="opt_btn_viewall_check" id="btn_viewall_check"'.$checked.'>';
				$html .= '<label for="btn_viewall_check">'. T_('Show <b>View all</b> button'). '</label>';
			}
			$html .= '</div>';

			$html .= '<div class="mt-5" data-response="opt_btn_viewall_check" data-response-effect="slide"'.$data_response_hide.'>';
			{
				$html .= '<div class="input">';
				{
					$html .= '<input type="text" name="opt_btn_viewall" placeholder="'.self::default().'" value="'.$default.'">';
				}
				$html .= '</div>';

			}
			$html .= '</div>';
		}

  		$html .= '</form>';

		return $html;
	}


	public static function admin_html_viewall_mode()
	{
		$checked  = \content_site\section\view::get_current_index_detail('btn_viewall_check');
		$btn_mode = \content_site\section\view::get_current_index_detail('btn_viewall_mode');

		$html = '';

		if($checked)
		{
			$html .= '<div class="mt-5 mb-5">';
			{
				$html .= "<label class='block mT10-f'>". T_("Button view all mode"). "</label>";
				$html .= '<div class="relative flex flex-none items-center">';
				{
					$list = self::btn_mode();

					foreach ($list as $key => $value)
					{
						$selected = null;
						if($btn_mode == $value['key'] || (!$btn_mode && $value['key'] === 'outline'))
						{
							$selected = '<svg xmlns="http://www.w3.org/2000/svg" fill="whitesmoke" width="24" height="24" viewBox="0 0 24 24" class="p-2"><path d="M20.285 2l-11.285 11.567-5.286-5.011-3.714 3.716 9 8.728 15-15.285z"/></svg>';
						}

						$json = json_encode(['opt_btn_viewall' => 1, 'multioption' => 'multi', 'btn_viewall_mode' => $value['key']]);

						$html .= "<div data-ajaxify data-data='$json' class='ml-1 jbtn jbtn-circle jbtn-$value[key]'>$selected</div>";

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