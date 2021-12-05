<?php
namespace dash\validate;
/**
 * Class for validate args
 */
class text
{

	public static function string($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{
		$data = $_data;

		if($data === null || $data === '')
		{
			return null;
		}

		if(!is_string($data) && !is_numeric($data))
		{
			if($_notif)
			{
				\dash\notif::error(T_("Field :val must be string", ['val' => $_field_title]), ['element' => $_element, 'code' => 1600]);
				\dash\cleanse::$status = false;
			}
			return false;
		}

		if(is_numeric($data))
		{
			$data = (string) $data;
		}

		$length = null;
		if(isset($_meta['max']) && is_numeric($_meta['max']))
		{
			$length = intval($_meta['max']);
		}

		if(!$length)
		{
			$length = 100000;
		}

		if(isset($_meta['min']) && is_numeric($_meta['min']) && floatval($length) === floatval($_meta['min']))
		{
			if(mb_strlen($data) != intval($_meta['min']))
			{
				if($_notif)
				{
					\dash\notif::error(T_("Field :val must be exactly :length character", ['val' => $_field_title, 'length' => \dash\fit::number($length)]), ['element' => $_element, 'code' => 1605]);
					\dash\cleanse::$status = false;
				}
				return false;
			}

		}


		if(mb_strlen($data) > $length)
		{
			if($_notif)
			{
				\dash\notif::error(T_("Field :val must be less than :length character", ['val' => $_field_title, 'length' => \dash\fit::number($length)]), ['element' => $_element, 'code' => 1605]);
				\dash\cleanse::$status = false;
			}
			return false;
		}


		if(isset($_meta['min']) && is_numeric($_meta['min']))
		{
			if(mb_strlen($data) < intval($_meta['min']))
			{
				if($_notif)
				{
					\dash\notif::error(T_("Field :val must be larger than :length character", ['val' => $_field_title, 'length' => \dash\fit::number($_meta['min'])]), ['element' => $_element, 'code' => 1607]);
					\dash\cleanse::$status = false;
				}
				return false;
			}
		}


		$data = preg_replace("/(\r\n){3,}/", "$1\n$1", $data);

		// desc and seodesc need_new_line
		if(isset($_meta['need_new_line']) && $_meta['need_new_line'])
		{
			// we dont remove \n because need new line
		}
		else
		{
			// remove \n from string
			$data = preg_replace("/[\n]/", " ", $data);
		}

		// // remove 2 space in everywhere
		// $data = preg_replace("/\h+/", " ", $data);


		if(isset($_meta['html']) && $_meta['html'])
		{
			// donot strip tag
		}
		else
		{
			$data = self::html_decode($data);
			if($data === false)
			{
				if($_notif)
				{
					\dash\notif::error(T_("We can not save this text!", ['val' => $_field_title]), ['element' => $_element, 'code' => 1750]);
					\dash\cleanse::$status = false;
				}
				return false;
			}

			$data = strip_tags($data);
			$data = str_replace('"',   '', $data);
			$data = str_replace("'",   '', $data);
		}

		$data_before = $data;

		$data = str_replace("\\",  '', $data);
		$data = str_replace("`",   '', $data);
		$data = str_replace('<?',  '', $data);
		$data = str_replace('?>',  '', $data);
		$data = str_replace('../', '', $data);
		$data = str_replace('./',  '', $data);
		$data = str_replace('<script', '', $data);
		$data = str_replace('< script', '', $data);
		$data = str_replace('</script>', '', $data);



		if(mb_strlen($data_before) !== mb_strlen($data))
		{
			if($_notif)
			{
				\dash\notif::warn(T_("We have removed some unauthorized characters from your text"), ['element' => $_element, 'code' => 1700]);
			}
		}

		$data = addslashes($data);
		// trim needless to aletr to user
		$data = trim($data);

		return $data;
	}


	public static function html_decode($_text)
	{
		if(!$_text || !is_string($_text))
		{
			return $_text;
		}

		if($_text !== ($decoded1 = htmlspecialchars_decode($_text)))
		{
			if($decoded1 !== ($decoded2 = htmlspecialchars_decode($decoded1)))
			{
				if($decoded2 !== ($decoded3 = htmlspecialchars_decode($decoded2)))
				{
					// dbl encode!
					return false;
				}
				else
				{
					// decode 2
					return $decoded2;
				}
			}
			else
			{
				// decode 1
				return $decoded1;
			}
		}
		else
		{
			// text is not decoded
			return $_text;
		}
	}


	public static function enstring($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{
		$data = self::string($_data, $_notif, $_element, $_field_title, $_meta);

		if($data === false || $data === null)
		{
			return $data;
		}


		if(!preg_match("/^[A-Za-z0-9\_\-\s\.\,]+$/", $data))
		{
			if($_notif)
			{
				\dash\notif::error(T_("Only English character can be enter in field :val", ['val' => $_field_title]), ['element' => $_element, 'code' => 1750]);
				\dash\cleanse::$status = false;
			}
			return false;
		}

		return $data;
	}



	public static function socialnetwork($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{
		$_meta['min'] = 3;
		$_meta['max'] = 50;

		$data = self::string($_data, $_notif, $_element, $_field_title, $_meta);

		if($data === false || $data === null)
		{
			return $data;
		}


		if(!preg_match("/^[A-Za-z0-9\_\-\.]+$/", $data))
		{
			if($_notif)
			{
				\dash\notif::error(T_("Only English character can be enter in field :val", ['val' => $_field_title]), ['element' => $_element, 'code' => 1750]);
				\dash\cleanse::$status = false;
			}
			return false;
		}

		return $data;
	}


	public static function filename($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{
		$data = self::string($_data, $_notif, $_element, $_field_title, $_meta);

		if($data === false || $data === null)
		{
			return $data;
		}

		if(
			\dash\str::strpos($data, '"') !== false ||
			\dash\str::strpos($data, '/') !== false ||
			\dash\str::strpos($data, ':') !== false ||
			\dash\str::strpos($data, '<') !== false ||
			\dash\str::strpos($data, '>') !== false ||
			\dash\str::strpos($data, '?') !== false ||
			\dash\str::strpos($data, '*') !== false ||
			\dash\str::strpos($data, '|') !== false ||
			\dash\str::strpos($data, '\\') !== false

		  )
		{
			if($_notif)
			{
				\dash\notif::error(T_("Bad filename :val", ['val' => $_field_title]), ['element' => $_element, 'code' => 1750]);
				\dash\cleanse::$status = false;
			}
			return false;
		}

		return $data;
	}

	public static function filename_mime($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{
		$data = self::string($_data, $_notif, $_element, $_field_title, $_meta);

		if($data === false || $data === null)
		{
			return $data;
		}

		if(
			\dash\str::strpos($data, '"') !== false ||
			\dash\str::strpos($data, ':') !== false ||
			\dash\str::strpos($data, '<') !== false ||
			\dash\str::strpos($data, '>') !== false ||
			\dash\str::strpos($data, '?') !== false ||
			\dash\str::strpos($data, '*') !== false ||
			\dash\str::strpos($data, '|') !== false ||
			\dash\str::strpos($data, '\\') !== false

		  )
		{
			if($_notif)
			{
				\dash\notif::error(T_("Bad filename :val", ['val' => $_field_title]), ['element' => $_element, 'code' => 1750]);
				\dash\cleanse::$status = false;
			}
			return false;
		}

		return $data;
	}


	public static function staticfilename($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{
		$data = self::string($_data, $_notif, $_element, $_field_title, ['min' => 1, 'max' => 50]);

		if($data === false || $data === null)
		{
			return $data;
		}

		if(!preg_match("/^[A-Za-z0-9\.]+$/", $data))
		{
			if($_notif)
			{
				\dash\notif::error(T_("Only A-Za-z0-9. can use in filename"), ['element' => $_element, 'code' => 1750]);
				\dash\cleanse::$status = false;
			}
			return false;
		}

		if(\dash\str::strpos($data, '.') !== false)
		{
			if(substr_count($data, '.') > 1 )
			{
				if($_notif)
				{
					\dash\notif::error(T_("Can not use more than one dot character in filename"), ['element' => $_element, 'code' => 1750]);
					\dash\cleanse::$status = false;
				}
				return false;
			}

			if(\dash\str::strpos($data, '.txt') === false && \dash\str::strpos($data, '.text') === false && \dash\str::strpos($data, '.html') === false)
			{
				if($_notif)
				{
					\dash\notif::error(T_("Invlid filename"), ['element' => $_element, 'code' => 1750]);
					\dash\cleanse::$status = false;
				}
				return false;
			}
		}

		return $data;
	}


	public static function staticfilecontent($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{
		$data = self::string($_data, $_notif, $_element, $_field_title, ['min' => 1, 'max' => 100]);

		if($data === false || $data === null)
		{
			return $data;
		}

		if(!preg_match("/^[A-Za-z0-9\s\:\-\.\_]+$/", $data))
		{
			if($_notif)
			{
				\dash\notif::error(T_("Only A-Za-z0-9 Can be set on static file content"), ['element' => $_element, 'code' => 1750]);
				\dash\cleanse::$status = false;
			}
			return false;
		}

		return $data;
	}


	public static function intstring($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{
		$data = self::string($_data, $_notif, $_element, $_field_title, $_meta);

		if($data === false || $data === null)
		{
			return $data;
		}

		if(is_string($data))
		{
			$data    = \dash\utility\convert::to_en_number($data);
			$replace = ['{', '}', '(', ')', '_', '-', '+', ' ', ','];
			$data    = str_replace($replace, '', $data);
		}

		if(!preg_match("/^[0-9]+$/", $data))
		{
			if($_notif)
			{
				\dash\notif::error(T_("Only Numeric character can be enter in field :val", ['val' => $_field_title]), ['element' => $_element, 'code' => 1750]);
				\dash\cleanse::$status = false;
			}
			return false;
		}

		return $data;
	}


	public static function username($_data, $_notif = false, $_element = null, $_field_title = null)
	{

		$data = self::string($_data, $_notif, $_element, $_field_title, ['min' => 5, 'max' => 50]);

		if($data === false || $data === null)
		{
			return $data;
		}

		$data = \dash\utility\convert::to_en_number($data);

		$data_before = $data;

		$data = preg_replace("/\_{2,}/", "_", $data);
		$data = preg_replace("/\-{2,}/", "-", $data);
		$data = str_replace('_-',  '', $data);
		$data = str_replace('-_',  '', $data);

		$data = trim($data, '_-');

		$data = mb_strtolower($data);

		if(!$data)
		{
			if($_notif)
			{
				\dash\notif::error(T_("Username should contain a valid Latin letter"), ['element' => $_element, 'code' => 1750]);
				\dash\cleanse::$status = false;
			}
			return false;
		}

		if(mb_strlen($data_before) !== mb_strlen($data))
		{
			\dash\notif::warn(T_("We have removed _- characters from username"), ['element' => $_element, 'code' => 1700]);
		}

		// duble check because we remove some data
		if(mb_strlen($data) < 5)
		{
			if($_notif)
			{
				\dash\notif::error(T_("Field username must be larger than 5 character"), ['element' => $_element, 'code' => 1607]);
				\dash\cleanse::$status = false;
			}
			return false;

		}


		if(!preg_match("/^[A-Za-z0-9_-]+$/", $data))
		{
			if($_notif)
			{
				\dash\notif::error(T_("Only [A-Za-z0-9_-] can use in username"), ['element' => $_element, 'code' => 1750]);
				\dash\cleanse::$status = false;
			}
			return false;
		}

		if(!preg_match("/[A-Za-z]+/", $data))
		{
			if($_notif)
			{
				\dash\notif::error(T_("You must use a one character from [A-Za-z] in the username"), ['element' => $_element, 'code' => 1750]);
				\dash\cleanse::$status = false;
			}
			return false;
		}

		if(is_numeric($data))
		{
			if($_notif)
			{
				\dash\notif::error(T_("Username should contain a Latin letter"), ['element' => $_element, 'code' => 1750]);
				\dash\cleanse::$status = false;
			}
			return false;
		}

		if(is_numeric(substr($data, 0, 1)))
		{
			if($_notif)
			{
				\dash\notif::error(T_("The username must begin with latin letters"), ['element' => $_element, 'code' => 1750]);
				\dash\cleanse::$status = false;
			}
			return false;
		}


		return $data;
	}


	public static function discount_code($_data, $_notif = false, $_element = null, $_field_title = null)
	{

		$data = self::string($_data, $_notif, $_element, $_field_title, ['min' => 2, 'max' => 50]);

		if($data === false || $data === null)
		{
			return $data;
		}

		$data = \dash\utility\convert::to_en_number($data);

		$data_before = $data;

		$data = preg_replace("/\_{2,}/", "_", $data);
		$data = preg_replace("/\-{2,}/", "-", $data);
		$data = str_replace('_-',  '', $data);
		$data = str_replace('-_',  '', $data);

		$data = trim($data, '_-');

		$data = mb_strtolower($data);

		if(!$data)
		{
			if($_notif)
			{
				\dash\notif::error(T_("Discount code should contain a valid Latin letter"), ['element' => $_element, 'code' => 1750]);
				\dash\cleanse::$status = false;
			}
			return false;
		}

		if(mb_strlen($data_before) !== mb_strlen($data))
		{
			\dash\notif::warn(T_("We have removed _- characters from discount code"), ['element' => $_element, 'code' => 1700]);
		}

		// duble check because we remove some data
		if(mb_strlen($data) < 2)
		{
			if($_notif)
			{
				\dash\notif::error(T_("Field discount code must be larger than 2 character"), ['element' => $_element, 'code' => 1607]);
				\dash\cleanse::$status = false;
			}
			return false;

		}


		if(!preg_match("/^[A-Za-z0-9_-]+$/", $data))
		{
			if($_notif)
			{
				\dash\notif::error(T_("Only [A-Za-z0-9_-] can use in discount code"), ['element' => $_element, 'code' => 1750]);
				\dash\cleanse::$status = false;
			}
			return false;
		}


		if(is_numeric($data))
		{
			if($_notif)
			{
				\dash\notif::error(T_("Discount code should contain a Latin letter"), ['element' => $_element, 'code' => 1750]);
				\dash\cleanse::$status = false;
			}
			return false;
		}


		return $data;
	}



	public static function email_raw($_data, $_notif = false, $_element = null, $_field_title = null)
	{
		$data = self::email(...func_get_args());

		if($data === false || $data === null)
		{
			return $data;
		}

		$local_part = strtok($data, '@');
		$domain     = substr($data, \dash\str::strpos($data, '@'));

		if($domain === '@gmail.com')
		{
			if(\dash\str::strpos($local_part, '.') !== false)
			{
				$local_part = str_replace('.', '', $local_part);
			}
		}

		if(\dash\str::strpos($local_part, '+') !== false)
		{
			$local_part = strtok($local_part, '+');
		}

		$emailraw = $local_part. $domain;

		return $emailraw;
	}



	public static function email($_data, $_notif = false, $_element = null, $_field_title = null)
	{
		$data = self::string($_data, $_notif, $_element, $_field_title, ['min' => 5, 'max' => 50]);

		if($data === false || $data === null)
		{
			return $data;
		}

		if(!filter_var($data, FILTER_VALIDATE_EMAIL))
		{
			if($_notif)
			{
				\dash\notif::error(T_("Email is invalid"), ['element' => $_element, 'code' => 1605]);
				\dash\cleanse::$status = false;
			}
			return false;
		}

		// if(!preg_match("/^[A-Za-z0-9_\-\@\.]+$/", $data))
		// {
		// 	\dash\notif::error(T_("Only [A-Za-z0-9_-] can use in email"), ['element' => $_element, 'code' => 1750]);
		// 	\dash\cleanse::$status = false;
		// 	return false;
		// }

		if(preg_match("/@{2,}/", $data))
		{
			\dash\notif::error(T_("Email contain only one @ character!"), ['element' => $_element, 'code' => 1750]);
			\dash\cleanse::$status = false;
			return false;
		}

		if(preg_match("/\.\./", $data))
		{
			\dash\notif::error(T_("Invalid email!"), ['element' => $_element, 'code' => 1750]);
			\dash\cleanse::$status = false;
			return false;
		}

		return $data;
	}




	public static function html($_data, $_notif = false, $_element = null, $_field_title = null)
	{
		$data = self::string($_data, $_notif, $_element, $_field_title, ['html' => true, 'max' => 50000]);

		if($data === false || $data === null)
		{
			return $data;
		}

		return \dash\validate\html::html($data, $_notif, $_element, $_field_title, ['html' => true, 'max' => 50000]);
	}


	public static function html_basic($_data, $_notif = false, $_element = null, $_field_title = null)
	{
		$data = self::string($_data, $_notif, $_element, $_field_title, ['html' => true, 'max' => 50000]);

		if($data === false || $data === null)
		{
			return $data;
		}
		return \dash\validate\html::html_basic($data, $_notif, $_element, $_field_title, ['html' => true, 'max' => 50000]);
	}


	public static function html_full($_data, $_notif = false, $_element = null, $_field_title = null)
	{
		$data = self::string($_data, $_notif, $_element, $_field_title, ['html' => true, 'max' => 50000]);

		if($data === false || $data === null)
		{
			return $data;
		}
		return \dash\validate\html::html_full($data, $_notif, $_element, $_field_title, ['html' => true, 'max' => 50000]);
	}


	public static function search($_data, $_notif = false, $_element = null, $_field_title = null)
	{
		$data = self::string($_data, $_notif, $_element, $_field_title, ['min' => 1, 'max' => 100]);

		if($data === false || $data === null)
		{
			return $data;
		}

		// $data = \dash\str::urldecode($data);

		# $data = mb_ereg_replace('/([^ءئؤيكإأةآا-ی۰-۹a-z0-9A-Z\.\@\!\#\$\^\&\-\=\_\+\[\]\(\)]+/', ' ', $data);
		$data = preg_replace('/[^\p{L}\p{N}\.\@\!\#\$\^\&\-\=\_\+\[\]\(\)]/u', ' ', $data);
		$data = preg_replace("/\s{2,}/", " ", $data);
		$data = preg_replace("/\n/", " ", $data);
		$data = trim($data);

		return $data;
	}


	public static function md5($_data, $_notif = false, $_element = null, $_field_title = null)
	{
		$data = self::string($_data, $_notif, $_element, $_field_title);

		if($data === false || $data === null)
		{
			return $data;
		}

		if(mb_strlen($data) !== 32)
		{
			if($_notif)
			{
				\dash\notif::error(T_("Field :val must be exactly 32 character", ['val' => $_field_title]), ['element' => $_element]);
				\dash\cleanse::$status = false;
			}
			return false;
		}

		if(!preg_match("/^[A-Za-z0-9]+$/", $data))
		{
			if($_notif)
			{
				\dash\notif::error(T_("Invalid md5"), ['element' => $_element]);
				\dash\cleanse::$status = false;
			}
			return false;
		}

		return $data;
	}



	public static function language($_data, $_notif = false, $_element = null, $_field_title = null)
	{
		$data = self::string($_data, $_notif, $_element, $_field_title, ['min' => 2, 'max' => 2]);

		if($data === false || $data === null)
		{
			return $data;
		}

		if(!\dash\language::check($data))
		{
			if($_notif)
			{
				\dash\notif::error(T_("Invalid language"), ['element' => $_element]);
				\dash\cleanse::$status = false;
			}
			return false;
		}

		return $data;
	}


	public static function slug($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{
		$data = self::string($_data, $_notif, $_element, $_field_title);

		if($data === false || $data === null)
		{
			return $data;
		}

		// $rules   = true; // old config
		$rules   = 'persian';
		$splitor = null;

		if(array_key_exists('rules', $_meta))
		{
			$rules = $_meta['rules'];
		}

		if(isset($_meta['splitor']))
		{
			$splitor = $_meta['splitor'];
		}

		if($rules === true)
		{
			$slugify = new \dash\utility\slugify();
			$slugify->activateRuleset('persian');
			$data = $slugify->slugify($data);
		}
		elseif($rules === 'persian')
		{
			$data = mb_ereg_replace('([^ءئآا-ی۰-۹a-zA-Z0-9]|-)+', '-', $data);
			$data = trim($data, '-');
			$data = trim($data);
			$data = mb_strtolower($data);
		}
		else
		{
			$slugify = new \dash\utility\slugify();
			if($splitor)
			{
				$data = $slugify->slugify($data, $splitor);
			}
			else
			{
				$data = $slugify->slugify($data);
			}
		}


		$length = null;
		if(isset($_meta['max']) && is_numeric($_meta['max']))
		{
			$length = intval($_meta['max']);
		}

		if(!$length)
		{
			$length = 100000;
		}

		if(mb_strlen($data) > $length)
		{
			$data = mb_substr($data, 0, $length);
		}

		return $data;
	}


	public static function barcode($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{
		$data = self::string($_data, $_notif, $_element, $_field_title, ['min' => 1, 'max' => 50]);

		if($data === false || $data === null)
		{
			return $data;
		}

		$data_before = $data;

		$data = \dash\utility\convert::to_barcode($data);

		if($data != $data_before)
		{
			\dash\notif::warn(T_("Your barcode have wrong character. we change it. please check your product again"), 'barcode');
		}

		return $data;
	}


	public static function sku($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{
		$data = self::string($_data, $_notif, $_element, $_field_title, ['min' => 1, 'max' => 16]);

		if($data === false || $data === null)
		{
			return $data;
		}

		$data = \dash\utility\convert::to_en_number($data);

		$data = preg_replace("/\_{2,}/", "_", $data);
		$data = preg_replace("/\-{2,}/", "-", $data);

		if(mb_strlen($data) > 16)
		{
			\dash\notif::error(T_("Please set the sku less than 16 character"), 'sku');
			\dash\cleanse::$status = false;
			return false;
		}

		if(!preg_match("/^[A-Za-z0-9_\-]+$/", $data))
		{
			\dash\notif::error(T_("Only [A-Za-z0-9_-] can use in sku"), 'sku');
			\dash\cleanse::$status = false;
			return false;
		}

		return $data;
	}



	public static function url($_data, $_notif = false, $_element = null, $_field_title = null)
	{
		$data = self::string($_data, $_notif, $_element, $_field_title, ['min' => 4, 'max' => 300]);

		if($data === false || $data === null)
		{
			return $data;
		}

		if(!filter_var($data, FILTER_VALIDATE_URL))
		{
			if($_notif)
			{
				\dash\notif::error(T_("Url is invalid"), ['element' => $_element, 'code' => 1605]);
				\dash\cleanse::$status = false;
			}
			return false;
		}

		return $data;
	}

}
?>