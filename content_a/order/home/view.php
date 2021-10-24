<?php
namespace content_a\order\home;


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


		$orderFilterList = \lib\app\factor\filter::list();
		\dash\data::orderFilterList($orderFilterList);



		\dash\data::sortList(\lib\app\factor\filter::sort_list());

		if(\dash\request::get('pay'))					 { $args['pay']       		  = \dash\request::get('pay');				}
		if(\dash\request::get('customer'))				 { $args['customer']          = \dash\request::get('customer');			}
		if(\dash\request::get('type'))					 { $args['type']              = \dash\request::get('type');				}
		if(\dash\request::get('product'))				 { $args['product']           = \dash\request::get('product');			}
		if(\dash\request::get('startdate'))				 { $args['startdate']         = \dash\request::get('startdate');		}
		if(\dash\request::get('enddate'))				 { $args['enddate']           = \dash\request::get('enddate');			}
		if(\dash\request::get('date'))					 { $args['date']              = \dash\request::get('date');				}
		if(\dash\request::get('time'))					 { $args['time']              = \dash\request::get('time');				}
		if(\dash\request::get('weekday'))				 { $args['weekday']           = \dash\request::get('weekday');			}
		if(\dash\request::get('subpricelarger'))		 { $args['subpricelarger']    = \dash\request::get('subpricelarger');	}
		if(\dash\request::get('subpriceless'))			 { $args['subpriceless']      = \dash\request::get('subpriceless');		}
		if(\dash\request::get('subpriceequal'))			 { $args['subpriceequal']     = \dash\request::get('subpriceequal');	}
		if(\dash\request::get('itemlarger'))			 { $args['itemlarger']        = \dash\request::get('itemlarger');		}
		if(\dash\request::get('itemless'))				 { $args['itemless']          = \dash\request::get('itemless');			}
		if(\dash\request::get('itemequal'))				 { $args['itemequal']         = \dash\request::get('itemequal');		}
		if(\dash\request::get('qtylarger'))				 { $args['qtylarger']         = \dash\request::get('qtylarger');		}
		if(\dash\request::get('qtyless'))				 { $args['qtyless']           = \dash\request::get('qtyless');			}
		if(\dash\request::get('qtyequal'))				 { $args['qtyequal']          = \dash\request::get('qtyequal');			}
		if(\dash\request::get('subtotallarger'))		 { $args['subtotallarger']    = \dash\request::get('subtotallarger');	}
		if(\dash\request::get('subtotalless'))	 		 { $args['subtotalless']      = \dash\request::get('subtotalless');		}
		if(\dash\request::get('subtotalequal'))	 	 	 { $args['subtotalequal']     = \dash\request::get('subtotalequal');	}
		if(\dash\request::get('subdiscountlarger'))	 	 { $args['subdiscountlarger'] = \dash\request::get('subdiscountlarger');}
		if(\dash\request::get('subdiscountless'))	  	 { $args['subdiscountless']   = \dash\request::get('subdiscountless');	}
		if(\dash\request::get('subdiscountequal'))	 	 { $args['subdiscountequal']  = \dash\request::get('subdiscountequal');	}
		if(\dash\request::get('subtotal'))		 		 { $args['subtotal']          = \dash\request::get('subtotal');			}
		if(\dash\request::get('discount_id'))	 		 { $args['discount_id']       = \dash\request::get('discount_id');		}

		if(\dash\url::child() === 'unprocessed')
		{
			$args['get_unprocessed'] = true;
		}

		$search_string = \dash\validate::search_string();

		\lib\app\back_btn\link::set_order();

		$myFactorList = \lib\app\factor\search::list($search_string, $args);

		\dash\data::dataTable($myFactorList);

		if(!is_array($myFactorList))
		{
			$myFactorList = [];
		}

		if(count(array_filter(array_column($myFactorList, 'subvat'))) === 0 )
		{
			\dash\data::hideSubvat(true);
		}

		if(count(array_filter(array_column($myFactorList, 'shipping'))) === 0 )
		{
			\dash\data::hideShipping(true);
		}

		\dash\data::filterBox(\lib\app\factor\search::filter_message());


		$isFiltered = \lib\app\factor\search::is_filtered();

		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
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

			switch ($moduleType)
			{
				case 'buy':
					$myBadgeLink = \dash\url::here(). '/'. $moduleType;
					$myBadgeText = T_('Add new :type', ['type' => T_($moduleType)]);
					break;

				case 'sale':
					$myBadgeLink = \dash\url::here(). '/'. $moduleType;
					$myBadgeText = T_('Add new :type', ['type' => T_($moduleType)]);
					break;

				default:
					# code...
					break;
			}
		}

		\dash\face::title($myTitle);

		\dash\data::action_text(T_("Add new order"));
		\dash\data::action_link(\dash\url::kingdom(). '/a/sale');

		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::here());
	}
}
?>
