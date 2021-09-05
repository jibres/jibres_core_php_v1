<?php
namespace content_site\options\responsive;


class responsive_footer
{
	public static function validator($_data)
	{
		$new_data = [];
		$new_data['use_as_footer_link'] = \dash\validate::enum(a($_data, 'use_as_footer_link'), false, ['enum' => ['none', 'custom', 'default']]);

		return $new_data;
	}


	public static function extends_option()
	{
		return
		[
			'responsive_footer_link_add',
			'responsive_footer_links',
		];
	}



	public static function admin_html()
	{
		$use_as_footer_link = \content_site\section\view::get_current_index_detail('use_as_footer_link');

		$html = '';
		$html .= \content_site\options\generate::form();
		{

			$title = T_("Footer links");
			$html .= \content_site\options\generate::multioption();
			$html .= \content_site\options\generate::opt_hidden(__CLASS__);

			$name       = 'use_as_footer_link';


			$html .= '<div class="flex">';
			{
				$html .= '<div class="flex-1">';
				{
					$html .= "<label>$title</label>";
				}
				$html .= '</div>';

				$data_response_hide = null;

				if($use_as_footer_link === 'custom_logo')
				{
					$data_response_hide = 'data-response-hide';
				}

				// open data-response and close after heading input
				$html .= "<div data-response='$name' data-response-where='business_logo' $data_response_hide>";
				{
					// $html .= '<a target="_blank" class="link-secondary text-xs leading-6 block" href="'. \lib\store::admin_url(). '/a/setting/general">'. T_("Manage"). ' <i class="sf-external-link pLa5"></i> </a>';
				}
				$html .= '</div>';

			}
			$html .= '</div>';



			$radio_html = '';


			$radio_html .= \content_site\options\generate::radio_line_itemText($name, 'none', T_("None"), (($use_as_footer_link === 'none')? true : false));
			$radio_html .= \content_site\options\generate::radio_line_itemText($name, 'default', T_("Default"), (($use_as_footer_link === 'default')? true : false));
			$radio_html .= \content_site\options\generate::radio_line_itemText($name, 'custom', T_("Custom"), (($use_as_footer_link === 'custom')? true : false));


			$html .= \content_site\options\generate::radio_line_add_ul($name, $radio_html);

			$data_response_hide = null;

			if($use_as_footer_link !== 'custom')
			{
				$data_response_hide = 'data-response-hide';
			}

			$html .= "<div data-response='$name' data-response-where='custom' $data_response_hide>";
			{
				$html .= responsive_footer_links::admin_html();
				$html .= responsive_footer_link_add::admin_html();
			}

			$html .= '</div>';

		}
		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>