<?php

$add_html_form      = isset($add_html_form); // check defined this variable
$is_auto_send       = isset($is_auto_send) && $is_auto_send;
$product_suggestion = isset($product_suggestion) && $product_suggestion;
$gallery_capacity   = isset($gallery_capacity) ? $gallery_capacity : 100;

if(!isset($gallery_array) || (isset($gallery_array) && !is_array($gallery_array)))
{
  $gallery_array = [];
}

$chooseTxt = T_('Drag &amp; Drop your files or Browse');
if(\dash\detect\device::detectPWA())
{
  $chooseTxt = T_('Choose File');
}

$html = '';

if($add_html_form)
{
 $html .= '<form method="post" autocomplete="off">';
}

$html .= '<div class="box">';
{
  $html .= '<div class="pad1">';
  {
      if(is_array($gallery_array) && count($gallery_array) > $gallery_capacity)
      {
        $html .= '<div class="msg minimal mB0 warn2">'. T_("Gallery is full!"). '</div>';
      }
      else
      {
        $html .= '<div ';
        $html .= 'data-uploader ';
        $html .= 'data-max-w="1600" ';
        $html .= 'data-max-h="1600" ';
        $html .= 'data-file-max-size='. \dash\data::maxFileSize() .' ';
        $html .= \dash\data::ratioHtml();
        if(isset($gallery_special_attr))
        {
          $html .= $gallery_special_attr;
        }
        $html .= 'data-name="gallery" ';
        if(isset($gallery_is_not_free) && $gallery_is_not_free)
        {
          /*nothing*/
        }
        else
        {
          $html .= 'data-ratio-free ';
        }
        $html .= 'data-type="gallery" ';
        if($is_auto_send)
        {
          $html .= 'data-autoSend ';
        }
        $html .= '>';

        $html .= '<input type="file" id="file1">';
        $html .= '<label for="file1">';
        $html .= '<div class="block">'. T_("Gallery"). '</div>';
        $html .= '<abbr>'. $chooseTxt. '</abbr>';
        $html .= '<small class="fc-mute block">'. T_("Maximum file size"). ' '. \dash\data::maxFileSizeTitle(). '</small>';
        $html .= '</label>';
        if($gallery_array)
        {
          $html .= '<div class="previewList">';
          $html .= '<div class="row">';
          foreach ($gallery_array as $key => $value)
          {

            $myGalleryClass = 'c-xs-6 c-sm-4 c-md-3 c-lg-3 c-xxl-2';
            switch (a($value, 'type'))
            {
              case 'video':
                $myGalleryClass = 'c-xs-12 c-sm-12 c-md-6 c-xxl-4';
                break;

              case 'audio':
                $myGalleryClass = 'c-xs-12 c-sm-12';
                break;
            }

            $html .= '<div class="fileItem '. $myGalleryClass. '" data-removeElement data-type="'. a($value, 'type'). '">';
            if(a($value, 'type') === 'video')
            {
              $html .= '<video controls>';
              $html .= '<source src="'. a($value, 'path'). '" type="'. a($value, 'mime'). '">';
              $html .= '</video>';
            }
            else if(a($value, 'type') === 'audio')
            {
              $html .= '<audio controls>';
              $html .= '<source src="'. a($value, 'path'). '" type="'. a($value, 'mime'). '">';
              $html .= '</audio>';
            }
            else if(a($value, 'type') === 'image')
            {
             $html .= '<img src="'. \dash\fit::img(a($value, 'path'), 460). '" alt="'. a(\dash\data::dataRow(), 'title'). '">';
            }
            else if(a($value, 'type') === 'pdf')
            {
              $html .= '<div class="file"><a target="_blank" href="'. a($value, 'path'). '"><i class="sf-file-pdf-o"></i>' . T_("PDF"). '</a></div>';
            }
            else if(a($value, 'type') === 'zip')
            {
             $html .= '<div class="file"><a target="_blank" href="'. a($value, 'path'). '"><i class="sf-file-archive-o"></i>'. T_("ZIP"). '</a></div>';
            }
            else
            {
             $html .= '<div class="file"><a target="_blank" href="'. a($value, 'path'). '"><i class="sf-file-o"></i>'. T_("File"). '</a></div>';
            }
            $html .= '<div>';
            $html .= '<div class="imageDel" data-ajaxify data-data=\'{"fileaction": "remove", "fileid" : "'. a($value, 'id').'"}\'></div>';
            $html .= '</div>';
            $html .= '</div>';
          }
          $html .= '</div>';
          $html .= '</div>';

        }
        $html .= '</div>';
      }
  }

  $html .= '</div>';

  if(isset($no_footer) && $no_footer)
  {
   /*nothing*/
  }
  else
  {
    $html .= '<footer>';
    {
      $html .= '<div class="row">';
      {
        $html .= '<div class="cauto">';
        if(isset($choose_gallery_link))
        {
          $html .= '<a class="link" href="'. $choose_gallery_link .'">'. T_("Choose from gallery").'</a>';
        }
        if($product_suggestion)
        {
          $html .= '<div class="link" data-ajaxify data-data=\'{"runaction_product_suggestion" : 1, "product_suggestion": "'. !$product_suggestion_status.'"}\' data-kerkere=".showProductSuggestion" >'. T_("Image suggestion"). '</div>';
        }
        $html .= '</div>';
        $html .= '<div class="c"></div>';
        $html .= '<div class="cauto">';
        {
          $html .= \dash\data::convertPostTo();

          if(count($gallery) >= 2)
          {
            $html .= '<a class="block" href="'. \dash\url::this().'/gallerysort?'. \dash\request::fix_get() .'" class="link">'. T_("Sort Gallery"). '</a>';
          }
        }
        $html .= '</div>';
      }
      $html .= '</div>';
    }
    $html .= '</footer>';
  }
}
$html .= '</div>';

if($add_html_form)
{
 $html .= '</form>';
}

echo $html;

unset($html);

?>