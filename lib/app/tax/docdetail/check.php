<?php
namespace lib\app\tax\docdetail;


class check
{

	public static function variable($_args)
	{
		$condition =
		[
			'tax_document_id' => 'int',
			'assistant_id'    => 'int',
			'details_id'      => 'int',
			'desc'            => 'string_300',
			'debtor'          => 'bigint',
			'creditor'        => 'bigint',
		];

		$require = ['tax_document_id', 'assistant_id', 'details_id'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		return $data;

	}

}
?>