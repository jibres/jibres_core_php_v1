<?php
namespace lib\app\order;

class filter
{
	use \dash\datafilter;


	/**
	 * Fill order args from GET
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function fill_order_args_from_GET()
	{
		$args =
		[
			'order'        => \dash\request::get('order'),
			'sort'         => \dash\request::get('sort'),
		];

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

		return $args;
	}



	public static function sort_list_array($_module = null)
	{

		// public => true means show in api and site
		$sort_list   = [];
		$sort_list[] = ['title' => T_("Sort"), 				'query' => ['sort' => null, 		 'order' => null], 		'public' => false];
		$sort_list[] = ['title' => T_("Date ASC"), 			'query' => ['sort' => 'date',		 'order' => 'asc'], 	'public' => false];
		$sort_list[] = ['title' => T_("Date DESC"), 		'query' => ['sort' => 'date',		 'order' => 'desc'], 	'public' => false];

		$sort_list[] = ['title' => T_("Total ASC"), 		'query' => ['sort' => 'subtotal',	 'order' => 'asc'], 	'public' => false];
		$sort_list[] = ['title' => T_("Total DESC"), 		'query' => ['sort' => 'subtotal',	 'order' => 'desc'], 	'public' => false];

		$sort_list[] = ['title' => T_("Discount ASC"), 		'query' => ['sort' => 'subdiscount', 'order' => 'asc'], 	'public' => false];
		$sort_list[] = ['title' => T_("Discount DESC"), 	'query' => ['sort' => 'subdiscount', 'order' => 'desc'], 	'public' => false];

		$sort_list[] = ['title' => T_("Price ASC"), 		'query' => ['sort' => 'subprice',	 'order' => 'asc'], 	'public' => false];
		$sort_list[] = ['title' => T_("Price DESC"), 		'query' => ['sort' => 'subprice',	 'order' => 'desc'], 	'public' => false];

		$sort_list[] = ['title' => T_("Item ASC"), 			'query' => ['sort' => 'item',		 'order' => 'asc'], 	'public' => false];
		$sort_list[] = ['title' => T_("Item DESC"), 		'query' => ['sort' => 'item',		 'order' => 'desc'], 	'public' => false];

		$sort_list[] = ['title' => T_("Qty ASC"), 			'query' => ['sort' => 'qty',		 'order' => 'asc'], 	'public' => false];
		$sort_list[] = ['title' => T_("Qty DESC"), 			'query' => ['sort' => 'qty',		 'order' => 'desc'], 	'public' => false];



		return $sort_list;
	}



	private static function list_of_filter()
	{

		$list = [];



		$list['pay'] =
		[
			'key'            => 'pay',
			'group'          => T_("Pay"),
			'title'          => T_("Payed"),
			'query'			 => ['pay' => 'y'],
			'public'         => false,
		];

		$list['not_pay'] =
		[
			'key'            => 'not_pay',
			'group'          => T_("Pay"),
			'title'          => T_("Not payed"),
			'query'			 => ['pay' => 'n'],
			'public'         => false,
		];




		return $list;

	}

}
?>