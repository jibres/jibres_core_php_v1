<div class="postBlock">
 <div class="avand-lg">
<?php
$myPostByThisCat = \dash\app\posts\search::by_tag_id(\dash\data::dataRow_id());

if($myPostByThisCat)
{
  echo "<article class='postList'>";

  foreach ($myPostByThisCat as $key => $value)
  {
    if(\dash\detect\device::detectPWA())
    {
      echo "<nav class='items'>";
      {
        echo "<ul>";
        {
          echo "<li>";
          {
            echo "<a class='f item' href='". $value['link']. "'>";
            {
              if(isset($value['thumb']))
              {
                echo "<img src='". $value['thumb']. "' alt='". $value['title']. "'>";
              }

              echo "<div class='key'>";
              echo $value['title'];
              echo "</div>";
            }
            echo "</a>";
          }
          echo "</li>";
        }
        echo "</ul>";
      }
      echo "</nav>";
    }
    else
    {
      echo "<div class='text'>";
      {
        echo "<section class='f'>";
        if(isset($value['thumb']))
        {
          echo "<div class='cauto s12 pRa10 txtC'>";
          {
            echo "<a href='". $value['link']. "'>";
            echo "<img src='". $value['thumb']. "' alt='". $value['title']. "'>";
            echo "</a>";
          }
          echo "</div>";
        }
        echo "<div class='c s12'>";
        {
          echo "<h3>";
          echo "<a href='$value[link]'>$value[title]</a>";
          echo "</h3>";
          echo "<p>$value[excerpt]</p>";
        }
        echo "</div>";

        echo "</section>";
      }
      echo "</div>";
    }
  }
  // show pagination
  \dash\utility\pagination::html();
  echo "</article>";
}
else
{
  // tag is empty
}
?>
 </div>
</div>