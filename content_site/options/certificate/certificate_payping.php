<?php
namespace content_site\options\certificate;


class certificate_payping
{
	public static function validator($_data)
	{
		$data = \dash\validate::checkbox(a($_data, 'cert_payping'));
		return $data;
	}


	public static function admin_html()
	{

		if(\dash\language::current() !== 'fa')
		{
			return '';
		}
		$payping = a(\lib\app\setting\get::bank_payment_setting(), 'payping');
		if(a($payping, 'status') && a($payping, 'token'))
		{
			// it's okay
		}
		else
		{
			return '';
		}

		$default = \content_site\section\view::get_current_index_detail(\content_site\utility::className(get_called_class()));

		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::multioption();
			$html .= \content_site\options\generate::opt_hidden(get_called_class());
			$html .= \content_site\options\generate::checkbox('cert_payping', T_('Show Payping certificate'), $default);

		}
  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>