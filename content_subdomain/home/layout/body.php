<?php
if(\dash\data::postIsLoaded())
{
	require_once(__DIR__. '/body/body_load_post.php');
}
else
{
	// body generator
	$lines = \lib\app\website\body\get::line_list();

	foreach ($lines as $key => $line_detail)
	{
		if(isset($line_detail['publish']) && $line_detail['publish'])
		{
			if(isset($line_detail['type']))
			{
				$addr = __DIR__. '/body/'. $line_detail['type']. '.php';

				if(is_file($addr))
				{
					require($addr);
				}
			}
		}
	}

}
?>