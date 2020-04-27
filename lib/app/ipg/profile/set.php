<?php
namespace lib\app\ipg\profile;


class set
{
	public static function user_set($_args)
	{
		$condition =
		[
			'type'                  => ['enum' => ['legal', 'real']],
			'gender'                => ['enum' => ['male', 'real']],
			'firstname'             => 'string_50',
			'firstname_en'          => 'enstring_50',
			'lastname'              => 'string_50',
			'lastname_en'           => 'enstring_50',
			'father'                => 'string_50',
			'father_en'             => 'enstring_50',
			'nationalcode'          => 'nationalcode',
			'birthdate'              => 'birthdate',
			'companyname'           => 'string_50',
			'companyname_en'        => 'enstring_50',
			'companynationalid'     => 'intstring_11_11',
			'companyregisternumber' => 'intstring_10_10',
			'ceonationalcode'       => 'nationalcode',
			'phone'                 => 'phone',
		];


		if(isset($_args['type']) && $_args['type'] === 'legal')
		{
			$require = ['companyname','companyname_en','companynationalid', 'phone'];
		}
		else
		{
			$require = ['firstname_en','lastname_en','father_en','nationalcode','birthdate', 'phone'];
		}

		$meta =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		// var_dump($data);exit();
	}
}
?>