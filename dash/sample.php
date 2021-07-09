<?php
namespace dash;

class sample
{
	public static function avatar($_type = null)
	{
		$url = \dash\url::cdn(). '/img/avatar/';

		$semantic = ['1', '2', '3'];
		$man      = ['man', 'man2', 'man3', 'man4', 'man5'];
		$woman    = ['woman', 'woman-simple'];
		$other    = ['baby', 'default', 'guest', 'man-sample', 'unknown'];
		$data     = array_merge($semantic, $man, $woman, $other);

		$choosen  = null ;
		if(in_array($_type, $data))
		{
			$choosen = $_type;
		}
		else
		{
			$choosen = $data[array_rand($data)];
		}

		$url .= $choosen;
		$url .= '.png';

		return $url;
	}


	/**
	 * [unsplash description]
	 * @param  [type] $_dimensions some width and height like 800x600
	 * @param  [type] $_search     [description]
	 * @return [type]              [description]
	 */
	public static function unsplash($_dimensions = null, $_search = null)
	{
		$url = 'https://source.unsplash.com/';
		$url .= $_dimensions. '/';

		if($_search === 'daily')
		{
			$url .= $_search;
		}
		elseif($_search === 'weekly')
		{
			$url .= $_search;
		}
		else
		{
			$url .= '?'. $_search;
		}

		return $url;
	}
}
?>
