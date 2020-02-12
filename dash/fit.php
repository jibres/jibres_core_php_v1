<?php
namespace dash;


class fit{


	/**
	 * Converts all numbers to persian number
	 * @param  [type] $_txt input text or numbers
	 * @return [type]       [description]
	 */
	public static function number($_txt, $_lang = null)
	{
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
				$_txt = str_replace($english, $persian, $_txt);
				$_txt = str_replace($arabic, $persian, $_txt);
				break;

			case 'arabic':
			case 'ar':
				// convert english and arabic numbers to persian number
				$_txt = str_replace($persian, $arabic, $_txt);
				$_txt = str_replace($english, $arabic, $_txt);
				break;

			case 'english':
			case 'en':
			default:
				// convert english and arabic numbers to persian number
				$_txt = str_replace($persian, $english, $_txt);
				$_txt = str_replace($arabic, $english, $_txt);
				break;
		}
		// return result in selected language
		return $_txt;
	}



	/**
	 * change numbers to rtl and fitNumber
	 * @param  [type] $_txt  [description]
	 * @param  [type] $_lang [description]
	 * @return [type]        [description]
	 */
	public static function fitNumber($_number, $_autoFormat = true)
	{
		$new_text = $_number;
		if(is_numeric($new_text))
		{
			if($_autoFormat === 'mobile12')
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
			elseif($_autoFormat === 'mobile')
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
			elseif($_autoFormat)
			{
				$new_text = number_format($new_text);
			}
		}
		$new_text = self::number($new_text);
		return $new_text;
	}
}
?>