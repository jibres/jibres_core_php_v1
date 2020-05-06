<?php
if(\dash\data::postIsLoaded())
{
	require_once('body_load_post.php');
}
else
{
	$body_raw = \lib\app\website\body\generator::body_raw();
	if($body_raw)
	{
		$addr = __DIR__. '/'. $body_raw. '.php';
		if(is_file($addr))
		{
			require_once($addr);
		}
	}
	else
	{
		// body generator
		$lines = \lib\app\website\body\generator::lines();

		foreach ($lines as $key => $value)
		{
			if(isset($value['type']))
			{
				$addr = __DIR__. '/'. $value['type']. '.php';
				if(is_file($addr))
				{
					require($addr);
				}
			}
		}
	}
}
?>