<?php
namespace lib\app\tax\doc;


class template
{
	public static function get($_id)
	{
		$result = [];

		$tax_document = \lib\app\tax\doc\get::get($_id);
		if(isset($tax_document['template']) && $tax_document['template'])
		{
			// ok
		}
		else
		{
			\dash\notif::error(T_("Can not route this document in this page"));
			return false;
		}

		$doc_detail = \lib\app\tax\docdetail\get::list($_id);

		if(!is_array($doc_detail))
		{
			$doc_detail = [];
		}

		$fill_value = [];

		foreach ($doc_detail as $key => $value)
		{
			$fill_value[$value['template']] = $value;
		}

		$result['tax_document'] = $tax_document;
		$result['fill_value']   = $fill_value;
		$result['doc_detail']   = $doc_detail;

		return $result;

	}


	public static function edit($_args, $_id)
	{
		$tax_document = \lib\app\tax\doc\get::get($_id);
		if(isset($tax_document['template']) && $tax_document['template'])
		{
			// ok
		}
		else
		{
			\dash\notif::error(T_("Can not route this document in this page"));
			return false;
		}

		$_args['template'] = $tax_document['template'];

		\dash\db::transaction();


		if(!a($_args, 'desc'))
		{
			$_args['desc'] = self::generate_auto_desc($_args);
		}

		$edit = edit::edit($_args, $_id, false, ['template_mode' => true]);

		if(!$edit)
		{
			\dash\db::rollback();
			\dash\notif::error_once(T_("Can not edit this document"));
			return false;
		}

		$args = \lib\app\tax\doc\check::variable($_args, ['template_mode' => true]);
		// remove all doc detail
		\lib\db\tax_docdetail\delete::by_doc_id($_id);


		if(!self::add_template_doc_detail($args, $_id))
		{
			return false;
		}

		\dash\notif::ok(T_("Accounting doc successfully edited"));

		return true;

	}



	public static function add($_args)
	{
		$args = \lib\app\tax\doc\check::variable($_args, ['template_mode' => true]);

		if(!$args)
		{
			return false;
		}

		$args['datecreated'] = date("Y-m-d H:i:s");

		$args['type'] = 'normal';

		if(!a($args, 'desc'))
		{
			$args['desc'] = self::generate_auto_desc($args);
		}

		$doc_detail_args = $args;


		unset($args['pay_from']);
		unset($args['put_on']);
		unset($args['thirdparty']);
		unset($args['bank']);
		unset($args['petty_cash']);
		unset($args['partner']);
		unset($args['bank_profit']);

		\dash\db::transaction();

		$tax_document_id = \lib\db\tax_document\insert::new_record($args);

		if(!$tax_document_id)
		{
			\dash\db::rollback();

			\dash\notif::error(T_("Can not add your data"));
			return false;
		}

		if(!self::add_template_doc_detail($doc_detail_args, $tax_document_id))
		{
			return false;
		}


		\dash\notif::ok(T_("Accounting doc successfully added"));

		return ['id' => $tax_document_id];
	}


	private static function load_coding_detail($_args)
	{
		$coding_id =
		[
			a($_args, 'tax'),
			a($_args, 'vat'),
			a($_args, 'bank'),
			a($_args, 'petty_cash'),
			a($_args, 'partner'),
			a($_args, 'pay_from'),
			a($_args, 'put_on'),
			a($_args, 'thirdparty'),
			a($_args, 'bank_profit'),
		];

		$coding_id = array_filter($coding_id);
		$coding_id = array_unique($coding_id);
		$coding_id = array_map('intval', $coding_id);

		if(!$coding_id)
		{
			\dash\notif::error(T_("Invalid coding id"));
			return false;
		}


		$load_coding = \lib\db\tax_coding\get::by_multi_id(implode(',', $coding_id));

		if(!is_array($load_coding))
		{
			$load_coding = [];
		}

		$load_coding = array_combine(array_column($load_coding, 'id'), $load_coding);

		return $load_coding;
	}


