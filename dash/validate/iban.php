<?php
namespace dash\validate;
/**
 * Class for validate args
 */
class iban
{

	private static $check_alphabet =
	[
		'a' => 10,		'b' => 11,
		'c' => 12,		'd' => 13,
		'e' => 14,		'f' => 15,
		'g' => 16,		'h' => 17,
		'i' => 18,		'j' => 19,
		'k' => 20,		'l' => 21,
		'm' => 22,		'n' => 23,
		'o' => 24,		'p' => 25,
		'q' => 26,		'r' => 27,
		's' => 28,		't' => 29,
		'u' => 30,		'v' => 31,
		'w' => 32,		'x' => 33,
		'y' => 34,		'z' => 35,
	];


	private static $country_len =
	[
		'al' => 28,		'ad' => 24,		'at' => 20,		'az' => 28,		'bh' => 22,		'be' => 16,		'ba' => 20,
		'br' => 29,		'bg' => 22,		'cr' => 21,		'hr' => 21,		'cy' => 28,		'cz' => 24,		'dk' => 18,
		'do' => 28,		'ee' => 20,		'fo' => 18,		'fi' => 18,		'fr' => 27,		'ge' => 22,		'de' => 22,
		'gi' => 23,		'gr' => 27,		'gl' => 18,		'gt' => 28,		'hu' => 28,		'is' => 26,		'ie' => 22,
		'il' => 23,		'it' => 27,		'jo' => 30,		'kz' => 20,		'kw' => 30,		'lv' => 21,		'lb' => 28,
		'li' => 21,		'lt' => 20,		'lu' => 20,		'mk' => 19,		'mt' => 31,		'mr' => 27,		'mu' => 30,
		'mc' => 27,		'md' => 24,		'me' => 22,		'nl' => 18,		'no' => 15,		'pk' => 24,		'ps' => 29,
		'pl' => 28,		'pt' => 25,		'qa' => 29,		'ro' => 24,		'sm' => 27,		'sa' => 24,		'rs' => 22,
		'sk' => 24,		'si' => 19,		'es' => 24,		'se' => 24,		'ch' => 21,		'tn' => 24,		'tr' => 26,
		'ae' => 23,		'gb' => 22,		'vg' => 24,		'ir' => 26,
	];


	private static $ir_bank_code =
	[
		"010" => "بانک مرکزی",
		"011" => "بانک صنعت و معدن",
		"012" => "بانک ملت",
		"013" => "بانک رفاه",
		"014" => "بانک مسکن",
		"015" => "بانک سپه",
		"016" => "بانک کشاورزی",
		"017" => "بانک ملی ایران",
		"018" => "بانک تجارت",
		"019" => "بانک صادرات ایران",
		"020" => "بانک توسعه صادرات",
		"021" => "پست بانک ایران",
		"022" => "بانک توسعه تعاون",
		"051" => "موسسه اعتباري توسعه",
		"053" => "بانک کارآفرین",
		"054" => "بانک پارسیان",
		"055" => "بانک اقتصاد نوین",
		"056" => "بانک سامان",
		"057" => "بانک پاسارگاد",
		"058" => "بانک سرمایه",
		"059" => "بانک سینا",
		"060" => "قرض الحسنه مهر ايران",
		"061" => "بانک شهر",
		"062" => "بانک تات",
		"063" => "بانک انصار",
		"064" => "گردشگري",
		"065" => "حكمت ايرانيان",
		"066" => "بانک دی",
		"069" => "ايران زمين",
		"095" => "ايران و ونزوئلا",
		"070" => "بانک قرض الحسنه رسالت",
	];


