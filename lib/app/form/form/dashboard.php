<?php
namespace lib\app\form\form;


class dashboard
{

	public static function detail($_form_id)
	{
		$result = [];

		$result[] = self::answerItem($_form_id);
		$result[] = self::answerCount($_form_id);
		$result[] = self::totalPayed($_form_id);
		$result[] = self::makeDuplicate($_form_id);

		$result = array_filter($result);

		return $result;
	}


	private static function answerItem($_form_id)
	{
		$answerCount = \lib\db\form_item\get::count_all($_form_id);
		$result      =
			[
				'title'     => T_("Item count"),
				'value'     => \dash\fit::number($answerCount) . ' <small class="text-gray-400">' . T_("Item") . '</small>',
				'link'      => true,
				'url'       => \dash\url::kingdom() . '/a/form/edit?id=' . $_form_id,
				'linkTitle' => T_("Edit"),
			];
		return $result;
	}


	private static function answerCount($_form_id)
	{
		$answerCount = \lib\db\form_answer\get::count_all($_form_id);
		$result      =
			[
				'title'     => T_("Total answer"),
				'value'     => \dash\fit::number($answerCount) . ' <small class="text-gray-400">' . T_("Answer") . '</small>',
				'link'      => true,
				'url'       => \dash\url::kingdom() . '/a/form/answer?id=' . $_form_id,
				'linkTitle' => T_("show answers"),
			];
		return $result;
	}


	private static function makeDuplicate($_form_id)
	{
		$result =
			[
				'title'     => T_("Make a copy of this form"),
				'value'     => null,
				'link'      => true,
				'url'       => \dash\url::kingdom() . '/a/form/duplicate?id=' . $_form_id,
				'linkTitle' => T_("Duplicate"),
			];
		return $result;
	}


	private static function totalPayed($_form_id)
	{
		$haveTransactionId = \lib\db\form_answer\get::haveTransactionId($_form_id);
		if(!$haveTransactionId)
		{
			return null;
		}

		$totalPayed = \lib\db\form_answer\get::totalPayed($_form_id);

		$result      =
			[
				'title'     => T_("Total payed by this form"),
				'value'     => \dash\fit::number($totalPayed) . ' <small class="text-gray-400">' .\lib\store::currency() . '</small>',
				'link'      => true,
				'url'       => \dash\url::kingdom() . '/crm/transactions?verify=y&form_id=' . $_form_id,
				'linkTitle' => T_("Show transaction list"),
			];
		return $result;
	}


}
