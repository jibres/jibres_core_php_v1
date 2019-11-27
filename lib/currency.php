<?php
namespace lib;

class currency {

	public static function list()
	{
		// CHF have rounding 0.05

		$currency =
		[
			'IRT' 	=> ['symbol' => 'IRT', 	'decimal_digits' => 0, 'code' => 'IRT', 'symbol_native' => 'تومان',	 'name' => 'Iranian Toman'],
			'IRR' 	=> ['symbol' => 'IRR', 	'decimal_digits' => 0, 'code' => 'IRR', 'symbol_native' => '﷼',		 'name' => 'Iranian Rial'],
			'USD' 	=> ['symbol' => '$', 	'decimal_digits' => 2, 'code' => 'USD', 'symbol_native' => '$',		 'name' => 'US Dollar'],
			'EUR' 	=> ['symbol' => '€', 	'decimal_digits' => 2, 'code' => 'EUR', 'symbol_native' => '€',		 'name' => 'Euro'],
			'GBP' 	=> ['symbol' => '£', 	'decimal_digits' => 2, 'code' => 'GBP', 'symbol_native' => '£',		 'name' => 'British Pound Sterling'],
			'JPY' 	=> ['symbol' => '¥', 	'decimal_digits' => 0, 'code' => 'JPY', 'symbol_native' => '￥',		 'name' => 'Japanese Yen'],

			'CAD' 	=> ['symbol' => 'CA$', 	'decimal_digits' => 2, 'code' => 'CAD', 'symbol_native' => '$',		 'name' => 'Canadian Dollar'],
			'AED' 	=> ['symbol' => 'AED', 	'decimal_digits' => 2, 'code' => 'AED', 'symbol_native' => 'د.إ.‏',	 'name' => 'United Arab Emirates Dirham'],
			'AFN' 	=> ['symbol' => 'Af', 	'decimal_digits' => 0, 'code' => 'AFN', 'symbol_native' => '؋',		 'name' => 'Afghan Afghani'],
			'ALL' 	=> ['symbol' => 'ALL', 	'decimal_digits' => 0, 'code' => 'ALL', 'symbol_native' => 'Lek',	 'name' => 'Albanian Lek'],
			'AMD' 	=> ['symbol' => 'AMD', 	'decimal_digits' => 0, 'code' => 'AMD', 'symbol_native' => 'դր.',	 'name' => 'Armenian Dram'],
			'ARS' 	=> ['symbol' => 'AR$', 	'decimal_digits' => 2, 'code' => 'ARS', 'symbol_native' => '$',		 'name' => 'Argentine Peso'],
			'AUD' 	=> ['symbol' => 'AU$', 	'decimal_digits' => 2, 'code' => 'AUD', 'symbol_native' => '$',		 'name' => 'Australian Dollar'],
			'AZN' 	=> ['symbol' => 'man.', 'decimal_digits' => 2, 'code' => 'AZN', 'symbol_native' => 'ман.',	 'name' => 'Azerbaijani Manat'],
			'BAM' 	=> ['symbol' => 'KM', 	'decimal_digits' => 2, 'code' => 'BAM', 'symbol_native' => 'KM',	 'name' => 'Bosnia-Herzegovina Convertible Mark'],
			'BDT' 	=> ['symbol' => 'Tk', 	'decimal_digits' => 2, 'code' => 'BDT', 'symbol_native' => '৳',		 'name' => 'Bangladeshi Taka'],
			'BGN' 	=> ['symbol' => 'BGN', 	'decimal_digits' => 2, 'code' => 'BGN', 'symbol_native' => 'лв.',	 'name' => 'Bulgarian Lev'],
			'BHD' 	=> ['symbol' => 'BD', 	'decimal_digits' => 3, 'code' => 'BHD', 'symbol_native' => 'د.ب.‏',	 'name' => 'Bahraini Dinar'],
			'BIF' 	=> ['symbol' => 'FBu', 	'decimal_digits' => 0, 'code' => 'BIF', 'symbol_native' => 'FBu',	 'name' => 'Burundian Franc'],
			'BND' 	=> ['symbol' => 'BN$', 	'decimal_digits' => 2, 'code' => 'BND', 'symbol_native' => '$',		 'name' => 'Brunei Dollar'],
			'BOB' 	=> ['symbol' => 'Bs', 	'decimal_digits' => 2, 'code' => 'BOB', 'symbol_native' => 'Bs',	 'name' => 'Bolivian Boliviano'],
			'BRL' 	=> ['symbol' => 'R$', 	'decimal_digits' => 2, 'code' => 'BRL', 'symbol_native' => 'R$',	 'name' => 'Brazilian Real'],
			'BWP' 	=> ['symbol' => 'BWP', 	'decimal_digits' => 2, 'code' => 'BWP', 'symbol_native' => 'P',		 'name' => 'Botswanan Pula'],
			'BYR' 	=> ['symbol' => 'BYR', 	'decimal_digits' => 0, 'code' => 'BYR', 'symbol_native' => 'BYR',	 'name' => 'Belarusian Ruble'],
			'BZD' 	=> ['symbol' => 'BZ$', 	'decimal_digits' => 2, 'code' => 'BZD', 'symbol_native' => '$',		 'name' => 'Belize Dollar'],
			'CDF' 	=> ['symbol' => 'CDF', 	'decimal_digits' => 2, 'code' => 'CDF', 'symbol_native' => 'FrCD',	 'name' => 'Congolese Franc'],
			'CHF' 	=> ['symbol' => 'CHF', 	'decimal_digits' => 2, 'code' => 'CHF', 'symbol_native' => 'CHF',	 'name' => 'Swiss Franc'],
			'CLP' 	=> ['symbol' => 'CL$', 	'decimal_digits' => 0, 'code' => 'CLP', 'symbol_native' => '$',		 'name' => 'Chilean Peso'],
			'CNY' 	=> ['symbol' => 'CN¥', 	'decimal_digits' => 2, 'code' => 'CNY', 'symbol_native' => 'CN¥',	 'name' => 'Chinese Yuan'],
			'COP' 	=> ['symbol' => 'CO$', 	'decimal_digits' => 0, 'code' => 'COP', 'symbol_native' => '$',		 'name' => 'Colombian Peso'],
			'CRC' 	=> ['symbol' => '₡', 	'decimal_digits' => 0, 'code' => 'CRC', 'symbol_native' => '₡',		 'name' => 'Costa Rican Colón'],
			'CVE' 	=> ['symbol' => 'CV$', 	'decimal_digits' => 2, 'code' => 'CVE', 'symbol_native' => 'CV$',	 'name' => 'Cape Verdean Escudo'],
			'CZK' 	=> ['symbol' => 'Kč', 	'decimal_digits' => 2, 'code' => 'CZK', 'symbol_native' => 'Kč',	 'name' => 'Czech Republic Koruna'],
			'DJF' 	=> ['symbol' => 'Fdj', 	'decimal_digits' => 0, 'code' => 'DJF', 'symbol_native' => 'Fdj',	 'name' => 'Djiboutian Franc'],
			'DKK' 	=> ['symbol' => 'Dkr', 	'decimal_digits' => 2, 'code' => 'DKK', 'symbol_native' => 'kr',	 'name' => 'Danish Krone'],
			'DOP' 	=> ['symbol' => 'RD$', 	'decimal_digits' => 2, 'code' => 'DOP', 'symbol_native' => 'RD$',	 'name' => 'Dominican Peso'],
			'DZD' 	=> ['symbol' => 'DA', 	'decimal_digits' => 2, 'code' => 'DZD', 'symbol_native' => 'د.ج.‏',	 'name' => 'Algerian Dinar'],
			'EEK' 	=> ['symbol' => 'Ekr', 	'decimal_digits' => 2, 'code' => 'EEK', 'symbol_native' => 'kr',	 'name' => 'Estonian Kroon'],
			'EGP' 	=> ['symbol' => 'EGP', 	'decimal_digits' => 2, 'code' => 'EGP', 'symbol_native' => 'ج.م.‏',	 'name' => 'Egyptian Pound'],
			'ERN' 	=> ['symbol' => 'Nfk', 	'decimal_digits' => 2, 'code' => 'ERN', 'symbol_native' => 'Nfk',	 'name' => 'Eritrean Nakfa'],
			'ETB' 	=> ['symbol' => 'Br', 	'decimal_digits' => 2, 'code' => 'ETB', 'symbol_native' => 'Br',	 'name' => 'Ethiopian Birr'],
			'GEL' 	=> ['symbol' => 'GEL', 	'decimal_digits' => 2, 'code' => 'GEL', 'symbol_native' => 'GEL',	 'name' => 'Georgian Lari'],
			'GHS' 	=> ['symbol' => 'GH₵', 	'decimal_digits' => 2, 'code' => 'GHS', 'symbol_native' => 'GH₵',	 'name' => 'Ghanaian Cedi'],
			'GNF' 	=> ['symbol' => 'FG', 	'decimal_digits' => 0, 'code' => 'GNF', 'symbol_native' => 'FG',	 'name' => 'Guinean Franc'],
			'GTQ' 	=> ['symbol' => 'GTQ', 	'decimal_digits' => 2, 'code' => 'GTQ', 'symbol_native' => 'Q',		 'name' => 'Guatemalan Quetzal'],
			'HKD' 	=> ['symbol' => 'HK$', 	'decimal_digits' => 2, 'code' => 'HKD', 'symbol_native' => '$',		 'name' => 'Hong Kong Dollar'],
			'HNL' 	=> ['symbol' => 'HNL', 	'decimal_digits' => 2, 'code' => 'HNL', 'symbol_native' => 'L',		 'name' => 'Honduran Lempira'],
			'HRK' 	=> ['symbol' => 'kn', 	'decimal_digits' => 2, 'code' => 'HRK', 'symbol_native' => 'kn',	 'name' => 'Croatian Kuna'],
			'HUF' 	=> ['symbol' => 'Ft', 	'decimal_digits' => 0, 'code' => 'HUF', 'symbol_native' => 'Ft',	 'name' => 'Hungarian Forint'],
			'IDR' 	=> ['symbol' => 'Rp', 	'decimal_digits' => 0, 'code' => 'IDR', 'symbol_native' => 'Rp',	 'name' => 'Indonesian Rupiah'],
			// 'ILS' 	=> ['symbol' => '₪','decimal_digits' => 2, 'code' => 'ILS', 'symbol_native' => '₪',		 'name' => 'Israeli New Sheqel'],
			'INR' 	=> ['symbol' => 'Rs', 	'decimal_digits' => 2, 'code' => 'INR', 'symbol_native' => 'টকা',	 'name' => 'Indian Rupee'],
			'IQD' 	=> ['symbol' => 'IQD', 	'decimal_digits' => 0, 'code' => 'IQD', 'symbol_native' => 'د.ع.‏',	 'name' => 'Iraqi Dinar'],
			'IRHT' 	=> ['symbol' => 'IRHT',	'decimal_digits' => 0, 'code' => 'IRHT','symbol_native' => 'هزار تومان','name' => 'Iranian Thousand Toman'],
			'IRHR' 	=> ['symbol' => 'IRHR',	'decimal_digits' => 0, 'code' => 'IRHR','symbol_native' => 'هزار ریال','name' => 'Iranian Thousand Rial'],
			'ISK' 	=> ['symbol' => 'Ikr', 	'decimal_digits' => 0, 'code' => 'ISK', 'symbol_native' => 'kr',	 'name' => 'Icelandic Króna'],
			'JMD' 	=> ['symbol' => 'J$', 	'decimal_digits' => 2, 'code' => 'JMD', 'symbol_native' => '$',		 'name' => 'Jamaican Dollar'],
			'JOD' 	=> ['symbol' => 'JD', 	'decimal_digits' => 3, 'code' => 'JOD', 'symbol_native' => 'د.أ.‏',	 'name' => 'Jordanian Dinar'],
			'KES' 	=> ['symbol' => 'Ksh', 	'decimal_digits' => 2, 'code' => 'KES', 'symbol_native' => 'Ksh',	 'name' => 'Kenyan Shilling'],
			'KHR' 	=> ['symbol' => 'KHR', 	'decimal_digits' => 2, 'code' => 'KHR', 'symbol_native' => '៛',		 'name' => 'Cambodian Riel'],
			'KMF' 	=> ['symbol' => 'CF', 	'decimal_digits' => 0, 'code' => 'KMF', 'symbol_native' => 'FC',	 'name' => 'Comorian Franc'],
			'KRW' 	=> ['symbol' => '₩', 	'decimal_digits' => 0, 'code' => 'KRW', 'symbol_native' => '₩',		 'name' => 'South Korean Won'],
			'KWD' 	=> ['symbol' => 'KD', 	'decimal_digits' => 3, 'code' => 'KWD', 'symbol_native' => 'د.ك.‏',	 'name' => 'Kuwaiti Dinar'],
			'KZT' 	=> ['symbol' => 'KZT', 	'decimal_digits' => 2, 'code' => 'KZT', 'symbol_native' => 'тңг.',	 'name' => 'Kazakhstani Tenge'],
			'LBP' 	=> ['symbol' => 'LB£', 	'decimal_digits' => 0, 'code' => 'LBP', 'symbol_native' => 'ل.ل.‏',	 'name' => 'Lebanese Pound'],
			'LKR' 	=> ['symbol' => 'SLRs', 'decimal_digits' => 2, 'code' => 'LKR', 'symbol_native' => 'SL Re',	 'name' => 'Sri Lankan Rupee'],
			'LTL' 	=> ['symbol' => 'Lt', 	'decimal_digits' => 2, 'code' => 'LTL', 'symbol_native' => 'Lt',	 'name' => 'Lithuanian Litas'],
			'LVL' 	=> ['symbol' => 'Ls', 	'decimal_digits' => 2, 'code' => 'LVL', 'symbol_native' => 'Ls',	 'name' => 'Latvian Lats'],
			'LYD' 	=> ['symbol' => 'LD', 	'decimal_digits' => 3, 'code' => 'LYD', 'symbol_native' => 'د.ل.‏',	 'name' => 'Libyan Dinar'],
			'MAD' 	=> ['symbol' => 'MAD', 	'decimal_digits' => 2, 'code' => 'MAD', 'symbol_native' => 'د.م.‏',	 'name' => 'Moroccan Dirham'],
			'MDL' 	=> ['symbol' => 'MDL', 	'decimal_digits' => 2, 'code' => 'MDL', 'symbol_native' => 'MDL',	 'name' => 'Moldovan Leu'],
			'MGA' 	=> ['symbol' => 'MGA', 	'decimal_digits' => 0, 'code' => 'MGA', 'symbol_native' => 'MGA',	 'name' => 'Malagasy Ariary'],
			'MKD' 	=> ['symbol' => 'MKD', 	'decimal_digits' => 2, 'code' => 'MKD', 'symbol_native' => 'MKD',	 'name' => 'Macedonian Denar'],
			'MMK' 	=> ['symbol' => 'MMK', 	'decimal_digits' => 0, 'code' => 'MMK', 'symbol_native' => 'K',		 'name' => 'Myanma Kyat'],
			'MOP' 	=> ['symbol' => 'MOP$', 'decimal_digits' => 2, 'code' => 'MOP', 'symbol_native' => 'MOP$',	 'name' => 'Macanese Pataca'],
			'MUR' 	=> ['symbol' => 'MURs', 'decimal_digits' => 0, 'code' => 'MUR', 'symbol_native' => 'MURs',	 'name' => 'Mauritian Rupee'],
			'MXN' 	=> ['symbol' => 'MX$', 	'decimal_digits' => 2, 'code' => 'MXN', 'symbol_native' => '$',		 'name' => 'Mexican Peso'],
			'MYR' 	=> ['symbol' => 'RM', 	'decimal_digits' => 2, 'code' => 'MYR', 'symbol_native' => 'RM',	 'name' => 'Malaysian Ringgit'],
			'MZN' 	=> ['symbol' => 'MTn', 	'decimal_digits' => 2, 'code' => 'MZN', 'symbol_native' => 'MTn',	 'name' => 'Mozambican Metical'],
			'NAD' 	=> ['symbol' => 'N$', 	'decimal_digits' => 2, 'code' => 'NAD', 'symbol_native' => 'N$',	 'name' => 'Namibian Dollar'],
			'NGN' 	=> ['symbol' => '₦', 	'decimal_digits' => 2, 'code' => 'NGN', 'symbol_native' => '₦',		 'name' => 'Nigerian Naira'],
			'NIO' 	=> ['symbol' => 'C$', 	'decimal_digits' => 2, 'code' => 'NIO', 'symbol_native' => 'C$',	 'name' => 'Nicaraguan Córdoba'],
			'NOK' 	=> ['symbol' => 'Nkr', 	'decimal_digits' => 2, 'code' => 'NOK', 'symbol_native' => 'kr',	 'name' => 'Norwegian Krone'],
			'NPR' 	=> ['symbol' => 'NPRs', 'decimal_digits' => 2, 'code' => 'NPR', 'symbol_native' => 'नेरू',	 'name' => 'Nepalese Rupee'],
			'NZD' 	=> ['symbol' => 'NZ$', 	'decimal_digits' => 2, 'code' => 'NZD', 'symbol_native' => '$',		 'name' => 'New Zealand Dollar'],
			'OMR' 	=> ['symbol' => 'OMR', 	'decimal_digits' => 3, 'code' => 'OMR', 'symbol_native' => 'ر.ع.‏',	 'name' => 'Omani Rial'],
			'PAB' 	=> ['symbol' => 'B/.', 	'decimal_digits' => 2, 'code' => 'PAB', 'symbol_native' => 'B/.',	 'name' => 'Panamanian Balboa'],
			'PEN' 	=> ['symbol' => 'S/.', 	'decimal_digits' => 2, 'code' => 'PEN', 'symbol_native' => 'S/.',	 'name' => 'Peruvian Nuevo Sol'],
			'PHP' 	=> ['symbol' => '₱', 	'decimal_digits' => 2, 'code' => 'PHP', 'symbol_native' => '₱',		 'name' => 'Philippine Peso'],
			'PKR' 	=> ['symbol' => 'PKRs', 'decimal_digits' => 0, 'code' => 'PKR', 'symbol_native' => '₨',		 'name' => 'Pakistani Rupee'],
			'PLN' 	=> ['symbol' => 'zł', 	'decimal_digits' => 2, 'code' => 'PLN', 'symbol_native' => 'zł',	 'name' => 'Polish Zloty'],
			'PYG' 	=> ['symbol' => '₲', 	'decimal_digits' => 0, 'code' => 'PYG', 'symbol_native' => '₲',		 'name' => 'Paraguayan Guarani'],
			'QAR' 	=> ['symbol' => 'QR', 	'decimal_digits' => 2, 'code' => 'QAR', 'symbol_native' => 'ر.ق.‏',	 'name' => 'Qatari Rial'],
			'RON' 	=> ['symbol' => 'RON', 	'decimal_digits' => 2, 'code' => 'RON', 'symbol_native' => 'RON',	 'name' => 'Romanian Leu'],
			'RSD' 	=> ['symbol' => 'din.', 'decimal_digits' => 0, 'code' => 'RSD', 'symbol_native' => 'дин.',	 'name' => 'Serbian Dinar'],
			'RUB' 	=> ['symbol' => 'RUB', 	'decimal_digits' => 2, 'code' => 'RUB', 'symbol_native' => 'руб.',	 'name' => 'Russian Ruble'],
			'RWF' 	=> ['symbol' => 'RWF', 	'decimal_digits' => 0, 'code' => 'RWF', 'symbol_native' => 'FR',	 'name' => 'Rwandan Franc'],
			'SAR' 	=> ['symbol' => 'SR', 	'decimal_digits' => 2, 'code' => 'SAR', 'symbol_native' => 'ر.س.‏',	 'name' => 'Saudi Riyal'],
			'SDG' 	=> ['symbol' => 'SDG', 	'decimal_digits' => 2, 'code' => 'SDG', 'symbol_native' => 'SDG',	 'name' => 'Sudanese Pound'],
			'SEK' 	=> ['symbol' => 'Skr', 	'decimal_digits' => 2, 'code' => 'SEK', 'symbol_native' => 'kr',	 'name' => 'Swedish Krona'],
			'SGD' 	=> ['symbol' => 'S$', 	'decimal_digits' => 2, 'code' => 'SGD', 'symbol_native' => '$',		 'name' => 'Singapore Dollar'],
			'SOS' 	=> ['symbol' => 'Ssh', 	'decimal_digits' => 0, 'code' => 'SOS', 'symbol_native' => 'Ssh',	 'name' => 'Somali Shilling'],
			'SYP' 	=> ['symbol' => 'SY£', 	'decimal_digits' => 0, 'code' => 'SYP', 'symbol_native' => 'ل.س.‏',	 'name' => 'Syrian Pound'],
			'THB' 	=> ['symbol' => '฿', 	'decimal_digits' => 2, 'code' => 'THB', 'symbol_native' => '฿',		 'name' => 'Thai Baht'],
			'TND' 	=> ['symbol' => 'DT', 	'decimal_digits' => 3, 'code' => 'TND', 'symbol_native' => 'د.ت.‏',	 'name' => 'Tunisian Dinar'],
			'TOP' 	=> ['symbol' => 'T$', 	'decimal_digits' => 2, 'code' => 'TOP', 'symbol_native' => 'T$',	 'name' => 'Tongan Paʻanga'],
			'TRY' 	=> ['symbol' => 'TL', 	'decimal_digits' => 2, 'code' => 'TRY', 'symbol_native' => 'TL',	 'name' => 'Turkish Lira'],
			'TTD' 	=> ['symbol' => 'TT$', 	'decimal_digits' => 2, 'code' => 'TTD', 'symbol_native' => '$',		 'name' => 'Trinidad and Tobago Dollar'],
			'TWD' 	=> ['symbol' => 'NT$', 	'decimal_digits' => 2, 'code' => 'TWD', 'symbol_native' => 'NT$',	 'name' => 'New Taiwan Dollar'],
			'TZS' 	=> ['symbol' => 'TSh', 	'decimal_digits' => 0, 'code' => 'TZS', 'symbol_native' => 'TSh',	 'name' => 'Tanzanian Shilling'],
			'UAH' 	=> ['symbol' => '₴', 	'decimal_digits' => 2, 'code' => 'UAH', 'symbol_native' => '₴',		 'name' => 'Ukrainian Hryvnia'],
			'UGX' 	=> ['symbol' => 'USh', 	'decimal_digits' => 0, 'code' => 'UGX', 'symbol_native' => 'USh',	 'name' => 'Ugandan Shilling'],
			'UYU' 	=> ['symbol' => '$U', 	'decimal_digits' => 2, 'code' => 'UYU', 'symbol_native' => '$',		 'name' => 'Uruguayan Peso'],
			'UZS' 	=> ['symbol' => 'UZS', 	'decimal_digits' => 0, 'code' => 'UZS', 'symbol_native' => 'UZS',	 'name' => 'Uzbekistan Som'],
			'VEF' 	=> ['symbol' => 'Bs.F.','decimal_digits' => 2, 'code' => 'VEF', 'symbol_native' => 'Bs.F.',	 'name' => 'Venezuelan Bolívar'],
			'VND' 	=> ['symbol' => '₫', 	'decimal_digits' => 0, 'code' => 'VND', 'symbol_native' => '₫',		 'name' => 'Vietnamese Dong'],
			'XAF' 	=> ['symbol' => 'FCFA', 'decimal_digits' => 0, 'code' => 'XAF', 'symbol_native' => 'FCFA',	 'name' => 'CFA Franc BEAC'],
			'XOF' 	=> ['symbol' => 'CFA', 	'decimal_digits' => 0, 'code' => 'XOF', 'symbol_native' => 'CFA',	 'name' => 'CFA Franc BCEAO'],
			'YER' 	=> ['symbol' => 'YR', 	'decimal_digits' => 0, 'code' => 'YER', 'symbol_native' => 'ر.ي.‏',	 'name' => 'Yemeni Rial'],
			'ZAR' 	=> ['symbol' => 'R', 	'decimal_digits' => 2, 'code' => 'ZAR', 'symbol_native' => 'R',		 'name' => 'South African Rand'],
			'ZMK' 	=> ['symbol' => 'ZK', 	'decimal_digits' => 0, 'code' => 'ZMK', 'symbol_native' => 'ZK',	 'name' => 'Zambian Kwacha'],
		];

		return $currency;
	}


	public static function detail($_key)
	{
		$list = self::list();
		if(isset($list[$_key]))
		{
			return $list[$_key];
		}

		return null;
	}
}
?>
