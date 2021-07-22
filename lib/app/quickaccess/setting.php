<?php
namespace lib\app\quickaccess;


class setting
{
	/**
	 * Load all setting links
	 */
	public static function list()
	{
		$list = [];

		self::general_setting($list);

		self::cms_setting($list);

		self::s3_setting($list);

		self::livechat_setting($list);

		self::bank_payment($list);

		self::certification($list);

		self::product_setting($list);

		self::order_setting($list);

		self::accounting_setting($list);

		return $list;
	}



	/**
	 * Thirdparty setting
	 *
	 * @param      <type>  $list   The list
	 */
	private static function s3_setting(&$list)
	{
		$list[] =
		[
			'title'    => T_("Google Analytics"),
			'keywords' => [T_("Google Analytics"), T_("Google"), T_("Analytics"), T_("Statistics"), 'Google Analytics', 'statistics'],
			'url'      => \dash\url::kingdom(). '/a/setting/thirdparty/gtag',
			'addr'     => [T_("Setting"), T_("Third Party Services"), T_("Google Analytics") ],
			'img'      => \dash\url::cdn(). '/img/thirdparty/google_analytics.svg',
		];

		$list[] =
		[
			'title'    => T_("Amazon S3"),
			'keywords' => [T_("amazon"), T_("storage"), 'asw', "amazon", "file"],
			'url'      => \dash\url::kingdom(). '/a/setting/thirdparty/awss3',
			'addr'     => [T_("Setting"), T_("Third Party Services"), T_("Amazon S3") ],
			'img'      => \dash\url::cdn(). '/img/thirdparty/aws.svg',
		];

		$list[] =
		[
			'title'    => T_("DigitalOcean S3"),
			'keywords' => [T_("digitalOcean"), T_("Storage"), 's3', "digitalocean", "file"],
			'url'      => \dash\url::kingdom(). '/a/setting/thirdparty/digitaloceans3',
			'addr'     => [T_("Setting"), T_("Third Party Services"), T_("DigitalOcean S3") ],
			'img'      => \dash\url::cdn(). '/img/thirdparty/digitalocean.svg',
		];

		$list[] =
		[
			'title'    => T_("ArvanCloud S3"),
			'keywords' => [T_("arvan"), T_("arvancloud"), T_("storage"), 'arvan', "arvancloud", "arvan cloud", "file"],
			'url'      => \dash\url::kingdom(). '/a/setting/thirdparty/arvanclouds3',
			'addr'     => [T_("Setting"), T_("Third Party Services"), T_("ArvanCloud S3") ],
			'img'      => \dash\url::cdn(). '/img/thirdparty/arvancloud.svg',
		];
	}


		/**
	 * Thirdparty setting
	 *
	 * @param      <type>  $list   The list
	 */
	private static function livechat_setting(&$list)
	{
		$list[] =
		[
			'title'    => T_("Tawk.to"),
			'keywords' => [T_("chat"), T_("live chat"), 'chat', 'live'],
			'url'      => \dash\url::kingdom(). '/a/setting/thirdparty/tawk',
			'addr'     => [T_("Setting"), T_("Third Party Services"), T_("Tawk.to") ],
			'img'      => \dash\url::cdn(). '/img/thirdparty/tawk.png',
		];

		$list[] =
		[
			'title'    => T_("Imber"),

			'keywords' => [T_("chat"), T_("live chat"), 'chat', 'live'],
			'url'      => \dash\url::kingdom(). '/a/setting/thirdparty/imber',
			'addr'     => [T_("Setting"), T_("Third Party Services"), T_("Imber") ],
			'img'      => \dash\url::cdn(). '/img/thirdparty/imber.png',
		];

		$list[] =
		[
			'title'    => T_("Raychat"),
			'keywords' => [T_("chat"), T_("live chat"), 'chat', 'live'],
			'url'      => \dash\url::kingdom(). '/a/setting/thirdparty/raychat',
			'addr'     => [T_("Setting"), T_("Third Party Services"), T_("Raychat") ],
			'img'      => \dash\url::cdn(). '/img/thirdparty/raychat.jpg',
		];

	}


