<?php
namespace content_a\factor\home;


class view
{
	public static function config()
	{

		self::set_best_title();

		$args =
		[
			'order'        => \dash\request::get('order'),
			'sort'         => \dash\request::get('sort'),
		];

		if(\dash\request::get('customer'))				 $args['customer']             = \dash\request::get('customer');
		if(\dash\request::get('type'))					 $args['type']          	   = \dash\request::get('type');
		if(\dash\request::get('product'))				 $args['product']              = \dash\request::get('product');
		if(\dash\request::get('startdate'))				 $args['startdate']            = \dash\request::get('startdate');
		if(\dash\request::get('enddate'))				 $args['enddate']              = \dash\request::get('enddate');
		if(\dash\request::get('date'))					 $args['date']                 = \dash\request::get('date');
		if(\dash\request::get('time'))					 $args['time']                 = \dash\request::get('time');
		if(\dash\request::get('weekday'))				 $args['weekday']              = \dash\request::get('weekday');
		if(\dash\request::get('subpricelarger'))		 $args['subpricelarger']      = \dash\request::get('subpricelarger');
		if(\dash\request::get('subpriceless'))			 $args['subpriceless']        = \dash\request::get('subpriceless');
		if(\dash\request::get('subpriceequal'))		 $args['subpriceequal']       = \dash\request::get('subpriceequal');
		if(\dash\request::get('itemlarger'))			 $args['itemlarger']           = \dash\request::get('itemlarger');
		if(\dash\request::get('itemless'))				 $args['itemless']             = \dash\request::get('itemless');
		if(\dash\request::get('itemequal'))				 $args['itemequal']            = \dash\request::get('itemequal');
		if(\dash\request::get('qtylarger'))				 $args['qtylarger']            = \dash\request::get('qtylarger');
		if(\dash\request::get('qtyless'))				 $args['qtyless']              = \dash\request::get('qtyless');
		if(\dash\request::get('qtyequal'))				 $args['qtyequal']             = \dash\request::get('qtyequal');
		if(\dash\request::get('detailtotalsumlarger'))	 $args['detailtotalsumlarger'] = \dash\request::get('detailtotalsumlarger');
		if(\dash\request::get('detailtotalsumless'))	 $args['detailtotalsumless']   = \dash\request::get('detailtotalsumless');
		if(\dash\request::get('detailtotalsumequal'))	 $args['detailtotalsumequal']  = \dash\request::get('detailtotalsumequal');
		if(\dash\request::get('subdiscountlarger'))	 $args['subdiscountlarger'] = \dash\request::get('subdiscountlarger');
		if(\dash\request::get('subdiscountless'))	 $args['subdiscountless']   = \dash\request::get('subdiscountless');
		if(\dash\request::get('subdiscountequal'))	 $args['subdiscountequal']  = \dash\request::get('subdiscountequal');
		if(\dash\request::get('detailtotalsum'))		 $args['detailtotalsum']       = \dash\request::get('detailtotalsum');

		$search_string = \dash\request::get('q');


		$myFactorList = \lib\app\factor\search::list($search_string, $args);

		\dash\data::dataTable($myFactorList);

		\dash\data::filterBox(\lib\app\factor\search::filter_message());

		$sort_field = ['date', 'subprice', 'detailtotalsum', 'subdiscount', 'item', 'qty','customer'];
		\dash\data::myFilter(\content_a\filter::current($sort_field, \dash\url::this()));

		$isFiltered = \lib\app\factor\search::is_filtered();

		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\data::page_title(\dash\data::page_title() . '  '. T_('Filtered'));
		}



	}


	private static function set_best_title()
	{
		// set usable variable
		$moduleType = \dash\request::get('type');

		\dash\data::moduleType($moduleType);
		\dash\data::moduleTypeP('?type='.$moduleType);


		// set default title
		$myTitle     = T_('List of factors');
		$myDesc      = T_('You can search in list of factors, add new factor or edit existing.');
		// set badge
		$myBadgeLink = \dash\url::here();
		$myBadgeText = T_('Back to dashboard');


		// // for special condition
		if($moduleType)
		{
			$myTitle     = T_('List of :type', ['type' => T_($moduleType)]);
			$myDesc      = T_('Search in list of :type factors, add or edit them.', ['type' => T_($moduleType)]);
			$myDesc      .= ' <a href="'. \dash\url::this() .'" data-shortkey="121">'. T_('List of all factors.'). '<kbd>f10</kbd></a>';

			switch ($moduleType)
			{
				case 'buy':
					\dash\permission::access('factorBuyList');
					$myBadgeLink = \dash\url::here(). '/'. $moduleType;
					$myBadgeText = T_('Add new :type', ['type' => T_($moduleType)]);
					break;

				case 'sale':
					\dash\permission::access('factorSaleList');
					$myBadgeLink = \dash\url::here(). '/'. $moduleType;
					$myBadgeText = T_('Add new :type', ['type' => T_($moduleType)]);
					break;

				default:
					# code...
					break;
			}
		}

		\dash\data::page_title($myTitle);
		\dash\data::page_desc($myDesc);

		\dash\data::badge_text($myBadgeText);
		\dash\data::badge_link($myBadgeLink);
	}
}
?>
