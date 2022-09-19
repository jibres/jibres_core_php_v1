<?php
namespace lib\app\form\form;


class dashboard
{

	public static function detail($_form_id)
	{
		$result = [];

		self::answerItem($result, $_form_id);
		self::answerCount($result, $_form_id);
		self::totalPayed($result, $_form_id);
		self::makeDuplicate($result, $_form_id);

		return $result;
	}


	private static function answerItem(&$result, $_form_id)
	{
		$answerCount = \lib\db\form_item\get::count_all($_form_id);
		$result[]    =
			[
				'title'     => T_("Item count"),
				'value'     => \dash\fit::number($answerCount) . ' <small class="text-gray-400">' . T_("Item") . '</small>',
				'link'      => true,
				'url'       => \dash\url::kingdom() . '/a/form/edit?id=' . $_form_id,
				'linkTitle' => T_("Edit"),
			];

	}


	private static function answerCount(&$result, $_form_id)
	{
		$answerCount = \lib\db\form_answer\get::count_all($_form_id);
		$result[]    =
			[
				'title'     => T_("Total answer"),
				'value'     => \dash\fit::number($answerCount) . ' <small class="text-gray-400">' . T_("Answer") . '</small>',
				'link'      => true,
				'url'       => \dash\url::kingdom() . '/a/form/answer?id=' . $_form_id,
				'linkTitle' => T_("show answers"),
			];

	}


	private static function makeDuplicate(&$result, $_form_id)
	{
		$result[] =
			[
				'title'     => T_("Make a copy of this form"),
				'value'     => null,
				'link'      => true,
				'url'       => \dash\url::kingdom() . '/a/form/duplicate?id=' . $_form_id,
				'linkTitle' => T_("Duplicate"),
			];

	}


	private static function totalPayed(&$result, $_form_id)
	{
		$haveTransactionId = \lib\db\form_answer\get::haveTransactionId($_form_id);
		if(!$haveTransactionId)
		{
			return null;
		}

		$totalPayedVerify   = \lib\db\form_answer\get::totalPayed($_form_id, true);
		$totalPayedUnverify = \lib\db\form_answer\get::totalPayed($_form_id, false);

		$result[] =
			[
				'title'     => T_("Total payed by this form"),
				'value'     => \dash\fit::number(a($totalPayedVerify, 'totalPayed')) . ' <small class="text-gray-400">' . \lib\store::currency() . '</small>',
				'value2'    => '<small class="text-gray-400">' . T_("In") . ' </small> ' . \dash\fit::number(a($totalPayedVerify, 'count')) . ' <small class="text-gray-400">' . T_("Transaction") . '</small>',
				'link'      => true,
				'url'       => \dash\url::kingdom() . '/crm/transactions?verify=y&form_id=' . $_form_id,
				'linkTitle' => T_("Show transaction list"),
			];


		$result[] =
			[
				'title'     => T_("Total unverify payed by this form"),
				'value'     => \dash\fit::number(a($totalPayedUnverify, 'totalPayed')) . ' <small class="text-gray-400">' . \lib\store::currency() . '</small>',
				'value2'    => '<small class="text-gray-400">' . T_("In") . ' </small> ' . \dash\fit::number(a($totalPayedUnverify, 'count')) . ' <small class="text-gray-400">' . T_("Transaction") . '</small>',
				'link'      => true,
				'url'       => \dash\url::kingdom() . '/crm/transactions?verify=n&form_id=' . $_form_id,
				'linkTitle' => T_("Show transaction list"),
			];

	}


}
