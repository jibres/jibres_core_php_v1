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
			$get_date_url['startdate'] = $startdate;
			$filterArgs['start'] = \dash\request::get('startdate');
			$startdate                 = \dash\utility\convert::to_en_number($startdate);

			if(\dash\utility\jdate::is_jalali($startdate))
			{
				$startdate = \dash\utility\jdate::to_gregorian($startdate);
			}
			\dash\data::startdateEn($startdate);
		}


		if(\dash\request::get('enddate'))
		{
			$enddate                 = \dash\request::get('enddate');
			$get_date_url['enddate'] = $enddate;
			$filterArgs['End'] = \dash\request::get('enddate');
			$enddate                 = \dash\utility\convert::to_en_number($enddate);
			if(\dash\utility\jdate::is_jalali($enddate))
			{
				$enddate = \dash\utility\jdate::to_gregorian($enddate);
			}
			\dash\data::enddateEn($enddate);
		}


		if($startdate && $enddate)
		{
			$args['1.1'] = [" = 1.1 ", " AND DATE(academytransactions.datecreated) >= '$startdate' AND DATE(academytransactions.datecreated) <= '$enddate'  "];

		}
		elseif($startdate)
		{
			$args['DATE(academytransactions.datecreated)'] = [">=", " '$startdate' "];
		}
		elseif($enddate)
		{
			$args['DATE(academytransactions.datecreated)'] = ["<=", " '$enddate' "];
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
