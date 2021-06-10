<?php
namespace dash\waf\gate\toys;
/**
 * dash main configure
 */
class contain
{
	public static function word($_text, $_find)
	{
		$myTxt = $_text;
		if(strpos($myTxt, $_find) !== false)
		{
			return true;
		}

		if($myTxt !== ($decode2 = urldecode($myTxt)))
		{
			if(strpos($decode2, $_find) !== false)
			{
				return true;
			}

			if($decode2 !== ($decode3 = urldecode($decode2)))
			{
				if(strpos($decode3, $_find) !== false)
				{
					return true;
				}

				if($decode3 !== ($decode4 = urldecode($decode3)))
				{
					if(strpos($decode4, $_find) !== false)
					{
						return true;
					}

					if($decode4 !== urldecode($decode4))
					{
						return true;
					}
				}
			}
		}

		return false;
	}
}
?>