	private static $ir_bank_first_card_number =
	[
		"627412" => "بانک اقتصاد نوین",
		"627381" => "بانک انصار",
		"505785" => "بانک ایران زمین",
		"622106" => "بانک پارسیان",
		"639194" => "بانک پارسیان",
		"627884" => "بانک پارسیان",
		"639347" => "بانک پاسارگاد",
		"502229" => "بانک پاسارگاد",
		"636214" => "بانک آینده",
		"627353" => "بانک تجارت",
		"585983" => "بانک تجارت",
		"502908" => "بانک توسعه تعاون",
		"627648" => "بانک توسعه صادرات ایران",
		"207177" => "بانک توسعه صادرات ایران",
		"636949" => "بانک حکمت ایرانیان",
		"502938" => "بانک دی",
		"589463" => "بانک رفاه کارگران",
		"621986" => "بانک سامان",
		"589210" => "بانک سپه",
		"639607" => "بانک سرمایه",
		"639346" => "بانک سینا",
		"502806" => "بانک شهر",
		"504706" => "بانک شهر",
		"603769" => "بانک صادرات ایران",
		"627961" => "بانک صنعت و معدن",
		"606373" => "بانک قرض الحسنه مهر ایران",
		"639599" => "بانک قوامین",
		"627488" => "بانک کارآفرین",
		"502910" => "بانک کارآفرین",
		"603770" => "بانک کشاورزی",
		"639217" => "بانک کشاورزی",
		"505416" => "بانک گردشگری",
		"636795" => "بانک مرکزی",
		"628023" => "بانک مسکن",
		"610433" => "بانک ملت",
		"991975" => "بانک ملت",
		"603799" => "بانک ملی",
		"639370" => "بانک مهر اقتصاد",
		"627760" => "پست بانک ایران",
		"628157" => "موسسه اعتباری توسعه",
		"505801" => "موسسه اعتباری کوثر",
		"606256" => "مؤسسه اعتباری ملل (عسکریه سابق)",
		"504172" => "بانک قرض الحسنه رسالت",
		"505809" => "بانک خاورمیانه",
	];


	public static function check($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{

		$data = \dash\validate\text::string($_data, $_notif, $_element, $_field_title, $_meta);

		if($data === false || $data === null)
		{
			return $data;
		}

		if(is_string($data))
		{
			$data    = \dash\utility\convert::to_en_number($data);
			$replace = ['{', '}', '(', ')', '_', '-', '+', ' ', ',', ':'];
			$data    = str_replace($replace, '', $data);
		}

		$data = mb_strtolower($data);

		if(!preg_match("/^([a-z]{2})(\d{24})$/", $data))
		{
			if($_notif)
			{
				\dash\notif::error(T_("IBAN number must be contain country code and have exactly 24 number"), ['element' => $_element]);
				\dash\cleanse::$status = false;
			}
			return false;
		}

		$alphabet1 = substr($data, 0, 1);
		$alphabet2 = substr($data, 1, 1);

		$alphabet_number = self::$check_alphabet[$alphabet1]. self::$check_alphabet[$alphabet2];

		$check_number = substr($data, 4). substr($data, 0, 4);

		$check_number = preg_replace("/[a-z]+/", $alphabet_number, $check_number);

		$mode97 = self::my_bcmod($check_number, '97');

		if($mode97 === 1)
		{
			// its ok
		}
		else
		{
			if($_notif)
			{
				\dash\notif::error(T_("Invalid IBAN. Please enter a valid IBAN"), ['element' => $_element]);
				\dash\cleanse::$status = false;
			}
			return false;
		}

		$data = mb_strtoupper($data);

		return $data;
	}


	private static function my_bcmod( $x, $y )
	{
	    // how many numbers to take at once? carefull not to exceed (int)
		$take = 5;
		$mod  = '';

	    do
	    {
			$a   = (int)$mod.substr( $x, 0, $take );
			$x   = substr( $x, $take );
			$mod = $a % $y;
	    }
	    while ( strlen($x) );

	    return (int) $mod;
	}


	public static function detail($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{
		$data = self::check($_data, $_notif, $_element, $_field_title, $_meta);

		if($data === false || $data === null)
		{
			return $data;
		}

		$bank_code = substr($data, 4, 3);

		$result                    = [];
		$result['iban']            = $data;
		$result['bank']            = null;
		$result['first_card_code'] = null;

		if(isset(self::$ir_bank_code[$bank_code]))
		{
			$result['bank'] = self::$ir_bank_code[$bank_code];
		}

		return $result;
	}

}
?>