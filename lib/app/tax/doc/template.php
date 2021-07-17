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

		// \lib\app\tax\doc\edit::edit_status(['status' => 'draft'], $_id);

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



		$doc_detail_args = $args;


		unset($args['pay_from']);
		unset($args['put_on']);
		unset($args['tax']);
		unset($args['vat']);
		unset($args['thirdparty']);

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
			$_args['pay_from'],
			$_args['put_on'],
			$_args['tax'],
			$_args['vat'],
			$_args['thirdparty'],
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


	private static function add_template_doc_detail($args, $tax_document_id)
	{

		$load_coding_detail = self::load_coding_detail($args);

		if(!$load_coding_detail)
		{
			return false;
		}

		$pay_from     = $args['pay_from'];
		$put_on       = $args['put_on'];
		$tax          = $args['tax'];
		$vat          = $args['vat'];
		$thirdparty   = $args['thirdparty'];

		$add_doc_detail = [];

		$vat_value = 0;
		$tax_value = 0;

		if($args['totalvat'] && $tax)
		{
			$add_doc_detail[] =
			[
				'tax_document_id' => $tax_document_id,
				'assistant_id'    => a($load_coding_detail, $tax, 'parent3'),
				'details_id'      => $tax,
				'type'            => 'debtor',
				'value'           => $tax_value = round((($args['total'] - $args['totalvat']) * 0.06)),
				'sort'            => 2,
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
				'value'           => $vat_value = round((($args['total'] - $args['totalvat']) * 0.03)),
				'sort'            => 3,
				'template'        => 'vat',
			];
		}

		$add_doc_detail[] =
		[
			'tax_document_id' => $tax_document_id,
			'assistant_id'    => a($load_coding_detail, $put_on, 'parent3'),
			'details_id'      => $put_on,
			'type'            => 'debtor',
			'value'           => $args['total'] - $vat_value - $tax_value,
			'sort'            => 1,
			'template'        => 'put_on',
		];

		$add_doc_detail[] =
		[
			'tax_document_id' => $tax_document_id,
			'assistant_id'    => a($load_coding_detail, $thirdparty, 'parent3'),
			'details_id'      => $thirdparty,
			'type'            => 'creditor',
			'value'           => $args['total'],
			'sort'            => 4,
			'template'            => 'thirdparty',
		];

		$add_doc_detail[] =
		[
			'tax_document_id' => $tax_document_id,
			'assistant_id'    => a($load_coding_detail, $thirdparty, 'parent3'),
			'details_id'      => $thirdparty,
			'type'            => 'debtor',
			'value'           => $args['total'],
			'sort'            => 5,
			'template'        => 'thirdparty',
		];


		$add_doc_detail[] =
		[
			'tax_document_id' => $tax_document_id,
			'assistant_id'    => a($load_coding_detail, $pay_from, 'parent3'),
			'details_id'      => $pay_from,
			'type'            => 'creditor',
			'value'           => $args['total'],
			'sort'            => 6,
			'template'        => 'pay_from',
		];


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