	/**
	 * Thirdparty setting
	 *
	 * @param      <type>  $list   The list
	 */
	private static function bank_payment(&$list)
	{
		$list[] =
		[
			'title'    => T_("Mellat"),
			'keywords' => [T_("bank"), T_("payment"), T_("pay"), T_("gateway"), T_("online payment"), 'bank', 'payment'],
			'url'      => \dash\url::kingdom(). '/a/setting/thirdparty/irmellat',
			'addr'     => [T_("Setting"), T_("Third Party Services"), T_("Mellat") ],
			'img'      => \dash\url::cdn(). '/img/thirdparty/bank/mellat-logo.svg',
		];

		$list[] =
		[
			'title'    => T_("IranKish"),
			'keywords' => [T_("bank"), T_("payment"), T_("pay"), T_("gateway"), T_("online payment"), 'bank', 'payment'],
			'url'      => \dash\url::kingdom(). '/a/setting/thirdparty/irirkish',
			'addr'     => [T_("Setting"), T_("Third Party Services"), T_("IranKish") ],
			'img'      => \dash\url::cdn(). '/img/thirdparty/bank/irkish.jpg',
		];

			$list[] =
		[
			'title'    => T_("Parsian"),
			'keywords' => [T_("bank"), T_("payment"), T_("pay"), T_("gateway"), T_("online payment"), 'bank', 'payment'],
			'url'      => \dash\url::kingdom(). '/a/setting/thirdparty/irparsian',
			'addr'     => [T_("Setting"), T_("Third Party Services"), T_("Parsian") ],
			'img'      => \dash\url::cdn(). '/img/thirdparty/bank/parsian.png',
		];

		$list[] =
		[
			'title'    => T_("Zarinpal"),
			'keywords' => [T_("bank"), T_("payment"), T_("pay"), T_("gateway"), T_("online payment"), 'bank', 'payment'],
			'url'      => \dash\url::kingdom(). '/a/setting/thirdparty/irzarinpal',
			'addr'     => [T_("Setting"), T_("Third Party Services"), T_("Zarinpal") ],
			'img'      => \dash\url::cdn(). '/img/thirdparty/bank/zarinpal-icon.svg',
		];

		$list[] =
		[
			'title'    => T_("Asanpardakht"),
			'keywords' => [T_("bank"), T_("payment"), T_("pay"), T_("gateway"), T_("online payment"), 'bank', 'payment'],
			'url'      => \dash\url::kingdom(). '/a/setting/thirdparty/irasanpardakht',
			'addr'     => [T_("Setting"), T_("Third Party Services"), T_("Asanpardakht") ],
			'img'      => \dash\url::cdn(). '/img/thirdparty/bank/asanpardasht-logo.svg',
		];

		$list[] =
		[
			'title'    => T_("IDPay"),
			'keywords' => [T_("bank"), T_("payment"), T_("pay"), T_("gateway"), T_("online payment"), 'bank', 'payment'],
			'url'      => \dash\url::kingdom(). '/a/setting/thirdparty/iridpay',
			'addr'     => [T_("Setting"), T_("Third Party Services"), T_("IDPay") ],
			'img'      => \dash\url::cdn(). '/img/thirdparty/bank/idpay-icon.png',
		];


		$list[] =
		[
			'title'    => T_("Payir"),
			'keywords' => [T_("bank"), T_("payment"), T_("pay"), T_("gateway"), T_("online payment"), 'bank', 'payment'],
			'url'      => \dash\url::kingdom(). '/a/setting/thirdparty/irpayir',
			'addr'     => [T_("Setting"), T_("Third Party Services"), T_("Payir") ],
			'img'      => \dash\url::cdn(). '/img/thirdparty/bank/payir.png',
		];



	}


