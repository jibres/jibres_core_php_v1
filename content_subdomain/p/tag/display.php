<div class="jibresBanner">
 <div class="avand">

<div class="blogEx">




<?php

  if(\dash\data::datarow_type() === 'cat')
  {
    $myPostByThisCat = \dash\app\posts::get_post_list(['cat' => \dash\data::datarow_slug()]);
  }
  elseif(\dash\data::datarow_type() === 'tag')
  {
    $myPostByThisCat = \dash\app\posts::get_post_list(['tag' => \dash\data::datarow_slug()]);
  }

  if($myPostByThisCat)
  {
    echo "<article class='postListPreview'>";

    foreach ($myPostByThisCat as $key => $value)
    {
      echo "<section class='f'>";
      if(isset($value['meta']['thumb']))
      {
        echo "<div class='cauto s12 pRa10 txtC'><a href='$value[link]'><img src='". $value['meta']['thumb']. "' alt='$value[title]' width='100px'></a></div>";
      }
      echo "<div class='c s12'><h3><a href='$value[link]'>$value[title]</a></h3><p>$value[excerpt]</p></div>";

      echo "</section>";
    }
    echo "</article>";
  }

?>




















</div>
</div>