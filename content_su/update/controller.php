<?php
namespace content_su\update;

class controller
{
	public static function routing()
	{
		$name         = \dash\request::get('git');
		if(!$name)
		{
			return;
		}

		$result = self::gitUpdate($name);
		if(is_array($result))
		{
			foreach ($result as $key => $value)
			{
				echo $value;
			}
		}


		\dash\code::boom();
	}


	public static function gitUpdate($_name, $_password = null)
	{
		$result   = [];
		if(!self::ping())
		{
			$result[] = "<h1>We have not any response from https://ermile.com!</h1>";

			return $result;
		}

		\dash\log::set('su_gitUpdateStart');
		// switch by name of repository
		switch ($_name)
		{

			case 'all':
				// pull current project
				$_name = \dash\url::root();
				$result[] = "<h1>$_name</h1>";
				$result[] = "<p>Project location is <b>". root. "</b></p><br><br>";
				$result[] =  \dash\utility\git::pull(root, false, $_password);
				break;


			default:
				// $result[] =  \dash\utility\git::pull(root, false, $_password);

				// return;
				break;
		}
		\dash\log::set('su_gitUpdate');
		return $result;
	}


	private static function ping($_url = null)
	{
	    if($_url === null)
	    {
	    	$_url = 'https://c.goni4.ermile.com';
	    }

	    $ch = curl_init($_url);
	    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    $data = curl_exec($ch);
	    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	    curl_close($ch);

	    if($httpcode >= 200 && $httpcode <= 301)
	    {
	        return true;
	    }
	    else
	    {
	        return false;
	    }
	}

}
?>