	/**
	 * Thirdparty setting
	 *
	 * @param      <type>  $list   The list
	 */
	private static function certification(&$list)
	{
		$list[] =
		[
			'title'    => T_("Enamad"),
			'keywords' => [T_("Enamad"), T_("certification"), 'enamad'],
			'url'      => \dash\url::kingdom(). '/a/setting/thirdparty/enamad',
			'addr'     => [T_("Setting"), T_("Third Party Services"), T_("Enamad") ],
			'img'      => \dash\url::cdn(). '/img/thirdparty/enamad.jpg',
		];

		$list[] =
		[
			'title'    => T_("Samandehi"),
			'keywords' => [T_("Samandehi"), T_("certification"), 'samandehi'],
			'url'      => \dash\url::kingdom(). '/a/setting/thirdparty/samandehi',
			'addr'     => [T_("Setting"), T_("Third Party Services"), T_("Samandehi") ],
			'img'      => \dash\url::cdn(). '/img/thirdparty/samandehi.jpg',
		];

	}



	/**
	 * The CMS setting
	 *
	 * @param      <type>  $list   The list
	 */
	private static function cms_setting(&$list)
	{



		$list[] =
		[
			'title'    => T_("Sitemap"),
			'keywords' => [T_("site"), T_("site map"), T_("sitemap"), 'sitemap', T_("map"), 'map'],
			'url'      => \dash\url::kingdom(). '/cms/sitemap',
			'addr'     => [T_("Content Management System"), T_("SEO") ],
			'icon'     => 'sitemap',
		];

		$list[] =
		[
			'title'    => T_("Config"),
			'keywords' => [T_("setting"), T_("config"), T_("ratio"), 'image', T_("image ratio")],
			'url'      => \dash\url::kingdom(). '/cms/config',
		];

	}



	/**
	 * The Order setting
	 *
	 * @param      <type>  $list   The list
	 */
	private static function order_setting(&$list)
	{



		$list[] =
		[
			'title'    => T_("Minimum order amount"),
			'keywords' => [T_("order"), T_("minimum"), T_("amount")],
			'url'      => \dash\url::kingdom(). '/a/setting/order/minimum',
			'addr'     => [T_("Setting"), T_("Order setting"), T_("Minimum order amount") ],
			'icon'     => 'info',
		];

		// need to complete order setting
		// @todo @reza

	}


