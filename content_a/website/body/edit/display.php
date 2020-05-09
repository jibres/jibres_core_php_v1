<?php
if(is_array(\dash\data::lineOption_contain()))
{
  foreach (\dash\data::lineOption_contain() as $box => $box_detail)
  {
    if(is_string($box))
    {
      if(is_array($box_detail))
      {
        $addr = root. 'content_a/website/body/box/'. $box. '.php';
        if(is_file($addr))
        {
          require_once($addr);
        }
      }
    }
  }
}
?>