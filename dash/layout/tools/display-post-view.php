<?php

$dataRow = \dash\data::dataRow();
echo '<div class="avand">';
echo '<div class="box">';
echo '<div class="body">';
echo '<h2>';
echo \dash\data::dataRow_title();
echo '</h2>';
if(\dash\data::dataRow_subtitle())
{
  echo '<h4>';
  echo \dash\data::dataRow_subtitle();
  echo '</h4>';
}
if(\dash\data::dataRow_thumb())
{
  echo '<a href="'.  \dash\data::dataRow_link(). '" class="thumb">';
  echo '<img src="'. \dash\data::dataRow_thumb(). '" alt="'. \dash\data::dataRow_title(). '">';
  echo '</a>';
}

echo '<div>';
echo \dash\data::dataRow_content();
echo '</div>';


if(isset($dataRow['gallery_array']) && is_array($dataRow['gallery_array']))
{
  echo '<div class="gallery" id="lightgallery">';
  foreach ($dataRow['gallery_array'] as $key => $myUrl)
  {
    if(isset($myUrl['path']))
    {
      $endUrl = substr($myUrl['path'], -4);
      if(in_array($endUrl, ['.jpg', '.png', '.gif']))
      {
        echo '<a data-action href="'. $myUrl['path'].'"><img src="'. $myUrl['path']. '" alt="'. \dash\data::dataRow_title(). '"></a>';
      }
    }
  }
  echo '</div>';

  echo '<div class="gallery2">';
  foreach ($dataRow['gallery_array'] as $key => $myUrl)
  {
    if(isset($myUrl['path']))
    {
      $endUrl = substr($myUrl['path'], -4);
      if(in_array($endUrl, ['.mp4']))
      {
        echo '<video controls><source src="'. $myUrl['path']. '" type="video/mp4"></video>';
      }
      elseif(in_array($endUrl, ['.mp3']))
      {
        echo '<audio controls><source src="'. $myUrl['path'] .'" type="audio/mpeg"></audio>';
      }
      elseif(in_array($endUrl, ['.pdf']))
      {
        echo '<a href="'. $myUrl['path'] .'" class="btn lg mT25 primary">'. T_("Download"). ' '. T_("PDF"). '</a>';
      }
    }
  }
  echo '</div>';
}

if(\dash\data::dataRow_datemodified())
{

echo '<div class="msg simple f mT20">';
echo '<div class="c"><time class="ltr compact" datetime="'. \dash\data::dataRow_datemodified(). '">'. \dash\fit::date_time(\dash\data::dataRow_publishdate()). '</time></div>';
echo '<div class="cauto os">';
echo '<a data-copy="'.  \dash\url::kingdom(). '/n/'. \dash\data::dataRow_id(). '" href="'. \dash\url::kingdom(). '/n/'. \dash\data::dataRow_id(). '" title="'.  T_("For share via social networks"). '">'. T_("Short Code") .' <span class="txtB">' . \dash\data::dataRow_id(). '</span></a>';
echo '</div>';
echo '</div>';
}


if(a($dataRow, 'tags') && is_array(a($dataRow, 'tags')))
{
  echo '<div class="tagBox msg simple">';
  foreach ($dataRow['tags'] as $key => $value)
  {
    echo "<span class='btn'>";
    echo a($value, 'title');
    echo "</span> ";
  }

echo '</div>';
}

$myPostSimilar = []; // \dash\app\posts\get::get_post_list['mode' => 'similar', 'post_id' => \dash\data::dataRow_id()]);
if($myPostSimilar)
{
  echo '<nav class="msg">';
  echo '<h4 class="mB20-f">'. T_("Recommended for you"). '</h4>';
  foreach ($myPostSimilar as $key => $value)
  {
    echo '<a class="block" href="'. \dash\url::kingdom().'/n/'. \dash\data::dataRow_id().'">'. $value['title']. '</a>';
  }
  echo '</nav>';
}
if(\dash\data::dataRow_comment() === 'open')
{
  require_once('display-add-comment.php');
}
require_once('display-comment-list.php');


echo '</div>';
echo '</div>';
echo '</div>';

?>