	/**
	 * General setting
	 *
	 * @param      <type>  $list   The list
	 */
	private static function general_setting(&$list)
	{
		$list[] =
		[
			'title'    => T_("Business title"),
			'keywords' =>
			[
				T_("title"),
				T_("name"),
				T_("caption"),
				T_("site title"),
				T_("business title"),
				T_("business description"),
				T_("description"),
				T_("information"),
				T_("information"),
				'title',
				'information',
				'description',
				'information',
			],
			'url'      => \dash\url::kingdom(). '/a/setting/general/title',
			'addr'     => [T_("Setting"), T_("General"), T_("Edit title") ],
			'icon'     => 'cogs',
		];

		$list[] =
		[
			'title'    => T_("Business logo"),
			'keywords' =>
			[
				T_("logo"),
				T_("site logo"),
				T_("business logo"),
				T_("store logo"),
			],
			'url'      => \dash\url::kingdom(). '/a/setting/general#setting-busienss-logo',
			'addr'     => [T_("Setting"), T_("General") ],
			'icon'     => 'cogs',
		];


		$list[] =
		[
			'title'    => T_("Business Currency"),
			'keywords' =>
			[
				T_("unit"),
				T_("currency"),
				T_("money"),
				'currency',
				'money',
			],
			'url'      => \dash\url::kingdom(). '/a/setting/general#setting-busienss-currency',
			'addr'     => [T_("Setting"), T_("General") ],
			'icon'     => 'money-banknote',
		];


		$mass_list = \lib\units::mass();
		$keyword = array_merge(array_keys($mass_list), array_column($mass_list, 'name'),[T_("weight"),'weight', T_("unit"), T_("mass")]);
		$list[] =
		[
			'title'    => T_("Weight unit"),
			'keywords' => $keyword,
			'url'      => \dash\url::kingdom(). '/a/setting/general#setting-busienss-weight',
			'addr'     => [T_("Setting"), T_("General") ],
			'icon'     => 'tachometer',
		];

		$length_list = \lib\units::length();
		$keyword = array_merge(array_keys($length_list), array_column($length_list, 'name'),[T_("length"),'length', T_("unit")]);
		$list[] =
		[
			'title'    => T_("Length unit"),
			'keywords' => $keyword,
			'url'      => \dash\url::kingdom(). '/a/setting/general#setting-busienss-length',
			'addr'     => [T_("Setting"), T_("General") ],
			'icon'     => 'expand',
		];

		$lang_list = \dash\language::all();
		$keyword = array_merge(array_keys($lang_list), array_column($lang_list, 'localname'),[T_("language"),'language', T_("unit")]);
		$list[] =
		[
			'title'    => T_("Business language"),
			'keywords' => $keyword,
			'url'      => \dash\url::kingdom(). '/a/setting/general#setting-busienss-lang',
			'addr'     => [T_("Setting"), T_("General") ],
			'icon'     => 'language',
		];



		$list[] =
		[
			'title'    => T_("Business allow sell"),
			'keywords' =>
			[
				T_("sell"),
				T_("allow sell"),
				T_("lock sell"),
			],
			'url'      => \dash\url::kingdom(). '/a/setting/general#setting-busienss-nosale',
			'addr'     => [T_("Setting"), T_("General") ],
			'icon'     => 'lock',
		];


		$list[] =
		[
			'title'    => T_("Allow enter customer to business"),
			'keywords' =>
			[
				T_("enter"),
				T_("login"),
			],
			'url'      => \dash\url::kingdom(). '/a/setting/general#setting-busienss-allow-enter',
			'addr'     => [T_("Setting"), T_("General") ],
			'icon'     => 'enter',
		];


		$list[] =
		[
			'title'    => T_("Remove business"),
			'keywords' =>
			[
				T_("remove"),
				T_("delete"),
			],
			'url'      => \dash\url::kingdom(). '/a/setting/general#setting-busienss-remove',
			'addr'     => [T_("Setting"), T_("General") ],
			'icon'     => 'trash',
		];


		$list[] =
		[
			'title'    => T_("Business address"),
			'keywords' =>
			[
				T_("address"),
				T_("location"),
				T_("map"),
				T_("country"),
				T_("province"),
				T_("city"),
				T_("phone"),
				T_("postal code"),
				T_("postcode"),
			],
			'url'      => \dash\url::kingdom(). '/a/setting/general/address',
			'addr'     => [T_("Setting"), T_("General"), T_("Address")],
			'icon'     => 'map-marker',
		];
	}




