<?php
namespace dash\sample;

class img
{
	public static function avatar($_type = null)
	{
		$url = \dash\url::cdn(). '/img/avatar/';

		$semantic = ['1', '2', '3'];
		$man      = ['man', 'man2', 'man3', 'man4', 'man5'];
		$woman    = ['woman', 'woman-simple'];
		$other    = ['default', 'guest', 'man-simple', 'unknown'];
		$data     = array_merge($semantic, $man, $woman, $other);

		$choosen  = null ;
		if(in_array($_type, $data))
		{
			$choosen = $_type;
		}
		elseif($_type === 'semantic')
		{
			$choosen = $semantic[array_rand($semantic)];
		}
		elseif($_type === 'man')
		{
			$choosen = $man[array_rand($man)];
		}
		elseif($_type === 'woman')
		{
			$choosen = $woman[array_rand($woman)];
		}
		else
		{
			$choosen = $data[array_rand($data)];
		}

		$url .= $choosen;
		$url .= '.png';

		return $url;
	}



	public static function image()
	{
		$rand = rand(1, 313);
		$name = str_pad($rand, 3, '0', STR_PAD_LEFT);
		$url  = \dash\url::cdn(). '/img/sample/bg-'. $name. '.jpg';
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
		if($_dimensions)
		{
			$url .= $_dimensions. '/';
		}

		if($_search === 'daily')
		{
			$url .= $_search;
		}
		elseif($_search === 'weekly')
		{
			$url .= $_search;
		}
		elseif($_search === null)
		{
			$url .=  'random';
		}
		else
		{
			if(!$_dimensions)
			{
				$url .= 'featured';
			}

			$url .= '?'. $_search;
		}

		return $url;
	}




	public static function product()
	{

	}


	public static function post()
	{

	}


	public static function video()
	{

	}


	public static function podcast()
	{

	}
}
?>
