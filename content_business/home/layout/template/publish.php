<div class="blogEx sample">
<?php
$website = \dash\data::website();

if(isset($website['lines']['list']) && is_array($website['lines']['list']))
{

	foreach ($website['lines']['list'] as $key => $value)
	{

    if(isset($value['type']) && is_string($value['type']))
    {
  		$addr = root. 'content_business/home/layout/body/'. $value['type']. '.php';
  		if(is_file($addr))
  		{
  			require_once($addr);
  		}
    }
	}
}


if(isset($website['footer']['active']))
{
  $addr = root. 'content_business/home/layout/footer/'. $website['footer']['active']. '.php';
  if(is_file($addr))
  {
    require_once($addr);
  }
}

?>
</div>