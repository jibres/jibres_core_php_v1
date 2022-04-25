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

			if($saleQuickAccess)
			{
				\dash\data::haveAnyCategory(true);
			}
			else
			{
				\dash\data::haveAnyCategory(\lib\app\category\quickaccess::have_any_category());
			}

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


	public static function keyboard_html($_class = null)
	{
		$html = '';
		$html .= '<div class="flex-none grid grid-cols-3 gap-1 bg-white p-2 '. $_class . '" >';
		{
			// $html .= '<kbd data-kbd-press="-" class="btn-secondary w-12 leading-5">'. '-' .'</kbd>';
	        // $html .= '<kbd data-kbd-press="*" class="btn-secondary w-12 leading-5">'. '*' .'</kbd>';
	        // $html .= '<kbd data-kbd-press="/" class="btn-secondary w-12 leading-5">'. '/' .'</kbd>';
	        // $html .= '<kbd data-kbd-press="+" class="btn-secondary w-12 leading-5 row-span-4 max-h-full">'. '+' .'</kbd>';

	        $html .= '<kbd data-kbd-press="9" class="btn-secondary w-12 leading-5">'. 9 .'</kbd>';
	        $html .= '<kbd data-kbd-press="8" class="btn-secondary w-12 leading-5">'. 8 .'</kbd>';
	        $html .= '<kbd data-kbd-press="7" class="btn-secondary w-12 leading-5">'. 7 .'</kbd>';

	        $html .= '<kbd data-kbd-press="6" class="btn-secondary w-12 leading-5">'. 6 .'</kbd>';
	        $html .= '<kbd data-kbd-press="5" class="btn-secondary w-12 leading-5">'. 5 .'</kbd>';
	        $html .= '<kbd data-kbd-press="4" class="btn-secondary w-12 leading-5">'. 4 .'</kbd>';

	        $html .= '<kbd data-kbd-press="3" class="btn-secondary w-12 leading-5">'. 3 .'</kbd>';
	        $html .= '<kbd data-kbd-press="2" class="btn-secondary w-12 leading-5">'. 2 .'</kbd>';
	        $html .= '<kbd data-kbd-press="1" class="btn-secondary w-12 leading-5">'. 1 .'</kbd>';

	        $html .= '<kbd data-kbd-press="clr" class="btn-secondary w-12 leading-5">'. 'CLR' .'</kbd>';
	        $html .= '<kbd data-kbd-press="." class="btn-secondary w-12 leading-5">'. '.' .'</kbd>';
	        $html .= '<kbd data-kbd-press="0" class="btn-secondary w-12 leading-5">'. 0 .'</kbd>';
		}
		$html .= '</div>';

        return $html;
	}
}
?>
