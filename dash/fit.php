<?php
namespace dash;


class fit{


	/**
	 * Converts all numbers to persian number
	 * @param  [type] $_txt input text or numbers
	 * @return [type]       [description]
	 */
	public static function number($_txt, $_autoFormat = true, $_lang = null)
	{
		$new_text = $_txt;

		// auto format
		if($_autoFormat)
		{
			if(is_numeric($new_text))
			{
				$new_text = number_format($new_text);
			}
		}

		$persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
		$arabic  = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
		$english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
		// if language is not set use default language
		if(!$_lang)
		{
			$_lang = \dash\language::current();
		}

		switch ($_lang)
		{
			case 'persian':
			case 'farsi':
			case 'fa':
				// convert english and arabic numbers to persian number
				$new_text = str_replace($english, $persian, $new_text);
				$new_text = str_replace($arabic, $persian, $new_text);
				break;

			case 'arabic':
			case 'ar':
				// convert english and arabic numbers to persian number
				$new_text = str_replace($persian, $arabic, $new_text);
				$new_text = str_replace($english, $arabic, $new_text);
				break;

			case 'english':
			case 'en':
			default:
				// convert english and arabic numbers to persian number
				$new_text = str_replace($persian, $english, $new_text);
				$new_text = str_replace($arabic, $english, $new_text);
				break;
		}
		// return result in selected language
		return $new_text;
	}



	public static function number_en($_text, $_autoFormat = true)
	{
		return self::number($_text, $_autoFormat, 'en');
	}


	public static function price($_price)
	{
		if(is_numeric($_price))
		{
			$_price = round($_price, 3);
		}

		return self::number_decimal($_price, 'en');
	}


	public static function price_old($_price, $_forceEn = false)
	{
		if($_forceEn)
		{
			return self::number($_price, true, 'en');
		}
		return self::number($_price);
	}


	public static function number_decimal($_number, $_lang = null)
	{
		if(!is_numeric($_number))
		{
			return $_number;
		}


		$new_number = (string) $_number;

		if(strpos($new_number, '.') !== false)
		{
			$number  = substr($new_number, 0, strpos($new_number, '.'));
			$decimal = substr($new_number, strpos($new_number, '.') + 1 );
			$fit = self::number($number, true, $_lang);

			if(preg_match("/[1-9]/", $decimal))
			{
				$decimal = preg_replace("/0+$/", '', $decimal);
				$fit .= '.'. self::text($decimal, $_lang);
			}
			return $fit;
		}
		else
		{
			return self::number($_number, true, $_lang);
		}

	}

	public static function stats($_txt, $_round = false)
	{
		$number = $_txt;

		if(!is_numeric($number))
		{
			return '-';
		}

		$round = 2;
		if($_round)
		{
			$round = 0;
		}

		$result = null;

		$number = floatval($number);

		if($number < 100000)
		{
			$result = self::number($number);
		}
		elseif($number < 1000000)
		{
			$k = round(($number / 1000), $round);
			$result = self::text($k). ' K';
		}
		elseif($number < 1000000000)
		{
			$k = round($number / 1000000, $round);
			$result = self::text($k). ' M';
		}
		else
		{
			$k = round($number / 1000000000, $round);
			$result = self::text($k). ' B';
		}

		return $result;

	}


	public static function text($_txt, $_lang = null)
	{
		return self::number($_txt, false, $_lang);
	}


	public static function date_en($_date, $_format = null)
	{
		$date = self::date(...func_get_args());
		if($date)
		{
			$date = \dash\utility\convert::to_en_number($date);
		}

		return $date;
	}


	public static function date($_date, $_format = null)
	{
		if(!$_date)
		{
			return null;
		}
		return \dash\datetime::fit($_date, $_format, 'date');
	}


	public static function datetime_full($_date)
	{
		if(!$_date)
		{
			return null;
		}
		return \dash\datetime::fit($_date, true, 'datetime');
	}


	public static function time($_date, $_format = null)
	{
		if(!$_date)
		{
			return null;
		}
		return \dash\datetime::fit($_date, $_format, 'time');
	}

	public static function date_time($_date, $_format = null)
	{
		if(!$_date)
		{
			return null;
		}
		return \dash\datetime::fit($_date, $_format);
	}

	public static function date_human($_date)
	{
		if(!$_date)
		{
			return null;
		}
		return \dash\datetime::fit($_date, 'human', 'year');
	}


	public static function mobile($_number)
	{
		$new_text = $_number;
		if(is_numeric($new_text))
		{
			if(strlen($new_text) == 12)
			{
				$country     = substr($new_text, 0, 2);
				$firstChain  = substr($new_text, 2, 3);
				$secondChain = substr($new_text, 5, 3);
				$thirdChain  = substr($new_text, 8, 4);
				$new_text    = ''. $country . '-'. $firstChain . '-' . $secondChain . '-' . $thirdChain;
			}
		}

		$new_text = self::text($new_text);
		return $new_text;
	}


	public static function tel($_number)
	{
		$new_text = $_number;
		if(is_numeric($new_text))
		{
			if(strlen($new_text) == 12)
			{
				$country     = substr($new_text, 0, 2);
				$firstChain  = substr($new_text, 2, 3);
				$secondChain = substr($new_text, 5, 3);
				$thirdChain  = substr($new_text, 8, 4);
				$new_text    = $firstChain . '-' . $secondChain . '-' . $thirdChain;
			}
			elseif(strlen($new_text) == 10)
			{
				$firstChain  = substr($new_text, 0, 3);
				$secondChain = substr($new_text, 3, 3);
				$thirdChain  = substr($new_text, 6, 4);
				$new_text     = $firstChain . '-' . $secondChain . '-' . $thirdChain;
			}
		}

		$new_text = self::number($new_text);
		return $new_text;
	}


	public static function file_size($_size, $_forceEn = null)
	{
		return \dash\upload\size::readableSize($_size, $_forceEn);
	}


	public static function img($_src, $_size = null)
	{
		if(substr($_src, 0, 28) === 'https://source.unsplash.com/')
		{
			return $_src;
		}

		if(
			strpos($_src, 'talambar') !== false ||
			strpos($_src, 'digitaloceanspaces') !== false ||
			strpos($_src, 'amazonaws') !== false ||
			strpos($_src, 'arvanstorage') !== false
		)
		{
			// ok
		}
		else
		{
			return $_src;
		}

		$dotPosition = strrpos($_src, '.');
		if(!$dotPosition)
		{
			return false;
		}

		// temporary disable size for gif, load original image
		if(substr($_src, $dotPosition) === '.gif')
		{
			return $_src;
		}

		if($_size === 'raw')
		{
			return $_src;
		}

		// check size of img
		switch ($_size)
		{
			case '120':
			case '220':
			case '300':
			case '460':
			case '780':
			case '1100':
			case 'raw':
				// do nothing
				break;

			default:
				$_size = '120';
				break;
		}

		$newUrl = substr($_src, 0, $dotPosition). '-w'. $_size .'.webp';

		return $newUrl;
	}

}
?>