<?php
if(\dash\data::dataTable())
{
?>

  <ul class="items long">
    <?php foreach (\dash\data::dataTable() as $key => $value)
    {
    ?>

    <li class="multiLine">
      <div class="f item" <?php if(\dash\permission::supervisor()){echo 'title="'. \dash\get::index($value, 'caller'). '"';}?>>

        <?php if(!isset($value['readdate'])) {?><i class="sf-new-sign"><?php echo T_("New"); ?></i><?php }?>

        <i class="<?php if(isset($value['icon']) && $value['icon']) { echo 'sf-'. $value['icon']. ' '; }else{ echo 'sf-heart '; } if(isset($value['iconClass']) && $value['iconClass']) { echo $value['iconClass']; }?>" title='<?php if(isset($value['cat']))  { echo $value['cat']; }?>'></i>

        <div class="key fit txtB c-xs-0"><?php if(isset($value['title']))
          {
            echo $value['title'];
          }
          elseif(isset($value['caller']))
          {
            echo $value['caller'];
          } ?></div>

          <div class="key grow excerpt" data-excerpt>
            <?php if(isset($value['excerpt']) && $value['excerpt']) {?>
              <?php echo $value['excerpt']; ?>
            <?php } // endif ?>
            <?php if(isset($value['txt']) && $value['txt']) {?>
            <div><?php echo $value['txt']; ?></div>
            <?php } // endif ?>
          </div>


        <div class="value c-xs-0" title="<?php echo \dash\fit::date($value['datecreated']); ?>"><?php echo \dash\fit::date_human($value['datecreated']); ?></div>

        <?php if(isset($value['sms']) && $value['sms']) {?>
          <i class="sf-envelope style2 c-xs-0" title='<?php echo T_("Sended via SMS"); ?>'></i>
        <?php } //endif ?>
        <?php if(isset($value['telegram']) && $value['telegram']) {?>
          <i class="sf-paper-plane style2 c-xs-0" title='<?php echo T_("Sended via Telegram"); ?>'></i>
        <?php } //endif ?>

      </div>
    </li>
    <?php } //endfor ?>
  </ul>
<?php
\dash\utility\pagination::html();
}
else
{
?>

<p class="fs14 msg success2 pTB20"><?php echo T_("Hi!"); ?> <?php echo T_("No notifications found"); ?></p>

<?php
} //endif
?>
