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
		\dash\data::back_link(\dash\url::here(). '/order?type='. \dash\data::moduleType());


		\dash\face::btnSave('factorAdd');
		\dash\face::btnSaveName('save_btn');
		\dash\face::btnSaveValue('save_next');
		\dash\face::btnSaveText(T_("Save Factor & Continue"));

		\dash\data::include_m2('wide');

		\dash\data::showVatColum(\lib\store::detail('show_vat_column'));
		\dash\data::vatDecimal(\lib\vat::decimal());


		$saleQuickAccess = [];
		if(\dash\data::moduleType() === 'sale')
		{
			\lib\app\fund\login::check();
			\lib\app\pos\tools::pc_pos_btn();

			$saleQuickAccess = \lib\app\category\quickaccess::list_in_sale_page();

			\dash\data::orderdefaultpaystatus(\lib\store::detail('orderdefaultpaystatus'));
		}
		\dash\data::saleQuickAccess($saleQuickAccess);

		self::customer_ajax_url();
		self::product_ajax_url();

	}


	private static function customer_ajax_url()
	{
		$customerAjaxAddr = \dash\url::kingdom(). '/crm/api?';

		$temp                = [];
		$temp['json']        = 'true';
		$temp['show_budget'] = 1;
		$temp['type']        = \dash\data::moduleType();

		if(\dash\data::moduleType() === 'sale')
		{
			$input_title = T_("Choose customer");
			$temp['list'] = 'customer';
		}
		else
		{
			$input_title = T_("Choose supplier");
			$temp['list'] = 'supplier';

		}

		$customerAjaxAddr .= \dash\request::build_query($temp);

		\dash\data::customerAjaxAddr($customerAjaxAddr);
		\dash\data::customerAjaxInputTitle($input_title);

	}



	private static function product_ajax_url()
	{
		$productAjaxAddr = \dash\url::this(). '?';

		$temp                = [];
		$temp['json']        = 'true';
		$temp['type']        = \dash\data::moduleType();

		$productAjaxAddr .= \dash\request::build_query($temp);

		\dash\data::productAjaxAddr($productAjaxAddr);

	}
}
?>
