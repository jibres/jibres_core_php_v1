<?php
namespace lib\app\form\form;


class check
{
	public static function variable($_args)
	{
		$condition =
		[
			'title'      => 'title',
			'slug'       => 'slug',
			'lang'       => 'lang',
			'password'   => 'string_100',
			'privacy'    => ['enum' => ['public', 'private']],
			'status'     => ['enum' => ['draft','publish','expire','deleted','lock','awaiting','block','filter','close','trash','full']],
			'redirect'   => 'string_1000',
			'desc'       => 'html',
			'endmessage' => 'desc',
			'starttime'  => 'datetime',
			'endtime'    => 'datetime',
			'file'       => 'string_1000',

		];

		$require = ['title', 'status'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		if(!$data['slug'])
		{
			$data['slug'] = \dash\validate::slug($data['title']);
		}

		return $data;
	}
}
?>