	/**
	 * General setting
	 *
	 * @param      <type>  $list   The list
	 */
	private static function product_setting(&$list)
	{
		$list[] =
		[
			'title'    => T_("Product list"),
			'keywords' =>
			[
				T_("products"),
				T_("product"),
				T_("list"),
			],
			'url'      => \dash\url::kingdom(). '/a/products',
			'addr'     => [T_("Dashboard"), T_("Products"),],
			'icon'     => 'tags',
		];

		$list[] =
		[
			'title'    => T_("Add new product"),
			'keywords' =>
			[
				T_("products"),
				T_("product"),
				T_("add"),
				T_("new"),
			],
			'url'      => \dash\url::kingdom(). '/a/products/add',
			'addr'     => [T_("Dashboard"), T_("Products"), T_("Add new product")],
			'icon'     => 'plus-circle',
		];

		$list[] =
		[
			'title'    => T_("Product tag"),
			'keywords' =>
			[
				T_("tag"),
				T_("products tag"),
				T_("category"),
			],
			'url'      => \dash\url::kingdom(). '/a/tag',
			'addr'     => [T_("Setting"), T_("Products"), T_("Tag"),],
			'icon'     => 'tag',
		];

		$list[] =
		[
			'title'    => T_("Manage and sort tags"),
			'keywords' =>
			[
				T_("tag"),
				T_("products tag"),
				T_("sort tag"),
				T_("category"),
			],
			'url'      => \dash\url::kingdom(). '/a/tag/sort',
			'addr'     => [T_("Setting"), T_("Products"), T_("Tag"), T_("Advance")],
			'icon'     => 'tag',
		];


		$list[] =
		[
			'title'    => T_("Add new tag"),
			'keywords' =>
			[
				T_("tag"),
				T_("add"),
				T_("new"),
				T_("products tag"),
				T_("sort tag"),
				T_("category"),
			],
			'url'      => \dash\url::kingdom(). '/a/tag/add',
			'addr'     => [T_("Setting"), T_("Products"), T_("Tag"), T_("Add new tag")],
			'icon'     => 'plus-circle',
		];


		$list[] =
		[
			'title'    => T_("Add tag to all prodcut"),
			'keywords' =>
			[
				T_("tag"),
				T_("add"),
				T_("all"),
			],
			'url'      => \dash\url::kingdom(). '/a/setting/product/tag',
			'addr'     => [T_("Setting"), T_("Products"), T_("Tag"), T_("Add tag to all prodcut")],
			'icon'     => 'plus-circle',
		];


		$list[] =
		[
			'title'    => T_("Product units"),
			'keywords' =>
			[
				T_("unit"),
			],
			'url'      => \dash\url::kingdom(). '/a/unit',
			'addr'     => [T_("Setting"), T_("Products"), T_("Product Units")],
			'icon'     => 'grid',
		];


		$list[] =
		[
			'title'    => T_("Import products"),
			'keywords' =>
			[
				T_("import"),
				T_("csv"),
				T_('data'),
				'csv',
				'excel',
				'xls',
				'xlsx',

			],
			'url'      => \dash\url::kingdom(). '/a/products/import',
			'addr'     => [T_("Setting"), T_("Products"), T_("Import")],
			'icon'     => 'in',
		];

		$list[] =
		[
			'title'    => T_("Export products"),
			'keywords' =>
			[
				T_("export"),
				T_("csv"),
				T_("all"),
				T_('data'),
				'csv',
				'excel',
				'xls',
				'xlsx',

			],
			'url'      => \dash\url::kingdom(). '/a/products/export',
			'addr'     => [T_("Setting"), T_("Products"), T_("Export")],
			'icon'     => 'out',
		];


		$list[] =
		[
			'title'    => T_("Product comments setting"),
			'keywords' =>
			[
				T_("comments"),
				T_("comment"),
			],
			'url'      => \dash\url::kingdom(). '/a/setting/product#setting-product-comment',
			'addr'     => [T_("Setting"), T_("Products"),],
			'icon'     => 'comments-o',
		];

		$list[] =
		[
			'title'    => T_("Product page text"),
			'keywords' =>
			[
				T_("text"),
				T_("view text"),
				T_("design"),
			],
			'url'      => \dash\url::kingdom(). '/a/setting/product/viewtext',
			'addr'     => [T_("Setting"), T_("Products"), T_("Product View Text")],
			'icon'     => 'monitor',
		];

		$list[] =
		[
			'title'    => T_("Product image ratio"),
			'keywords' =>
			[
				T_("image"),
				T_("ratio"),
				T_("gallery"),
				T_("picture"),
			],
			'url'      => \dash\url::kingdom(). '/a/setting/product#setting-product-image-ratio',
			'addr'     => [T_("Setting"), T_("Products"),],
			'icon'     => 'arrows-alt',
		];

		$list[] =
		[
			'title'    => T_("Product preparation time"),
			'keywords' =>
			[
				T_("time"),
				T_("preparation"),
				T_("products preparation  time"),
			],
			'url'      => \dash\url::kingdom(). '/a/setting/product/preparationtime',
			'addr'     => [T_("Setting"), T_("Products"), T_("Preparation time")],
			'icon'     => 'cogs',
		];



	}


	/**
	 * accounting setting
	 *
	 * @param      <type>  $list   The list
	 */
	private static function accounting_setting(&$list)
	{
		$list[] =
		[
			'title'    => T_("Cloud Accounting"),
			'keywords' =>
			[
				T_("accounting"),
				T_("tax"),
				T_("vat"),
				T_('document'),
			],
			'url'      => \dash\url::kingdom(). '/a/accounting',
			'addr'     => [T_("Dashboard"), T_("Accounting"),],
			'icon'     => 'book',
		];
	}
}
?>