	private static function generate_auto_desc($_args)
	{
		$desc = [];

		$my_detail_id = null;

		switch (a($_args, 'template'))
		{
			case 'cost':
				$my_detail_id = a($_args, 'thirdparty');
				if(!a($_args, 'put_on'))
				{
					$desc[] = T_("Pay to");
				}
				elseif(!$my_detail_id && a($_args, 'put_on'))
				{
					$desc[] = T_("Cost");

					$put_on = \dash\validate::id(a($_args, 'put_on'), false);
					if($put_on)
					{
						$load_coding = \lib\db\tax_coding\get::by_id($put_on);

						if(isset($load_coding['title']))
						{
							$desc[] = $load_coding['title'];
						}
					}
				}
				else
				{
					$desc[] = T_("Buy from");
				}
				break;

			case 'income':
				$my_detail_id = a($_args, 'thirdparty');
				$desc[] = T_("Sell to");
				break;

			case 'asset':
				$my_detail_id = a($_args, 'thirdparty');
				if($my_detail_id)
				{
					$desc[] = T_("Buy from");
				}
				elseif(!$my_detail_id && a($_args, 'put_on'))
				{
					$desc[] = T_("Buy");

					$put_on = \dash\validate::id(a($_args, 'put_on'), false);
					if($put_on)
					{
						$load_coding = \lib\db\tax_coding\get::by_id($put_on);

						if(isset($load_coding['title']))
						{
							$desc[] = $load_coding['title'];
						}
					}
				}
				break;

			case 'bill':
				$my_detail_id = a($_args, 'thirdparty');
				$desc[] = T_("Buy from");
				break;

			case 'petty_cash':
			case 'partner':
				$my_detail_id = a($_args, 'petty_cash');
				$desc[] = T_("Charge petty cash");
				break;

			case 'bank_partner':
				$my_detail_id = a($_args, 'bank');
				$desc[] = T_("Deposit partner to");
				break;

			case 'bank_profit':
				$my_detail_id = a($_args, 'bank');
				$desc[] = T_("Payment of interest");

				break;

			default:
				$desc[] = T_("Factor");
				break;
		}

		if($my_detail_id)
		{

			$my_detail_id = \dash\validate::id($my_detail_id, false);
			if($my_detail_id)
			{
				$load_coding = \lib\db\tax_coding\get::by_id($my_detail_id);

				if(isset($load_coding['title']))
				{
					$desc[] = $load_coding['title'];
				}
			}

		}

		if(a($_args, 'serialnumber'))
		{
			$desc[] = '-';
			$desc[] = T_("Factor");
			$desc[] = \dash\fit::text(a($_args, 'serialnumber'));
		}

		return implode(' ', $desc);
	}


