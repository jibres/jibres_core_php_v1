<?php
namespace lib\app\form\item;


class check
{
	public static function variable($_args)
	{
		$condition =
		[
			'title'   => 'title',
			'desc'    => 'desc',
			'type'    => ['enum' => ['text', 'textarea']],
			'status'  => ['enum' => ['draft','publish','expire','deleted','lock','awaiting','block','filter','close','full']],
			'require' => 'bit',
			'maxlen'  => 'smallint',

		];


		$require = ['title', 'type'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		return $data;
	}
}
?>