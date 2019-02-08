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
			'load_product' => true,
		];

		$filterArgs = [];
		if(!$args['order'])
		{
			$args['order'] = 'DESC';
		}

		if(\dash\request::get('type'))
		{
			$args['factors.type']       = \dash\request::get('type');
			$filterArgs['type'] = \dash\request::get('type');
		}

		$customer = \dash\request::get('customer');
		if($customer)
		{
			$customer = \dash\coding::decode($customer);
			if($customer)
			{
				$args['factors.customer'] = $customer;
			}
		}

		if(isset($args['factors.customer']) && $args['factors.customer'] === '-quick')
		{
			$args['factors.customer'] = null;
		}

		$product = \dash\request::get('product');
		if($product)
		{
			$product = \dash\coding::decode($product);
			if($product)
			{
				$args['factordetails.product_id'] = $product;
				$args['join_factordetails']    = true;
			}
		}


		$startdate    = null;
		$enddate      = null;


		if(\dash\request::get('startdate'))
		{
			$startdate                 = \dash\request::get('startdate');

			$filterArgs['start'] = \dash\request::get('startdate');
			$startdate                 = \dash\utility\convert::to_en_number($startdate);
			$startdate = \dash\date::db($startdate);
			if($startdate)
			{
				if(\dash\utility\jdate::is_jalali($startdate))
				{
					$startdate = \dash\utility\jdate::to_gregorian($startdate);
				}
				\dash\data::startdateEn($startdate);
			}
		}


		if(\dash\request::get('enddate'))
		{
			$enddate                 = \dash\request::get('enddate');
			$filterArgs['End'] = \dash\request::get('enddate');
			$enddate                 = \dash\utility\convert::to_en_number($enddate);
			$enddate = \dash\date::db($enddate);
			if($enddate)
			{
				if(\dash\utility\jdate::is_jalali($enddate))
				{
					$enddate = \dash\utility\jdate::to_gregorian($enddate);
				}
				\dash\data::enddateEn($enddate);
			}
		}


		if($startdate && $enddate)
		{
			$args['6.6'] = [" = 6.6 ", " AND DATE(factors.datecreated) >= '$startdate' AND DATE(factors.datecreated) <= '$enddate'  "];
		}
		elseif($startdate)
		{
			$args['DATE(factors.datecreated)'] = [">=", " '$startdate' "];
		}
		elseif($enddate)
		{
			$args['DATE(factors.datecreated)'] = ["<=", " '$enddate' "];
		}


		if(\dash\request::get('date'))
		{
			$date                 = \dash\request::get('date');
			$get_date_url['date'] = $date;
			$filterArgs['start'] = \dash\request::get('date');
			$date                 = \dash\utility\convert::to_en_number($date);
			$date = \dash\date::db($date);
			if($date)
			{
				if(\dash\utility\jdate::is_jalali($date))
				{
					$date = \dash\utility\jdate::to_gregorian($date);
				}
				\dash\data::dateEn($date);

				$args['DATE(factors.datecreated)'] = ["=", " '$date' "];
			}

		}

		if(\dash\request::get('time'))
		{
			$time                 = \dash\request::get('time');
			$get_time_url['time'] = $time;
			$filterArgs['start'] = \dash\request::get('time');
			$time                 = \dash\utility\convert::to_en_number($time);
			$time = \dash\date::make_time($time);
			if($time)
			{
				$args['HOUR(factors.datecreated)'] = ["=", " HOUR('$time') AND MINUTE(factors.datecreated) = MINUTE('$time')"];
			}

		}



		$weekday = \dash\request::get('weekday');
		if($weekday && in_array($weekday, ['saturday', 'sunday','monday','tuesday','wednesday','thursday','friday']))
		{
			$args['3.3'] = [" = 3.3 AND", " DAYNAME(factors.datecreated) = '$weekday' "];
		}

		$detailsumlarger = \dash\request::get('detailsumlarger');
		if($detailsumlarger)
		{
			$detailsumlarger = \dash\utility\convert::to_en_number($detailsumlarger);
			if($detailsumlarger && is_numeric($detailsumlarger))
			{
				$args['factors.detailsum'] = [" > ", " '$detailsumlarger' "];
				$filterArgs['detailsum larger than'] = $detailsumlarger;
			}
		}

		$detailsumless = \dash\request::get('detailsumless');
		if($detailsumless)
		{
			$detailsumless = \dash\utility\convert::to_en_number($detailsumless);
			if($detailsumless && is_numeric($detailsumless))
			{
				$args['factors.detailsum'] = [" < ", " '$detailsumless' "];
				$filterArgs['detailsum less than'] = $detailsumless;
			}
		}

		$detailsumequal = \dash\request::get('detailsumequal');
		if($detailsumequal)
		{
			$detailsumequal = \dash\utility\convert::to_en_number($detailsumequal);
			if($detailsumequal && is_numeric($detailsumequal))
			{
				$args['factors.detailsum'] = [" = ", " '$detailsumequal' "];
				$filterArgs['detailsum equal'] = $detailsumequal;
			}
		}

		$itemlarger = \dash\request::get('itemlarger');
		if($itemlarger)
		{
			$itemlarger = \dash\utility\convert::to_en_number($itemlarger);
			if($itemlarger && is_numeric($itemlarger))
			{
				$args['factors.item'] = [" > ", " '$itemlarger' "];
				$filterArgs['item larger than'] = $itemlarger;
			}
		}

		$itemless = \dash\request::get('itemless');
		if($itemless)
		{
			$itemless = \dash\utility\convert::to_en_number($itemless);
			if($itemless && is_numeric($itemless))
			{
				$args['factors.item'] = [" < ", " '$itemless' "];
				$filterArgs['item less than'] = $itemless;
			}
		}

		$itemequal = \dash\request::get('itemequal');
		if($itemequal)
		{
			$itemequal = \dash\utility\convert::to_en_number($itemequal);
			if($itemequal && is_numeric($itemequal))
			{
				$args['factors.item'] = [" = ", " '$itemequal' "];
				$filterArgs['item equal'] = $itemequal;
			}
		}

		$qtylarger = \dash\request::get('qtylarger');
		if($qtylarger)
		{
			$qtylarger = \dash\utility\convert::to_en_number($qtylarger);
			if($qtylarger && is_numeric($qtylarger))
			{
				$args['factors.qty'] = [" > ", " '$qtylarger' "];
				$filterArgs['qty larger than'] = $qtylarger;
			}
		}

		$qtyless = \dash\request::get('qtyless');
		if($qtyless)
		{
			$qtyless = \dash\utility\convert::to_en_number($qtyless);
			if($qtyless && is_numeric($qtyless))
			{
				$args['factors.qty'] = [" < ", " '$qtyless' "];
				$filterArgs['qty less than'] = $qtyless;
			}
		}

		$qtyequal = \dash\request::get('qtyequal');
		if($qtyequal)
		{
			$qtyequal = \dash\utility\convert::to_en_number($qtyequal);
			if($qtyequal && is_numeric($qtyequal))
			{
				$args['factors.qty'] = [" = ", " '$qtyequal' "];
				$filterArgs['qty equal'] = $qtyequal;
			}
		}

		$detailtotalsumlarger = \dash\request::get('detailtotalsumlarger');
		if($detailtotalsumlarger)
		{
			$detailtotalsumlarger = \dash\utility\convert::to_en_number($detailtotalsumlarger);
			if($detailtotalsumlarger && is_numeric($detailtotalsumlarger))
			{
				$args['factors.detailtotalsum'] = [" > ", " '$detailtotalsumlarger' "];
				$filterArgs['detailtotalsum larger than'] = $detailtotalsumlarger;
			}
		}

		$detailtotalsumless = \dash\request::get('detailtotalsumless');
		if($detailtotalsumless)
		{
			$detailtotalsumless = \dash\utility\convert::to_en_number($detailtotalsumless);
			if($detailtotalsumless && is_numeric($detailtotalsumless))
			{
				$args['factors.detailtotalsum'] = [" < ", " '$detailtotalsumless' "];
				$filterArgs['detailtotalsum less than'] = $detailtotalsumless;
			}
		}

		$detailtotalsumequal = \dash\request::get('detailtotalsumequal');
		if($detailtotalsumequal)
		{
			$detailtotalsumequal = \dash\utility\convert::to_en_number($detailtotalsumequal);
			if($detailtotalsumequal && is_numeric($detailtotalsumequal))
			{
				$args['factors.detailtotalsum'] = [" = ", " '$detailtotalsumequal' "];
				$filterArgs['detailtotalsum equal'] = $detailtotalsumequal;
			}
		}


		$detaildiscountlarger = \dash\request::get('detaildiscountlarger');
		if($detaildiscountlarger)
		{
			$detaildiscountlarger = \dash\utility\convert::to_en_number($detaildiscountlarger);
			if($detaildiscountlarger && is_numeric($detaildiscountlarger))
			{
				$args['factors.detaildiscount'] = [" > ", " '$detaildiscountlarger' "];
				$filterArgs['detaildiscount larger than'] = $detaildiscountlarger;
			}
		}

		$detaildiscountless = \dash\request::get('detaildiscountless');
		if($detaildiscountless)
		{
			$detaildiscountless = \dash\utility\convert::to_en_number($detaildiscountless);
			if($detaildiscountless && is_numeric($detaildiscountless))
			{
				$args['factors.detaildiscount'] = [" < ", " '$detaildiscountless' "];
				$filterArgs['detaildiscount less than'] = $detaildiscountless;
			}
		}

		$detaildiscountequal = \dash\request::get('detaildiscountequal');
		if($detaildiscountequal)
		{
			$detaildiscountequal = \dash\utility\convert::to_en_number($detaildiscountequal);
			if($detaildiscountequal && is_numeric($detaildiscountequal))
			{
				$args['factors.detaildiscount'] = [" = ", " '$detaildiscountequal' "];
				$filterArgs['detaildiscount equal'] = $detaildiscountequal;
			}
		}

		$detailtotalsum = \dash\request::get('detailtotalsum');
		if($detailtotalsum)
		{
			$detailtotalsum = \dash\utility\convert::to_en_number($detailtotalsum);
			if($detailtotalsum && is_numeric($detailtotalsum))
			{
				$args['factors.detailtotalsum'] = [" = ", " '$detailtotalsum' "];
				$filterArgs['detaildiscount equal'] = $detailtotalsum;
			}
		}

		$dataTable = \lib\app\factor::list(\dash\request::get('q'), $args);
		\dash\data::dataTable($dataTable);

		if(isset($args['factors.customer']))
		{
			$customer_name = '';
			if(isset($dataTable[0]['customer_firstname']))
			{
				$customer_name .= $dataTable[0]['customer_firstname'];
			}

			if(isset($dataTable[0]['customer_lastname']))
			{
				$customer_name .=  ' '. $dataTable[0]['customer_lastname'];
			}

			if(isset($dataTable[0]['customer_displayname']))
			{
				$customer_name .= ' '. $dataTable[0]['customer_displayname'];
			}

			$filterArgs['customer'] = $customer_name;
		}

		\dash\data::myFilter(\content_a\filter::current(\lib\app\factor::$sort_field, \dash\url::this()));

		\dash\data::filterBox(\dash\app\sort::createFilterMsg(\dash\request::get('q'), $filterArgs));

		$dashboard_detail = \lib\app\factor\dashboard::detail();
		\dash\data::dashboardDetail($dashboard_detail);


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
