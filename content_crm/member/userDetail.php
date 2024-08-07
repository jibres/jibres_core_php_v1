<?php
if(\dash\data::myUserID() === false)
{
  // we have not user id
  $myID = null;
}
else
{
  if(\dash\data::myUserID())
  {
    $myID = \dash\data::myUserID();
  }
  else
  {
    $myID   = \dash\request::get('id');
  }
}

if($myID)
{
  $myID = '?id='. $myID;
}

$myIcon = 'check';

switch (\dash\data::dataRowMember_status())
{
  case 'active' :      $myIcon = 'check ok'; break;
  case 'awaiting' :    $myIcon = 'detail'; break;
  case 'deactive' :    $myIcon = 'times'; break;
  case 'block' :       $myIcon = 'stop nok'; break;
  case 'unreachable' : $myIcon = 'times'; break;
  case 'filter' :      $myIcon = 'stop nok'; break;
  case 'removed' :     $myIcon = 'ban nok'; break;
  case 'ban' :         $myIcon = 'ban'; break;
}

if($myID)
{
?>
  <nav class="items long">
    <ul>
      <li>
        <a class="item f" href="<?php echo \dash\url::here(). '/member/glance'. $myID;?>">
          <img src="<?php echo \dash\fit::img(\dash\data::dataRowMember_avatar()); ?>">
          <div class="key"><?php echo \dash\data::dataRowMember_displayname();?></div>
          <div class="value"><?php echo T_(\dash\data::dataRowMember_status());?></div>
          <div class="value"><?php echo \dash\fit::mobile(\dash\data::dataRowMember_mobile());?></div>
          <div class="go <?php echo $myIcon ?>"></div>

        </a>
      </li>
    </ul>
  </nav>
<?php } // endif ?>
