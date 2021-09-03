<?php
namespace content_site\options\certificate;


class certificate_enamad
{
	public static function validator($_data)
	{
		$data = \dash\validate::checkbox(a($_data, 'enamad'));
		return $data;
	}


	public static function admin_html()
	{

		if(\dash\language::current() !== 'fa')
		{
			return '';
		}

		$default = \content_site\section\view::get_current_index_detail(\content_site\utility::className(__CLASS__));

		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::multioption();
			$html .= \content_site\options\generate::opt_hidden(__CLASS__);
			$html .= \content_site\options\generate::checkbox('enamad', T_('Enable enamad'), $default);


			$data_response_hide = null;

			if(!$default)
			{
				$data_response_hide = 'data-response-hide';
			}

			$html .= "<div data-response='enamad' $data_response_hide>";
			{
				$html .= '<a href="'. \lib\store::admin_url(). '/a/setting/thirdparty/enamad" target="_blank" class="jalert  p-3 block">';
				{
					$html .= '<span class="link-secondary text-xs leading-6 block">'.T_("Manage enamad certificate").' <i class="sf-external-link"></i></span>';
				}
				$html .= '</a>';
			}
			$html .= '</div>';

		}
  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>