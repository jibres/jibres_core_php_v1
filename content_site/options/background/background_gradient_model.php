<?php
namespace content_site\options\background;


trait background_gradient_model
{

	public static function extends_option()
	{
		return background_pack::extends_option();
	}


	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => ['pallet', 'custom'], 'field_title' => T_('Model')]);
		\content_site\utility::need_redirect(true);
		return $data;
	}


	public static function get_value()
	{
		return \content_site\section\view::get_current_index_detail('background_gradient_model');
	}


	public static function admin_html()
	{
		$html = '';
		$gradient_model = self::get_value();
		$html .= \content_site\options\generate::form();
		{
			$radio_html = '';
			$radio_html .= \content_site\options\generate::radio_line_itemText('opt_background_gradient_model', 'pallet', T_("Pallet"), (($gradient_model === 'pallet')? true : false), true);
			$radio_html .= \content_site\options\generate::radio_line_itemText('opt_background_gradient_model', 'custom', T_("Custom"), (($gradient_model !== 'pallet')? true : false), true);

			$html .= \content_site\options\generate::radio_line_add_ul('opt_background_gradient_model', $radio_html);
		}
		$html .= \content_site\options\generate::_form();

		return $html;
	}
}
?>