<?php
if(\dash\data::dataTable())
{
?>

  <table class="tbl1 v1 fs13 responsive">
    <tbody>

      <?php foreach (\dash\data::dataTable() as $key => $value)
      {
      ?>

      <tr>
        <td class="collapsing type"><i class="<?php if(isset($value['icon']) && $value['icon']) { echo 'sf-'. $value['icon']. ' '; }else{ echo 'sf-heart '; } if(isset($value['iconClass']) && $value['iconClass']) { echo $value['iconClass']; }?> style1" title='<?php if(isset($value['cat']))  { echo $value['cat']; }?>'></i></td>
        <td class="subject">
          <div class="f">
            <div class="c s12">
              <div class="title">
                <?php if(isset($value['title'])) { echo $value['title']; }elseif(isset($value['caller'])){ echo $value['caller'];} ?>
                <?php if(!isset($value['readdate'])) {?><span class="mLa5 badge danger"><?php echo T_("New"); ?></span><?php }//endif ?>
              </div>

              <?php if(isset($value['excerpt']) && $value['excerpt']) {?>
              <div class="excerpt txtCut">
                <?php echo $value['excerpt']; ?>
              </div>
              <?php } // endif ?>

              <?php if(isset($value['txt']) && $value['txt']) {?>
              <div class="detail">
                  <?php echo $value['txt']; ?>
              </div>
              <?php } // endif ?>
            </div>
            <div class="cauto s12">
              <?php if(\dash\permission::supervisor()) {?><pre class="mT10 badge light fs08 floatRa"><?php echo \dash\get::index($value, 'caller'); ?></pre><?php }//endif ?>
            </div>
          </div>


        </td>
        <td class="collapsing via txtC">

            <?php if(isset($value['sms']) && $value['sms']) {?>
              <i class="sf-envelope style2" title='<?php echo T_("Sended via SMS"); ?>'></i>
            <?php } //endif ?>
            <?php if(isset($value['telegram']) && $value['telegram']) {?>
              <i class="sf-paper-plane style2" title='<?php echo T_("Sended via Telegram"); ?>'></i>
            <?php } //endif ?>

        </td>
        <td class="collapsing date txtRa">
          <span title="<?php echo \dash\fit::date($value['datecreated']); ?>"><?php echo \dash\fit::date_human($value['datecreated']); ?></span>
        </td>
      </tr>
      <?php } //endfor ?>
    </tbody>
  </table>


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
