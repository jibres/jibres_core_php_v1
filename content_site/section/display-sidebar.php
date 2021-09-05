<?php

$html     = '';

$html .= '<div data-xhr="sitebuilderOptionXhr">';

if(\dash\data::sidebarSectionList())
{
 require_once('part/preview_list.php');
}
elseif(\dash\data::groupSectionList())
{
  if(\dash\data::changeSectionModel())
  {
    // nothing
  }
  else
  {
   require_once('part/section_group.php');
  }
}
else
{
  /**
   * Load options of one section
   */

  $currentSectionDetail = \dash\data::currentSectionDetail();

  if(a($currentSectionDetail, 'status_preview') === 'deleted')
  {
     require_once('part/restore.php');
  }
  else
  {


    $options_list = \dash\data::currentOptionList();
    $child        = \dash\url::child();
    $subchild     = \dash\url::subchild();
    $folder       = \dash\data::currentSectionDetail_mode();
    $dir3         = \dash\url::dir(3);

    if($subchild && isset($options_list[$subchild]) && is_array($options_list[$subchild]))
    {
      foreach ($options_list[$subchild] as $key => $option)
      {
        if(is_array($option))
        {
            if($dir3 && isset($options_list[$subchild][$dir3]) && is_array($options_list[$subchild][$dir3]))
            {
              foreach ($options_list[$subchild][$dir3] as $k => $v)
              {
                $html .= \content_site\call_function::option_admin_html($v, $currentSectionDetail);
              }
            }
            else
            {
              $html .= \content_site\call_function::option_admin_html($key, $currentSectionDetail);
            }
        }
        else
        {
          $html .= \content_site\call_function::option_admin_html($option, $currentSectionDetail);
        }
      }
    }
    elseif(is_array($options_list))
    {
      foreach ($options_list as $key => $option)
      {
        if($key === 'msg')
        {
          $html .= \content_site\call_function::option_admin_html($key, $option);
        }
        elseif(is_string($option))
        {
          $html .= \content_site\call_function::option_admin_html($option, $currentSectionDetail);
        }
        elseif(is_array($option))
        {
          $html .= \content_site\call_function::option_admin_html($key, $currentSectionDetail);
        }
      }

    }
    // close ul li if need
    $html .= \content_site\utility::ul_li_close();
  }

 require_once('part/discard.php');
}

$html .= '</div>';

// require_once('part/download_php.php');

echo $html;

?>