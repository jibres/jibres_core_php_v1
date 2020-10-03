<?php
namespace lib;

class currency {

	public static function list()
	{
		// CHF have rounding 0.05

		$currency =
		[
			'IRT' 	=> ['symbol' => 'IRT', 	'decimal_digits' => 0, 'code' => 'IRT', 'symbol_native' => 'تومان',	 'name' => T_('Toman'), 'group' => 'iran', 'exchange_rial' => 10],
			'IRR' 	=> ['symbol' => 'IRR', 	'decimal_digits' => 0, 'code' => 'IRR', 'symbol_native' => '﷼',		 'name' => T_('Rial'), 'group' => 'iran', 'exchange_rial' => 1],
			'USD' 	=> ['symbol' => '$', 	'decimal_digits' => 2, 'code' => 'USD', 'symbol_native' => '$',		 'name' => T_('US Dollar')],
			'EUR' 	=> ['symbol' => '€', 	'decimal_digits' => 2, 'code' => 'EUR', 'symbol_native' => '€',		 'name' => T_('Euro')],
			'GBP' 	=> ['symbol' => '£', 	'decimal_digits' => 2, 'code' => 'GBP', 'symbol_native' => '£',		 'name' => T_('British Pound Sterling')],
			'JPY' 	=> ['symbol' => '¥', 	'decimal_digits' => 0, 'code' => 'JPY', 'symbol_native' => '￥',		 'name' => T_('Japanese Yen')],

			'CAD' 	=> ['symbol' => 'CA$', 	'decimal_digits' => 2, 'code' => 'CAD', 'symbol_native' => '$',		 'name' => T_('Canadian Dollar')],
			'AED' 	=> ['symbol' => 'AED', 	'decimal_digits' => 2, 'code' => 'AED', 'symbol_native' => 'د.إ.‏',	 'name' => T_('United Arab Emirates Dirham')],
			'AFN' 	=> ['symbol' => 'Af', 	'decimal_digits' => 0, 'code' => 'AFN', 'symbol_native' => '؋',		 'name' => T_('Afghan Afghani')],
			'ALL' 	=> ['symbol' => 'ALL', 	'decimal_digits' => 0, 'code' => 'ALL', 'symbol_native' => 'Lek',	 'name' => T_('Albanian Lek')],
			'AMD' 	=> ['symbol' => 'AMD', 	'decimal_digits' => 0, 'code' => 'AMD', 'symbol_native' => 'դր.',	 'name' => T_('Armenian Dram')],
			'ARS' 	=> ['symbol' => 'AR$', 	'decimal_digits' => 2, 'code' => 'ARS', 'symbol_native' => '$',		 'name' => T_('Argentine Peso')],
			'AUD' 	=> ['symbol' => 'AU$', 	'decimal_digits' => 2, 'code' => 'AUD', 'symbol_native' => '$',		 'name' => T_('Australian Dollar')],
			'AZN' 	=> ['symbol' => 'man.', 'decimal_digits' => 2, 'code' => 'AZN', 'symbol_native' => 'ман.',	 'name' => T_('Azerbaijani Manat')],
			'BAM' 	=> ['symbol' => 'KM', 	'decimal_digits' => 2, 'code' => 'BAM', 'symbol_native' => 'KM',	 'name' => T_('Bosnia-Herzegovina Convertible Mark')],
			'BDT' 	=> ['symbol' => 'Tk', 	'decimal_digits' => 2, 'code' => 'BDT', 'symbol_native' => '৳',		 'name' => T_('Bangladeshi Taka')],
			'BGN' 	=> ['symbol' => 'BGN', 	'decimal_digits' => 2, 'code' => 'BGN', 'symbol_native' => 'лв.',	 'name' => T_('Bulgarian Lev')],
			'BHD' 	=> ['symbol' => 'BD', 	'decimal_digits' => 3, 'code' => 'BHD', 'symbol_native' => 'د.ب.‏',	 'name' => T_('Bahraini Dinar')],
			'BIF' 	=> ['symbol' => 'FBu', 	'decimal_digits' => 0, 'code' => 'BIF', 'symbol_native' => 'FBu',	 'name' => T_('Burundian Franc')],
			'BND' 	=> ['symbol' => 'BN$', 	'decimal_digits' => 2, 'code' => 'BND', 'symbol_native' => '$',		 'name' => T_('Brunei Dollar')],
			'BOB' 	=> ['symbol' => 'Bs', 	'decimal_digits' => 2, 'code' => 'BOB', 'symbol_native' => 'Bs',	 'name' => T_('Bolivian Boliviano')],
			'BRL' 	=> ['symbol' => 'R$', 	'decimal_digits' => 2, 'code' => 'BRL', 'symbol_native' => 'R$',	 'name' => T_('Brazilian Real')],
			'BWP' 	=> ['symbol' => 'BWP', 	'decimal_digits' => 2, 'code' => 'BWP', 'symbol_native' => 'P',		 'name' => T_('Botswanan Pula')],
			'BYR' 	=> ['symbol' => 'BYR', 	'decimal_digits' => 0, 'code' => 'BYR', 'symbol_native' => 'BYR',	 'name' => T_('Belarusian Ruble')],
			'BZD' 	=> ['symbol' => 'BZ$', 	'decimal_digits' => 2, 'code' => 'BZD', 'symbol_native' => '$',		 'name' => T_('Belize Dollar')],
			'CDF' 	=> ['symbol' => 'CDF', 	'decimal_digits' => 2, 'code' => 'CDF', 'symbol_native' => 'FrCD',	 'name' => T_('Congolese Franc')],
			'CHF' 	=> ['symbol' => 'CHF', 	'decimal_digits' => 2, 'code' => 'CHF', 'symbol_native' => 'CHF',	 'name' => T_('Swiss Franc')],
			'CLP' 	=> ['symbol' => 'CL$', 	'decimal_digits' => 0, 'code' => 'CLP', 'symbol_native' => '$',		 'name' => T_('Chilean Peso')],
			'CNY' 	=> ['symbol' => 'CN¥', 	'decimal_digits' => 2, 'code' => 'CNY', 'symbol_native' => 'CN¥',	 'name' => T_('Chinese Yuan')],
			'COP' 	=> ['symbol' => 'CO$', 	'decimal_digits' => 0, 'code' => 'COP', 'symbol_native' => '$',		 'name' => T_('Colombian Peso')],
			'CRC' 	=> ['symbol' => '₡', 	'decimal_digits' => 0, 'code' => 'CRC', 'symbol_native' => '₡',		 'name' => T_('Costa Rican Colón')],
			'CVE' 	=> ['symbol' => 'CV$', 	'decimal_digits' => 2, 'code' => 'CVE', 'symbol_native' => 'CV$',	 'name' => T_('Cape Verdean Escudo')],
			'CZK' 	=> ['symbol' => 'Kč', 	'decimal_digits' => 2, 'code' => 'CZK', 'symbol_native' => 'Kč',	 'name' => T_('Czech Republic Koruna')],
			'DJF' 	=> ['symbol' => 'Fdj', 	'decimal_digits' => 0, 'code' => 'DJF', 'symbol_native' => 'Fdj',	 'name' => T_('Djiboutian Franc')],
			'DKK' 	=> ['symbol' => 'Dkr', 	'decimal_digits' => 2, 'code' => 'DKK', 'symbol_native' => 'kr',	 'name' => T_('Danish Krone')],
			'DOP' 	=> ['symbol' => 'RD$', 	'decimal_digits' => 2, 'code' => 'DOP', 'symbol_native' => 'RD$',	 'name' => T_('Dominican Peso')],
			'DZD' 	=> ['symbol' => 'DA', 	'decimal_digits' => 2, 'code' => 'DZD', 'symbol_native' => 'د.ج.‏',	 'name' => T_('Algerian Dinar')],
			'EEK' 	=> ['symbol' => 'Ekr', 	'decimal_digits' => 2, 'code' => 'EEK', 'symbol_native' => 'kr',	 'name' => T_('Estonian Kroon')],
			'EGP' 	=> ['symbol' => 'EGP', 	'decimal_digits' => 2, 'code' => 'EGP', 'symbol_native' => 'ج.م.‏',	 'name' => T_('Egyptian Pound')],
			'ERN' 	=> ['symbol' => 'Nfk', 	'decimal_digits' => 2, 'code' => 'ERN', 'symbol_native' => 'Nfk',	 'name' => T_('Eritrean Nakfa')],
			'ETB' 	=> ['symbol' => 'Br', 	'decimal_digits' => 2, 'code' => 'ETB', 'symbol_native' => 'Br',	 'name' => T_('Ethiopian Birr')],
			'GEL' 	=> ['symbol' => 'GEL', 	'decimal_digits' => 2, 'code' => 'GEL', 'symbol_native' => 'GEL',	 'name' => T_('Georgian Lari')],
			'GHS' 	=> ['symbol' => 'GH₵', 	'decimal_digits' => 2, 'code' => 'GHS', 'symbol_native' => 'GH₵',	 'name' => T_('Ghanaian Cedi')],
			'GNF' 	=> ['symbol' => 'FG', 	'decimal_digits' => 0, 'code' => 'GNF', 'symbol_native' => 'FG',	 'name' => T_('Guinean Franc')],
			'GTQ' 	=> ['symbol' => 'GTQ', 	'decimal_digits' => 2, 'code' => 'GTQ', 'symbol_native' => 'Q',		 'name' => T_('Guatemalan Quetzal')],
			'HKD' 	=> ['symbol' => 'HK$', 	'decimal_digits' => 2, 'code' => 'HKD', 'symbol_native' => '$',		 'name' => T_('Hong Kong Dollar')],
			'HNL' 	=> ['symbol' => 'HNL', 	'decimal_digits' => 2, 'code' => 'HNL', 'symbol_native' => 'L',		 'name' => T_('Honduran Lempira')],
			'HRK' 	=> ['symbol' => 'kn', 	'decimal_digits' => 2, 'code' => 'HRK', 'symbol_native' => 'kn',	 'name' => T_('Croatian Kuna')],
			'HUF' 	=> ['symbol' => 'Ft', 	'decimal_digits' => 0, 'code' => 'HUF', 'symbol_native' => 'Ft',	 'name' => T_('Hungarian Forint')],
			'IDR' 	=> ['symbol' => 'Rp', 	'decimal_digits' => 0, 'code' => 'IDR', 'symbol_native' => 'Rp',	 'name' => T_('Indonesian Rupiah')],
			// 'ILS' 	=> ['symbol' => '₪','decimal_digits' => 2, 'code' => 'ILS', 'symbol_native' => '₪',		 'name' => T_('Israeli New Sheqel')],
			'INR' 	=> ['symbol' => 'Rs', 	'decimal_digits' => 2, 'code' => 'INR', 'symbol_native' => 'টকা',	 'name' => T_('Indian Rupee')],
			'IQD' 	=> ['symbol' => 'IQD', 	'decimal_digits' => 0, 'code' => 'IQD', 'symbol_native' => 'د.ع.‏',	 'name' => T_('Iraqi Dinar')],
			'IRHT' 	=> ['symbol' => 'IRHT',	'decimal_digits' => 0, 'code' => 'IRHT','symbol_native' => 'هزار تومان','name' => T_('Thousand Toman'), 'group' => 'iran', 'exchange_rial' => 10000],
			'IRHR' 	=> ['symbol' => 'IRHR',	'decimal_digits' => 0, 'code' => 'IRHR','symbol_native' => 'هزار ریال','name' => T_('Thousand Rial'), 'group' => 'iran', 'exchange_rial' => 1000],
			'ISK' 	=> ['symbol' => 'Ikr', 	'decimal_digits' => 0, 'code' => 'ISK', 'symbol_native' => 'kr',	 'name' => T_('Icelandic Króna')],
			'JMD' 	=> ['symbol' => 'J$', 	'decimal_digits' => 2, 'code' => 'JMD', 'symbol_native' => '$',		 'name' => T_('Jamaican Dollar')],
			'JOD' 	=> ['symbol' => 'JD', 	'decimal_digits' => 3, 'code' => 'JOD', 'symbol_native' => 'د.أ.‏',	 'name' => T_('Jordanian Dinar')],
			'KES' 	=> ['symbol' => 'Ksh', 	'decimal_digits' => 2, 'code' => 'KES', 'symbol_native' => 'Ksh',	 'name' => T_('Kenyan Shilling')],
			'KHR' 	=> ['symbol' => 'KHR', 	'decimal_digits' => 2, 'code' => 'KHR', 'symbol_native' => '៛',		 'name' => T_('Cambodian Riel')],
			'KMF' 	=> ['symbol' => 'CF', 	'decimal_digits' => 0, 'code' => 'KMF', 'symbol_native' => 'FC',	 'name' => T_('Comorian Franc')],
			'KRW' 	=> ['symbol' => '₩', 	'decimal_digits' => 0, 'code' => 'KRW', 'symbol_native' => '₩',		 'name' => T_('South Korean Won')],
			'KWD' 	=> ['symbol' => 'KD', 	'decimal_digits' => 3, 'code' => 'KWD', 'symbol_native' => 'د.ك.‏',	 'name' => T_('Kuwaiti Dinar')],
			'KZT' 	=> ['symbol' => 'KZT', 	'decimal_digits' => 2, 'code' => 'KZT', 'symbol_native' => 'тңг.',	 'name' => T_('Kazakhstani Tenge')],
			'LBP' 	=> ['symbol' => 'LB£', 	'decimal_digits' => 0, 'code' => 'LBP', 'symbol_native' => 'ل.ل.‏',	 'name' => T_('Lebanese Pound')],
			'LKR' 	=> ['symbol' => 'SLRs', 'decimal_digits' => 2, 'code' => 'LKR', 'symbol_native' => 'SL Re',	 'name' => T_('Sri Lankan Rupee')],
			'LTL' 	=> ['symbol' => 'Lt', 	'decimal_digits' => 2, 'code' => 'LTL', 'symbol_native' => 'Lt',	 'name' => T_('Lithuanian Litas')],
			'LVL' 	=> ['symbol' => 'Ls', 	'decimal_digits' => 2, 'code' => 'LVL', 'symbol_native' => 'Ls',	 'name' => T_('Latvian Lats')],
			'LYD' 	=> ['symbol' => 'LD', 	'decimal_digits' => 3, 'code' => 'LYD', 'symbol_native' => 'د.ل.‏',	 'name' => T_('Libyan Dinar')],
			'MAD' 	=> ['symbol' => 'MAD', 	'decimal_digits' => 2, 'code' => 'MAD', 'symbol_native' => 'د.م.‏',	 'name' => T_('Moroccan Dirham')],
			'MDL' 	=> ['symbol' => 'MDL', 	'decimal_digits' => 2, 'code' => 'MDL', 'symbol_native' => 'MDL',	 'name' => T_('Moldovan Leu')],
			'MGA' 	=> ['symbol' => 'MGA', 	'decimal_digits' => 0, 'code' => 'MGA', 'symbol_native' => 'MGA',	 'name' => T_('Malagasy Ariary')],
			'MKD' 	=> ['symbol' => 'MKD', 	'decimal_digits' => 2, 'code' => 'MKD', 'symbol_native' => 'MKD',	 'name' => T_('Macedonian Denar')],
			'MMK' 	=> ['symbol' => 'MMK', 	'decimal_digits' => 0, 'code' => 'MMK', 'symbol_native' => 'K',		 'name' => T_('Myanma Kyat')],
			'MOP' 	=> ['symbol' => 'MOP$', 'decimal_digits' => 2, 'code' => 'MOP', 'symbol_native' => 'MOP$',	 'name' => T_('Macanese Pataca')],
			'MUR' 	=> ['symbol' => 'MURs', 'decimal_digits' => 0, 'code' => 'MUR', 'symbol_native' => 'MURs',	 'name' => T_('Mauritian Rupee')],
			'MXN' 	=> ['symbol' => 'MX$', 	'decimal_digits' => 2, 'code' => 'MXN', 'symbol_native' => '$',		 'name' => T_('Mexican Peso')],
			'MYR' 	=> ['symbol' => 'RM', 	'decimal_digits' => 2, 'code' => 'MYR', 'symbol_native' => 'RM',	 'name' => T_('Malaysian Ringgit')],
			'MZN' 	=> ['symbol' => 'MTn', 	'decimal_digits' => 2, 'code' => 'MZN', 'symbol_native' => 'MTn',	 'name' => T_('Mozambican Metical')],
			'NAD' 	=> ['symbol' => 'N$', 	'decimal_digits' => 2, 'code' => 'NAD', 'symbol_native' => 'N$',	 'name' => T_('Namibian Dollar')],
			'NGN' 	=> ['symbol' => '₦', 	'decimal_digits' => 2, 'code' => 'NGN', 'symbol_native' => '₦',		 'name' => T_('Nigerian Naira')],
			'NIO' 	=> ['symbol' => 'C$', 	'decimal_digits' => 2, 'code' => 'NIO', 'symbol_native' => 'C$',	 'name' => T_('Nicaraguan Córdoba')],
			'NOK' 	=> ['symbol' => 'Nkr', 	'decimal_digits' => 2, 'code' => 'NOK', 'symbol_native' => 'kr',	 'name' => T_('Norwegian Krone')],
			'NPR' 	=> ['symbol' => 'NPRs', 'decimal_digits' => 2, 'code' => 'NPR', 'symbol_native' => 'नेरू',	 'name' => T_('Nepalese Rupee')],
			'NZD' 	=> ['symbol' => 'NZ$', 	'decimal_digits' => 2, 'code' => 'NZD', 'symbol_native' => '$',		 'name' => T_('New Zealand Dollar')],
			'OMR' 	=> ['symbol' => 'OMR', 	'decimal_digits' => 3, 'code' => 'OMR', 'symbol_native' => 'ر.ع.‏',	 'name' => T_('Omani Rial')],
			'PAB' 	=> ['symbol' => 'B/.', 	'decimal_digits' => 2, 'code' => 'PAB', 'symbol_native' => 'B/.',	 'name' => T_('Panamanian Balboa')],
			'PEN' 	=> ['symbol' => 'S/.', 	'decimal_digits' => 2, 'code' => 'PEN', 'symbol_native' => 'S/.',	 'name' => T_('Peruvian Nuevo Sol')],
			'PHP' 	=> ['symbol' => '₱', 	'decimal_digits' => 2, 'code' => 'PHP', 'symbol_native' => '₱',		 'name' => T_('Philippine Peso')],
			'PKR' 	=> ['symbol' => 'PKRs', 'decimal_digits' => 0, 'code' => 'PKR', 'symbol_native' => '₨',		 'name' => T_('Pakistani Rupee')],
			'PLN' 	=> ['symbol' => 'zł', 	'decimal_digits' => 2, 'code' => 'PLN', 'symbol_native' => 'zł',	 'name' => T_('Polish Zloty')],
			'PYG' 	=> ['symbol' => '₲', 	'decimal_digits' => 0, 'code' => 'PYG', 'symbol_native' => '₲',		 'name' => T_('Paraguayan Guarani')],
			'QAR' 	=> ['symbol' => 'QR', 	'decimal_digits' => 2, 'code' => 'QAR', 'symbol_native' => 'ر.ق.‏',	 'name' => T_('Qatari Rial')],
			'RON' 	=> ['symbol' => 'RON', 	'decimal_digits' => 2, 'code' => 'RON', 'symbol_native' => 'RON',	 'name' => T_('Romanian Leu')],
			'RSD' 	=> ['symbol' => 'din.', 'decimal_digits' => 0, 'code' => 'RSD', 'symbol_native' => 'дин.',	 'name' => T_('Serbian Dinar')],
			'RUB' 	=> ['symbol' => 'RUB', 	'decimal_digits' => 2, 'code' => 'RUB', 'symbol_native' => 'руб.',	 'name' => T_('Russian Ruble')],
			'RWF' 	=> ['symbol' => 'RWF', 	'decimal_digits' => 0, 'code' => 'RWF', 'symbol_native' => 'FR',	 'name' => T_('Rwandan Franc')],
			'SAR' 	=> ['symbol' => 'SR', 	'decimal_digits' => 2, 'code' => 'SAR', 'symbol_native' => 'ر.س.‏',	 'name' => T_('Saudi Riyal')],
			'SDG' 	=> ['symbol' => 'SDG', 	'decimal_digits' => 2, 'code' => 'SDG', 'symbol_native' => 'SDG',	 'name' => T_('Sudanese Pound')],
			'SEK' 	=> ['symbol' => 'Skr', 	'decimal_digits' => 2, 'code' => 'SEK', 'symbol_native' => 'kr',	 'name' => T_('Swedish Krona')],
			'SGD' 	=> ['symbol' => 'S$', 	'decimal_digits' => 2, 'code' => 'SGD', 'symbol_native' => '$',		 'name' => T_('Singapore Dollar')],
			'SOS' 	=> ['symbol' => 'Ssh', 	'decimal_digits' => 0, 'code' => 'SOS', 'symbol_native' => 'Ssh',	 'name' => T_('Somali Shilling')],
			'SYP' 	=> ['symbol' => 'SY£', 	'decimal_digits' => 0, 'code' => 'SYP', 'symbol_native' => 'ل.س.‏',	 'name' => T_('Syrian Pound')],
			'THB' 	=> ['symbol' => '฿', 	'decimal_digits' => 2, 'code' => 'THB', 'symbol_native' => '฿',		 'name' => T_('Thai Baht')],
			'TND' 	=> ['symbol' => 'DT', 	'decimal_digits' => 3, 'code' => 'TND', 'symbol_native' => 'د.ت.‏',	 'name' => T_('Tunisian Dinar')],
			'TOP' 	=> ['symbol' => 'T$', 	'decimal_digits' => 2, 'code' => 'TOP', 'symbol_native' => 'T$',	 'name' => T_('Tongan Paʻanga')],
			'TRY' 	=> ['symbol' => 'TL', 	'decimal_digits' => 2, 'code' => 'TRY', 'symbol_native' => 'TL',	 'name' => T_('Turkish Lira')],
			'TTD' 	=> ['symbol' => 'TT$', 	'decimal_digits' => 2, 'code' => 'TTD', 'symbol_native' => '$',		 'name' => T_('Trinidad and Tobago Dollar')],
			'TWD' 	=> ['symbol' => 'NT$', 	'decimal_digits' => 2, 'code' => 'TWD', 'symbol_native' => 'NT$',	 'name' => T_('New Taiwan Dollar')],
			'TZS' 	=> ['symbol' => 'TSh', 	'decimal_digits' => 0, 'code' => 'TZS', 'symbol_native' => 'TSh',	 'name' => T_('Tanzanian Shilling')],
			'UAH' 	=> ['symbol' => '₴', 	'decimal_digits' => 2, 'code' => 'UAH', 'symbol_native' => '₴',		 'name' => T_('Ukrainian Hryvnia')],
			'UGX' 	=> ['symbol' => 'USh', 	'decimal_digits' => 0, 'code' => 'UGX', 'symbol_native' => 'USh',	 'name' => T_('Ugandan Shilling')],
			'UYU' 	=> ['symbol' => '$U', 	'decimal_digits' => 2, 'code' => 'UYU', 'symbol_native' => '$',		 'name' => T_('Uruguayan Peso')],
			'UZS' 	=> ['symbol' => 'UZS', 	'decimal_digits' => 0, 'code' => 'UZS', 'symbol_native' => 'UZS',	 'name' => T_('Uzbekistan Som')],
			'VEF' 	=> ['symbol' => 'Bs.F.','decimal_digits' => 2, 'code' => 'VEF', 'symbol_native' => 'Bs.F.',	 'name' => T_('Venezuelan Bolívar')],
			'VND' 	=> ['symbol' => '₫', 	'decimal_digits' => 0, 'code' => 'VND', 'symbol_native' => '₫',		 'name' => T_('Vietnamese Dong')],
			'XAF' 	=> ['symbol' => 'FCFA', 'decimal_digits' => 0, 'code' => 'XAF', 'symbol_native' => 'FCFA',	 'name' => T_('CFA Franc BEAC')],
			'XOF' 	=> ['symbol' => 'CFA', 	'decimal_digits' => 0, 'code' => 'XOF', 'symbol_native' => 'CFA',	 'name' => T_('CFA Franc BCEAO')],
			'YER' 	=> ['symbol' => 'YR', 	'decimal_digits' => 0, 'code' => 'YER', 'symbol_native' => 'ر.ي.‏',	 'name' => T_('Yemeni Rial')],
			'ZAR' 	=> ['symbol' => 'R', 	'decimal_digits' => 2, 'code' => 'ZAR', 'symbol_native' => 'R',		 'name' => T_('South African Rand')],
			'ZMK' 	=> ['symbol' => 'ZK', 	'decimal_digits' => 0, 'code' => 'ZMK', 'symbol_native' => 'ZK',	 'name' => T_('Zambian Kwacha')],
		];

		return $currency;
	}


	public static function name($_key)
	{
		$detail = self::detail($_key);
		if(isset($detail['name']))
		{
			return $detail['name'];
		}
		return null;
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


	public static function default()
	{
		if(\dash\url::tld() === 'ir')
		{
			return 'IRT';
		}

		if(\dash\language::current() === 'fa')
		{
			return 'IRT';
		}

		if(\dash\language::current() === 'en')
		{
			return 'USD';
		}

		return null;
	}


	public static function unit()
	{
		$toman = T_("Toman");
		$hezarToman = T_("Hezar Toman");

		// if store is loaded, read from store settings

		if(\dash\user::id())
		{
			// @todo read from user unit
			// until add $ always we use toman
			return $toman;
		}

		if(\dash\url::tld() === 'ir')
		{
			return $toman;
		}

		if(\dash\language::current() === 'fa')
		{
			return $toman;
		}

		if(\dash\language::current() === 'en')
		{
			return '$';
		}

		return '$';
	}

}
?>
