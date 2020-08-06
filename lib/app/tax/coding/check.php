<?php
namespace lib\app\tax\coding;


class check
{

	public static function variable($_args)
	{
		$condition =
		[
			'title'      => 'string_200',
			'detailable' => 'bit',
			'code'       => 'int',
			'parent1'    => 'int',
			'parent2'    => 'int',
			'parent3'    => 'int',
			'status'     => ['enum' => ['enable','disable', 'deleted']],
			'nature'     => ['enum' => ['debtor','creditor','debtor-creditor','balance sheet','disciplinary','harmful profit']],
			'type'       => ['enum' => ['group','total','assistant','details']],
		];

		$require = ['title', 'code'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		return $data;

	}

}
?>