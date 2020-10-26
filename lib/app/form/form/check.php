<?php
namespace lib\app\form\form;


class check
{
	public static function variable($_args)
	{
		$condition =
		[
			'title'        => 'title',
			'slug'         => 'slug',
			'lang'         => 'lang',
			'password'     => 'string_100',
			'privacy'      => ['enum' => ['public', 'private']],
			'status'       => ['enum' => ['draft','publish','expire','deleted','lock','awaiting','block','filter','close','trash','full']],
			'redirect'     => 'string_1000',
			'desc'         => 'html',
			'endmessage'   => 'desc',
			'starttime'    => 'datetime',
			'endtime'      => 'datetime',
			'file'         => 'string_1000',

			'inquiry_mode' => 'bit',
			'inquiry'      => 'bit',
			'inquirymsg'   => 'html',
			'showcomment'  => 'bit',
			'showpulictag' => 'bit',
			'question'     => 'array',
			'inquiryimage' => 'string_1000',


		];

		$require = ['title', 'status'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		if(!$data['slug'])
		{
			$data['slug'] = \dash\validate::slug($data['title']);
		}


		if($data['inquiry_mode'])
		{
			$data['inquirysetting']                 = [];

			$data['inquirysetting']['showcomment']  = $data['showcomment'];
			$data['inquirysetting']['showpulictag'] = $data['showpulictag'];

			if($data['question'])
			{
				foreach ($data['question'] as $key => $value)
				{
					if(!\dash\validate::id($value))
					{
						return false;
					}
				}

				$data['inquirysetting']['question'] = $data['question'];
			}

			$data['inquirysetting'] = json_encode($data['inquirysetting'], JSON_UNESCAPED_UNICODE);
		}

		unset($data['showpulictag']);
		unset($data['showcomment']);
		unset($data['inquiry_mode']);
		unset($data['question']);

		return $data;
	}
}
?>