  <div class="scr">
<?php
if(\dash\url::subdomain() === 'developers')
{
 echo "<ul class='pT50'>";
 if(\dash\url::directory() === 'docs/api/v2')
 {
  require_once ('sidebar/sidebar-api-v2.php');
 }
 elseif(\dash\url::directory() === 'docs/irnic/r10')
 {
  require_once ('sidebar/sidebar-api-domain.php');
 }
 echo "</ul>";
}
else
{
  echo "<figure>";
  if(\dash\user::id())
  {
   $avatarLink = \dash\data::avatarLink();
   if(!$avatarLink)
   {
    $avatarLink = \dash\url::kingdom(). '/account';
   }

   echo "<a href='$avatarLink' title='". T_('Edit your profile'). "' class='avatar'>";
   if(\dash\user::detail('avatar'))
   {
    echo '<img src="'. \dash\user::detail('avatar'). '" alt="'. T_("Avatar of you"). ' '. \dash\user::detail('displayname') .'">';
   }
   elseif(\dash\user::id())
   {
     echo '<img src="'. \dash\url::siftal().'/images/default/avatar.png" alt='. T_("Default Avatar").'>';
   }
   else
   {

   }
   echo '</a>';
   echo '<figcaption>'. T_("Hello").' <b>'. \dash\user::detail('displayname'). '</b></figcaption>';
  }
  else
  {
   echo "<a href='". \dash\url::kingdom(). "/enter?referer=". \dash\url::current(). "' class='avatar'>";
   echo '<img src="'. \dash\url::cdn().'/img/avatar/guest.png" alt="'. T_("Default Avatar").'">';
   echo "</a>";
   echo '<figcaption> '. T_("Hello ").  ' <b> '. T_("dear GUEST!"). '</b></figcaption>';
  }
  echo "</figure>";

  echo '<nav>';
  {
    $mySidebar = \dash\panel::sidebar();
    if($mySidebar && is_array($mySidebar))
    {
      foreach ($mySidebar as $key => $item)
      {
        echo "<a";
        if(isset($item['link']))
        {
          echo ' href="'. $item['link']. '"';
        }
        // add class
        $class = null;
        if(isset($item['icon']))
        {
          $class = 'sf-'. $item['icon'];
        }
        if(isset($item['class']))
        {
          $class .= ' '.$item['class'];
        }
        if($class)
        {
          echo ' class="'. $class. '"';
        }

        if(isset($item['active']))
        {
          if($item['active'] === true)
          {
            echo ' data-active';
          }
          elseif($item['active'])
          {
            echo ' data-active="'. $item['active']. '"';
          }
        }
        echo ">";
        if(isset($item['img']))
        {
          echo '<img src="'. $item['img']. '" alt="'. $item['title']. '">';
        }
        if(isset($item['title']))
        {
          echo $item['title'];
        }
        echo "</a>";
      }
    }
  }
  echo '</nav>';
  echo '<hr>';


  echo '<div class="menu">';
  {
    echo '<ul class="sidenav">';
    {
      require_once ('admin-sidebar-frame.php');
    }
    echo '</ul>';
  }
  echo '</div>';
}
?>
  </div>
  <abbr class="toggleClean" title='<?php echo T_("Click to toggle sidebar status"); ?>'><span class="sf-arrows-out"></span></abbr>
  <a href="<?php echo \dash\url::sitelang() ?>" id='ermileBadge' class="f">
   <div class="cauto pRa10"><img src="<?php echo \dash\url::icon() ?>" alt='<?php echo T_("Jibres") ?>'></div>
   <div class="c"><h2><?php echo T_("Jibres") ?></h2><h3><?php echo T_("Sell & Enjoy") ?></h3></div>
  </a>