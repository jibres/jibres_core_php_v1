<?php
namespace content\validate;


class controller
{
	public static function routing()
	{
		$condition =
		[
			'buyprice'        => 'price',
			'price'           => 'price',
			'compareatprice'  => 'price',
			'discount'        => 'price',
			'discountpercent' => 'percent',
			'finalprice'      => 'price',
			'vatprice'        => 'price',

			'title'           => 'title',
			'slug'            => 'slug',
			'barcode'         => 'barcode',
			'barcode2'        => 'barcode',
			'minstock'        => 'number-positive',
			'maxstock'        => 'number-positive',
			'optionname1'     => 'string_50',
			'optionvalue1'    => 'string_50',
			'optionname2'     => 'string_50',
			'optionvalue2'    => 'string_50',
			'optionname3'     => 'string_50',
			'optionvalue3'    => 'string_50',
			'weight'          => 'number-positive',
			'status'          => ['enum' => ['unset','available','unavailable','soon','discountinued', 'deleted']],
			'vat'             => ['bool' => [true, false]],
			'saleonline'      => ['bool' => ['yes', null]],
			'carton'          => 'number-positive',
			'desc'            => 'desc',
			'saletelegram'    => ['bool' => ['yes', null]],
			'saleapp'         => ['bool' => ['yes', null]],
			'infinite'        => ['bool' => ['yes', null]],
			'parent'          => 'number',
			'scalecode'       => 'price',
			'sku'             => 'sku',
			'seotitle'        => 'seotitle',
			'seodesc'         => 'seodesc',
			'salestep'        => 'number-positive',
			'minsale'         => 'number-positive',
			'maxsale'         => 'number-positive',
			'type'            => ['enum' => ['product','file','service']],
			'oversale'        => ['bool' => ['yes', null]],
			'length'          => 'number-positive',
			'width'           => 'number-positive',
			'height'          => 'number-positive',
			'filesize'        => 'number-positive',
			'fileaddress'     => 'url',
			'nationalcode'    => 'nationalcode',

		];

		$args =
		[
			'buyprice'        => 999999999999,
			'price'           => 999999999999,
			'compareatprice'  => 999999999999,
			'discount'        => 999999999999,
			'discountpercent' => '100',
			'finalprice'      => 999999999999,
			'vatprice'        => 999999999999,

			'title'           => 'title',
			'slug'            => 'slug',
			'barcode'         => 'barcode',
			'barcode2'        => 'barcode',
			'minstock'        => '1E+5',
			'maxstock'        => '1E+5',
			'optionname1'     => 'string_50',
			'optionvalue1'    => 'string_50',
			'optionname2'     => 'string_50',
			'optionvalue2'    => 'string_50',
			'optionname3'     => 'string_50',
			'optionvalue3'    => 'string_50',
			'weight'          => '1E+5',
			'status'          => 'available',
			'vat'             => 1,
			'saleonline'      => 0,
			'carton'          => '1E+5',
			'desc'            => 'desc',
			'saletelegram'    => true,
			'saleapp'         => false,
			'infinite'        => null,
			'parent'          => null,
			'scalecode'       => 999999999999,
			'sku'             => '',
			'seotitle'        => 'seotitle',
			'seodesc'         => 'seodesc',
			'salestep'        => '1E+5',
			'minsale'         => '1E+5',
			'maxsale'         => '1E+5',
			'type'            => 'file',
			'oversale'        => 'ssss',
			'length'          => '1E+5',
			'width'           => '1E+5',
			'height'          => '1E+5',
			'filesize'        => '1E+5',
			'fileaddress'     => 'https://jibres.com',
			'nationalcode'    => '4440032109',

		];


		$require = []; // [[],null, false, '', 0, function(){}, 'dmobile', 'displayname', 'newpassword'];
		// $meta
		$data = \dash\cleanse::input($args, $condition);
		\dash\notif::api($data);

	}

	public static function routing_old()
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
			'price'      => 999999999999,
			'mobile'      => 'mobile',

			'password'    => 'password',
			'html'    => 'html',
			'type'    => ['enum' => ['product', 'fa', 1]],
			'order' => 'order',
			// 'sale' => [ 'product' => 'string_50', 'count' => 'number', 'discount' => 'number','x' => ['enum' => '1', 12] ],
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

     <b>Invoice Software</b>
     <h4>Easy Invoicing Software</h4>
     <b>Online Invoicing Software</b>
     <h2>Free Invoicing Software</h2>
     <b>Accounting Software</b>
     <h2>Online Accounting Software</h2>
     <b>Sales</b>
     <b>Sales Software</b>
     <h4>Integrated Sales</h4>',
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
			'password' => '4545454545456',
			'html' => ' <section id=\'jibresPageTitle\'><div class="typing"><span class="typed"></span></div>
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

     		'type' => 'product',
     		'order' => 'asc',
     		// 'sale' => [['product' => 'string_50', 'count' => '12', 'discount' => '18', 'x' => 1], ['product' => 'string_50', 'count' => '12x', 'discount' => '18', 'x' => 1]],
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
		\dash\notif::api($data);
	}
}
?>