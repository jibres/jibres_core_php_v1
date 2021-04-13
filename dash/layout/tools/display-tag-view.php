<div class="avand-md">
<?php

  $myPostByThisCat = \dash\app\posts\search::by_tag_id(\dash\data::dataRow_id());

  if($myPostByThisCat)
  {
    echo "<article class='postListPreview'>";

    foreach ($myPostByThisCat as $key => $value)
    {
      echo "<section class='f'>";
      if(isset($value['thumb']))
      {
        echo "<div class='cauto s12 pRa10 txtC'><a href='$value[link]'><img src='". $value['thumb']. "' alt='$value[title]' width='100px'></a></div>";
      }
      echo "<div class='c s12'><h3><a href='$value[link]'>$value[title]</a></h3><p>$value[excerpt]</p></div>";

      echo "</section>";
    }
    echo "</article>";

    \dash\utility\pagination::html();
  }
?>
</div>