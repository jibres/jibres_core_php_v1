<?php
$cmsSetting = \lib\app\setting\get::cms_setting();
$subType = \dash\data::dataRow_subtype();
echo '<section class="postBlock" data-type="'. $subType. '">';
{

  echo '<div class="avand-md zero">';
  {
    echo \dash\layout\post\part::header($subType);
    echo \dash\layout\post\part::article();

  }

  echo '<hr>';
  echo '<hr>';
  echo '<hr>';
  echo '<div class="box">';

  if(\dash\data::dataRow_thumb())
  {
    echo '<a href="'.  \dash\data::dataRow_link(). '" class="thumb">';
    echo '<img src="'. \dash\fit::img(\dash\data::dataRow_thumb(), 1100). '" alt="'. \dash\data::dataRow_title(). '">';
    echo '</a>';
  }

  require_once('gallery-box.php');


  if(\dash\data::dataRow_datemodified())
  {
    echo '<div class="msg simple f mT20">';
    echo '<div class="c">';
    if(\dash\data::dataRow_showdate() === 'visible' || a($cmsSetting, 'defaultshowdate') === 'visible')
    {
      echo '<time class="ltr compact" datetime="'. \dash\data::dataRow_datemodified(). '">'. \dash\fit::date_time(\dash\data::dataRow_publishdate()). '</time>';
    }

    echo '</div>';
    echo '<div class="cauto os">';
    echo '<a data-copy="'.  \dash\url::kingdom(). '/n/'. \dash\data::dataRow_id(). '" href="'. \dash\url::kingdom(). '/n/'. \dash\data::dataRow_id(). '" title="'.  T_("For share via social networks"). '">'. T_("Short Code") .' <span class="txtB">' . \dash\data::dataRow_id(). '</span></a>';
    echo '</div>';
    echo '</div>';
  }


  $tags = \dash\data::dataRow_tags();
  if($tags && is_array($tags))
  {
    echo '<div class="tagBox msg simple">';
    foreach ($tags as $key => $value)
    {
      echo "<span class='btn'>";
      echo a($value, 'title');
      echo "</span> ";
    }

  echo '</div>';
  }
  echo '<div class="msg">';
  require_once('share-box.php');
  echo '</div>';

  $myPostSimilar = \dash\app\posts\search::similar_post(\dash\data::dataRow_id());
  if($myPostSimilar)
  {
    echo '<nav class="msg">';
    echo '<h4 class="mB20-f">'. T_("Recommended for you"). '</h4>';
    foreach ($myPostSimilar as $key => $value)
    {
      echo '<a class="block" href="'. a($value, 'link') .'">'. $value['title']. '</a>';
    }
    echo '</nav>';
  }
  echo '</div>';
  echo '</div>';


  // comment box
  {
    // add new comment
    if(\dash\data::dataRow_comment() === 'open' || ( \dash\data::dataRow_comment() === 'default' && a($cmsSetting, 'defaultcomment') === 'open' ))
    {
      require_once(core. 'layout/comment/comment-add.php');
    }
    // show list of comments
    require_once(core. 'layout/comment/comment-list.php');
  }

  // close avand
  echo '</div>';

}

// close post Block
echo '</section>';
?>