	private static function add_template_doc_detail($args, $tax_document_id)
	{

		$accounting_setting = \lib\app\setting\get::accounting_setting();

		switch ($args['template'])
		{
			case 'asset':
			case 'cost':
				$default_cost_tax = a($accounting_setting, 'default_cost_tax');
				if(!$default_cost_tax)
				{
					$get_coding_id = \lib\db\tax_coding\get::by_code(21062);
					if(isset($get_coding_id['id']))
					{
						$default_cost_tax = $get_coding_id['id'];
					}
				}

				$default_cost_vat = a($accounting_setting, 'default_cost_vat');
				if(!$default_cost_vat)
				{
					$get_coding_id = \lib\db\tax_coding\get::by_code(21061);
					if(isset($get_coding_id['id']))
					{
						$default_cost_vat = $get_coding_id['id'];
					}

				}

				$args['tax'] = $default_cost_tax;
				$args['vat'] = $default_cost_vat;
				break;

			case 'income':
				$default_income_tax = a($accounting_setting, 'default_income_tax');
				if(!$default_income_tax)
				{
					$get_coding_id = \lib\db\tax_coding\get::by_code(52071);
					if(isset($get_coding_id['id']))
					{
						$default_income_tax = $get_coding_id['id'];
					}

				}

				$default_income_vat = a($accounting_setting, 'default_income_vat');
				if(!$default_income_vat)
				{
					$get_coding_id = \lib\db\tax_coding\get::by_code(52072);
					if(isset($get_coding_id['id']))
					{
						$default_income_vat = $get_coding_id['id'];
					}

				}

				$args['tax'] = $default_income_tax;
				$args['vat'] = $default_income_vat;
				break;


			case 'petty_cash':
			case 'bank_profit':
			case 'bank_partner':
			case 'partner':
			case 'bill':
				// nothing
				break;


			default:
				\dash\notif::error(T_("Can not support this document template"));
				return false;
				break;
		}

		$load_coding_detail = self::load_coding_detail($args);

		if(!$load_coding_detail)
		{
			return false;
		}

		$pay_from    = a($args, 'pay_from');
		$put_on      = a($args, 'put_on');
		$partner     = a($args, 'partner');
		$tax         = a($args, 'tax');
		$vat         = a($args, 'vat');
		$bank        = a($args, 'bank');
		$petty_cash  = a($args, 'petty_cash');
		$thirdparty  = a($args, 'thirdparty');
		$bank_profit = a($args, 'bank_profit');

		$add_doc_detail = [];

		$totalMinusDiscount = $args['total'] - $args['totaldiscount'];
		$final              = $totalMinusDiscount + $args['totalvat'];

		$vat_value      = 0;
		$tax_value      = 0;

		if(in_array($args['template'], ['income']))
		{

			if(!$put_on)
			{
				\dash\notif::error(T_("Income from is required"));
				return false;
			}

			if(!$thirdparty)
			{
				\dash\notif::error(T_("Buyer is required"));
				return false;
			}

			if($args['totalvat'] && $tax)
			{
				$add_doc_detail[] =
				[
					'tax_document_id' => $tax_document_id,
					'assistant_id'    => a($load_coding_detail, $tax, 'parent3'),
					'details_id'      => $tax,
					'type'            => 'creditor',
					'value'           => $tax_value = round(($args['totalvat'] / 9) * 6),
					'sort'            => 3,
					'template'        => 'tax',
				];
			}

			if($args['totalvat'] && $vat)
			{
				$add_doc_detail[] =
				[
					'tax_document_id' => $tax_document_id,
					'assistant_id'    => a($load_coding_detail, $vat, 'parent3'),
					'details_id'      => $vat,
					'type'            => 'creditor',
					'value'           => $vat_value = round(($args['totalvat'] / 9) * 3),
					'sort'            => 4,
					'template'        => 'vat',
				];
			}

			$add_doc_detail[] =
			[
				'tax_document_id' => $tax_document_id,
				'assistant_id'    => a($load_coding_detail, $put_on, 'parent3'),
				'details_id'      => $put_on,
				'type'            => 'creditor',
				'value'           => $totalMinusDiscount - $args['totalvat'],
				'sort'            => 2,
				'template'        => 'put_on',
			];


			if($pay_from)
			{
				$add_doc_detail[] =
				[
					'tax_document_id' => $tax_document_id,
					'assistant_id'    => a($load_coding_detail, $thirdparty, 'parent3'),
					'details_id'      => $thirdparty,
					'type'            => 'creditor',
					'value'           => $totalMinusDiscount,
					'sort'            => 10, // ok
					'template'            => 'thirdparty',
				];

				$add_doc_detail[] =
				[
					'tax_document_id' => $tax_document_id,
					'assistant_id'    => a($load_coding_detail, $thirdparty, 'parent3'),
					'details_id'      => $thirdparty,
					'type'            => 'debtor',
					'value'           => $totalMinusDiscount,
					'sort'            => 1,
					'template'        => 'thirdparty',
				];

				$add_doc_detail[] =
				[
					'tax_document_id' => $tax_document_id,
					'assistant_id'    => a($load_coding_detail, $pay_from, 'parent3'),
					'details_id'      => $pay_from,
					'type'            => 'debtor',
					'value'           => $totalMinusDiscount,
					'sort'            => 7,
					'template'        => 'pay_from',
				];
			}
			elseif(!$pay_from)
			{
				$add_doc_detail[] =
				[
					'tax_document_id' => $tax_document_id,
					'assistant_id'    => a($load_coding_detail, $thirdparty, 'parent3'),
					'details_id'      => $thirdparty,
					'type'            => 'debtor',
					'value'           => $totalMinusDiscount,
					'sort'            => 1,
					'template'        => 'thirdparty',
				];
			}


		}
		elseif(in_array($args['template'], ['cost', 'asset']))
		{
			if($args['totalvat'] && $tax)
			{
				$add_doc_detail[] =
				[
					'tax_document_id' => $tax_document_id,
					'assistant_id'    => a($load_coding_detail, $tax, 'parent3'),
					'details_id'      => $tax,
					'type'            => 'debtor',
					'value'           => $tax_value = round(($args['totalvat'] / 9) * 3),
					'sort'            => 3,
					'template'        => 'tax',
				];
			}

			if($args['totalvat'] && $vat)
			{
				$add_doc_detail[] =
				[
					'tax_document_id' => $tax_document_id,
					'assistant_id'    => a($load_coding_detail, $vat, 'parent3'),
					'details_id'      => $vat,
					'type'            => 'debtor',
					'value'           => $vat_value = round(($args['totalvat'] / 9) * 6),
					'sort'            => 2,
					'template'        => 'vat',
				];
			}

			if($put_on)
			{
				$add_doc_detail[] =
				[
					'tax_document_id' => $tax_document_id,
					'assistant_id'    => a($load_coding_detail, $put_on, 'parent3'),
					'details_id'      => $put_on,
					'type'            => 'debtor',
					'value'           => $totalMinusDiscount,
					'sort'            => 1,
					'template'        => 'put_on',
				];
			}




			if($pay_from && $thirdparty)
			{
				if($put_on)
				{
					$add_doc_detail[] =
					[
						'tax_document_id' => $tax_document_id,
						'assistant_id'    => a($load_coding_detail, $thirdparty, 'parent3'),
						'details_id'      => $thirdparty,
						'type'            => 'creditor',
						'value'           => $final,
						'sort'            => 4,
						'template'            => 'thirdparty',
					];

				}

				$add_doc_detail[] =
				[
					'tax_document_id' => $tax_document_id,
					'assistant_id'    => a($load_coding_detail, $thirdparty, 'parent3'),
					'details_id'      => $thirdparty,
					'type'            => 'debtor',
					'value'           => $final,
					'sort'            => 5,
					'template'        => 'thirdparty',
				];

				$add_doc_detail[] =
				[
					'tax_document_id' => $tax_document_id,
					'assistant_id'    => a($load_coding_detail, $pay_from, 'parent3'),
					'details_id'      => $pay_from,
					'type'            => 'creditor',
					'value'           => $final,
					'sort'            => 6,
					'template'        => 'pay_from',
				];
			}
			elseif($pay_from && !$thirdparty)
			{
				$add_doc_detail[] =
				[
					'tax_document_id' => $tax_document_id,
					'assistant_id'    => a($load_coding_detail, $pay_from, 'parent3'),
					'details_id'      => $pay_from,
					'type'            => 'creditor',
					'value'           => $final,
					'sort'            => 6,
					'template'        => 'pay_from',
				];
			}
			elseif(!$pay_from && $thirdparty)
			{
				$add_doc_detail[] =
				[
					'tax_document_id' => $tax_document_id,
					'assistant_id'    => a($load_coding_detail, $thirdparty, 'parent3'),
					'details_id'      => $thirdparty,
					'type'            => 'creditor',
					'value'           => $final,
					'sort'            => 5,
					'template'        => 'thirdparty',
				];
			}


		}
		elseif($args['template'] === 'petty_cash')
		{

			$add_doc_detail[] =
			[
				'tax_document_id' => $tax_document_id,
				'assistant_id'    => a($load_coding_detail, $petty_cash, 'parent3'),
				'details_id'      => $petty_cash,
				'type'            => 'debtor',
				'value'           => $args['total'],
				'sort'            => 1,
				'template'        => 'petty_cash',
			];

			$add_doc_detail[] =
			[
				'tax_document_id' => $tax_document_id,
				'assistant_id'    => a($load_coding_detail, $bank, 'parent3'),
				'details_id'      => $bank,
				'type'            => 'creditor',
				'value'           => $args['total'],
				'sort'            => 2,
				'template'        => 'bank',
			];
		}
		elseif($args['template'] === 'partner')
		{


			$add_doc_detail[] =
			[
				'tax_document_id' => $tax_document_id,
				'assistant_id'    => a($load_coding_detail, $petty_cash, 'parent3'),
				'details_id'      => $petty_cash,
				'type'            => 'debtor',
				'value'           => $args['total'],
				'sort'            => 1,
				'template'        => 'petty_cash',
			];

			$add_doc_detail[] =
			[
				'tax_document_id' => $tax_document_id,
				'assistant_id'    => a($load_coding_detail, $partner, 'parent3'),
				'details_id'      => $partner,
				'type'            => 'creditor',
				'value'           => $args['total'],
				'sort'            => 2,
				'template'        => 'partner',
			];
		}
		elseif($args['template'] === 'bank_partner')
		{
			$add_doc_detail[] =
			[
				'tax_document_id' => $tax_document_id,
				'assistant_id'    => a($load_coding_detail, $bank, 'parent3'),
				'details_id'      => $bank,
				'type'            => 'debtor',
				'value'           => $args['total'],
				'sort'            => 1,
				'template'        => 'bank',
			];

			$add_doc_detail[] =
			[
				'tax_document_id' => $tax_document_id,
				'assistant_id'    => a($load_coding_detail, $partner, 'parent3'),
				'details_id'      => $partner,
				'type'            => 'creditor',
				'value'           => $args['total'],
				'sort'            => 2,
				'template'        => 'partner',
			];

		}
		elseif($args['template'] === 'bank_profit')
		{

			$add_doc_detail[] =
			[
				'tax_document_id' => $tax_document_id,
				'assistant_id'    => a($load_coding_detail, $bank, 'parent3'),
				'details_id'      => $bank,
				'type'            => 'debtor',
				'value'           => $args['total'],
				'sort'            => 1,
				'template'        => 'bank',
			];
			$add_doc_detail[] =
			[
				'tax_document_id' => $tax_document_id,
				'assistant_id'    => a($load_coding_detail, $bank_profit, 'parent3'),
				'details_id'      => $bank_profit,
				'type'            => 'creditor',
				'value'           => $args['total'],
				'sort'            => 2,
				'template'        => 'bank_profit',
			];

		}
		else
		{
			\dash\notif::error(T_("Can not support this template"));
			return false;
		}


		foreach ($add_doc_detail as $key => $value)
		{
			\lib\app\tax\docdetail\add::add($value);

			if(!\dash\engine\process::status())
			{
				\dash\db::rollback();
				return false;
			}
		}

		\dash\notif::clean();

		// \lib\app\tax\doc\edit::edit_status(['status' => 'lock'], $tax_document_id);

		if(\dash\engine\process::status())
		{
			\dash\db::commit();
			return true;
		}
		else
		{
			\dash\db::rollback();
			return false;
		}
	}

}
?>