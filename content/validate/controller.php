<?php
namespace content\validate;


class controller
{
	public static function routing()
	{
		$condition =
		[
			'displayname' => 'string_-1',
			'displayname' => 'string_0',
			'displayname' => 'string_9999999999999999999999999999999999999999999999999999999999999999',
			'displayname' => 'string_9999999999999999999999999999',
			'displayname' => 'string_1',
			'displayname' => 'string_[]',
			'displayname' => 'string_....',
			'displayname' => 'string',
			'displayname' => 'address',
			'displayname' => 'title',
			'username' => 'username',
			'number'      => 'number',
			'price'      => 'price',
			'mobile'      => 'mobile',

			// 'password'    => 'password',
			// 'newpassword' => 'password',

		];

		$args =
		[

			'displayname' => '',
			'displayname' => null,
			'displayname' => function(){},
			'displayname' => [],
			'displayname' => false,
			'displayname' => true,
			'displayname' => 0,
			'displayname' => 1.654564560,
			'displayname' => '44444444444444444444444444456464646464654444444444',
			'displayname' => 'salam',
			'displayname' => 'salam\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\',
			'displayname' => ' <section id=\'jibresPageTitle\'><div class="typing"><span class="typed"></span></div>
    <div id="typed-strings">
     <h3>Invoice Software</h3>
     <h4>Easy Invoicing Software</h4>
     <h3>Online Invoicing Software</h3>
     <h2>Free Invoicing Software</h2>
     <h3>Accounting Software</h3>
     <h2>Online Accounting Software</h2>
     <h3>Sales</h3>
     <h3>Sales Software</h3>
     <h4>Integrated Sales</h4>
     <h2 c',
			'displayname' => 'salam',
			'displayname' => '\'\"\;\/\.salam',
			'displayname' => 'salam',
			'username' => 'AAAAFFFBBBdd--__--_-_-X__',
			'username' => 'biqarar',
			'number' => 'ff',
			'number' => "42",
			'number' => 1337,
			'number' => 0x539,
			'number' => 02471,
			'number' => 0b10100111001,
			'number' => 1337e10,
			'number' => "0x539",
			'number' => "02471",
			'number' => "0b10100111001",
			'number' => "1337e0",
			'number' => "not numeric",
			'number' => array(),
			'number' => function(){},
			'number' => 9.1,
			'number' => '9.1.2',
			'number' => null,
			'number' => "1337e0",
			'number' => gmp_strval('9999999999999999999'),
			'number' => '141312',
			'price' => 999999999999,
			'mobile' => '',

			// 'mobile'      => \dash\request::post('mobile'),
			// 'password'    => \dash\request::post('password'),
			// 'newpassword' => \dash\request::post('ramzNew'),
			// 'mobile' => function() {},
		];

		$require = []; // [[],null, false, '', 0, function(){}, 'dmobile', 'displayname', 'newpassword'];

		$meta =
		[
			'field_title' => ['displayname' => 'myDisplyNmae'],
		];
		$data = \dash\cleanse::input($args, $condition, $require, $meta);
		j($data);
	}
}
?>