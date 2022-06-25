<?php
$html = '';
$html .= '<div class="avand productPage">';
{
  $html .= '<div class="box">';
  {
    $html .= '<div class="row">';
    {
      $html .= '<div class="c-xs-12 c-auto">';
      {
        require_once('blocks/gallery.php');
      }
      $html .= '</div>';

      $html .= '<div class="c-xs-12 c">';
      {
        require_once('blocks/detail.php');
      }
      $html .= '</div>';
    }
    $html .= '</div>';
  }
  $html .= '</div>';

  if(\dash\data::dataRow_desc())
  {
    $html .= '<div class="box productDesc">';
    {
      $html .= \dash\data::dataRow_desc();
    }
    $html .= '</div>';
  }

  require_once('blocks/sharebox.php');

  require_once('blocks/property.php');

  // post comment echo the html
  // need echo html on current level and reset it
  echo $html;
  $html = '';


  if(\dash\data::productSettingSaved_comment())
  {
    \dash\temp::set('set_product_comment', true);
    require_once(core. 'layout/comment/comment-add.php');
  } //endif comment is closed

  require_once(core. 'layout/comment/comment-list.php');

  if(\dash\data::similarProduct())
  {
    $html .= '<h2 class="font-bold leading-6 mb-5 text-center text-lg md:text-xl lg:text-2xl">'. T_("Related products"). '</h2>';
    $optCard =
    [
      'grid' => true,
    ];
    $_args = [];
    $html .= \content_site\body\product\p3_html::html($_args,\dash\data::similarProduct());
  }

  echo $html;

}
echo '</div>';

?>