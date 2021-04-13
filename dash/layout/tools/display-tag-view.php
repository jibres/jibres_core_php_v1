<div class="postBlock">

 <div class="avand-lg">
<?php

  $myPostByThisCat = \dash\app\posts\search::by_tag_id(\dash\data::dataRow_id());

  if($myPostByThisCat)
  {
    echo "<article class='postList'>";

    foreach ($myPostByThisCat as $key => $value)
    {
      echo "<div class='text'>";
      echo "<section class='f'>";
      if(isset($value['thumb']))
      {
        echo "<div class='cauto s12 pRa10 txtC'><a href='$value[link]'><img class='box100' src='". $value['thumb']. "' alt='$value[title]'></a></div>";
      }
      echo "<div class='c s12'><h3><a href='$value[link]'>$value[title]</a></h3><p>$value[excerpt]</p></div>";

      echo "</section>";
      echo "</div>";
    }
    echo "</article>";

    \dash\utility\pagination::html();
  }
?>
 </div>
</div>