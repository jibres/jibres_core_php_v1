<?php
function wow_number($number, $_customClass = null)
{
  if($number === null)
  {
    $number = '';
  }
  $number = str_replace(',', '', $number);
  $number_split = str_split($number);
  $number_split = array_reverse($number_split);
  // if(count($number_split) < 14)
  // {
  //   for ($i=1; $i <= 14 - count($number_split) ; $i++)
  //   {
  //     array_push($number_split, '-');
  //   }
  // }

  $html = '';
  for ($i=1; $i <= 14 ; $i++)
  {
    $tdClass = 'ltr text-center font-14';
    $style = "width:10px;";
    if($_customClass)
    {
      $tdClass .= ' '. $_customClass;
    }
    if($_customClass === 'border-t-4')
    {
      $style .= 'border-top-color: rgba(156, 163, 175, var(--tw-border-opacity));';
    }
    elseif($_customClass === 'border-b-4')
    {
      $style .= 'border-bottom-color: rgba(156, 163, 175, var(--tw-border-opacity));';
    }

    switch ($i)
    {
      case 1:
      case 2:
      case 3:
      case 7:
      case 8:
      case 9:
      case 13:
        $tdClass .= ' bg-gray-200 border-solid border-s border-gray-300';
        break;

      case 4:
      case 5:
      case 6:
      case 10:
      case 11:
      case 12:
        $tdClass .= ' bg-white border-solid border-s border-gray-300';
        break;

      case 14:
        $tdClass .= ' bg-gray-200 border-solid border-s border-gray-700';
        break;

      default:
        break;
    }

    $html .= '<td style="'. $style. '" class="'. $tdClass. '" data-col='. $i. '>';
    if(isset($number_split[$i]))
    {
      $html .= \dash\fit::number($number_split[$i]);
    }
    else
    {
      $html .= '&nbsp;';
    }
    $html .= '</td>';

  }
  echo $html;

}
?>