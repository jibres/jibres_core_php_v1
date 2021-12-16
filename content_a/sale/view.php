<?php
namespace content_a\sale;


class view
{
	public static function config()
	{
		// show dropdown of product list
		\lib\app\product\site_list::dropdown();

		\dash\face::title(T_('Sale invoicing'));

		\dash\data::back_text(T_('Factors'));
		\dash\data::back_link(\dash\url::here(). '/order?type=sale');

		\lib\app\fund\login::check();

		\lib\app\pos\tools::pc_pos_btn();


		\dash\face::btnSave('factorAdd');
		\dash\face::btnSaveName('save_btn');
		\dash\face::btnSaveValue('save_next');
		\dash\face::btnSaveText(T_("Save Factor & Continue"));

		\dash\data::include_m2('wide');

		\dash\data::showVatColum(\lib\store::detail('show_vat_column'));
		\dash\data::vatDecimal(\lib\vat::decimal());
	}
}
?>
