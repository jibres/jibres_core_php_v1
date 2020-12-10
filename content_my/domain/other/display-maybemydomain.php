
<?php $sortLink = \dash\data::sortLink(); ?>


<?php if (\dash\detect\device::detectPWA()) { ?>
<nav class="items">
  <ul>
    <?php foreach (\dash\data::dataTable() as $key => $value) {?>
     <li>
       <a class="item f" href="<?php echo \dash\url::this(); ?>/setting?domain=<?php echo a($value, 'name'); ?>">
        <div class="key"><code><?php echo a($value, 'name'); ?></code></div>
        <div class="go"></div>
      </a>
     </li>
    <?php } //endfor ?>
  </ul>
</nav>
<?php } else { ?>



<div class="fs12">
    <table class="tbl1 v1 responsive">
        <thead>
            <tr class="fs09">
                <th><?php echo T_("Domain"); ?></th>
                <th class=""><?php echo T_("Status"); ?></th>
                <th class="txtL"><?php echo T_("Expire date"); ?></th>
                <th class="txtL"><?php echo T_("Create date"); ?><br><?php echo T_("Date modified"); ?></th>
                <th class="txtL"><?php echo T_("DNS"); ?></th>
            </tr>
        </thead>
        <tbody class="fs12">

            <?php foreach (\dash\data::dataTable() as $key => $value) {?>

            <tr <?php  if(a($value, 'status') === 'disable') { echo 'class="negative"'; }?> >
                <td>
                    <!-- <a target="_blank" href="http://<?php echo a($value, 'name'); ?>"><i class="sf-link"></i></a> -->
                    <a href="<?php echo \dash\url::this(); ?>/setting?domain=<?php echo a($value, 'name'); ?>" class="link flex"> <i class="sf-edit"></i> <code><?php echo a($value, 'name'); ?></code></a>
                </td>

                <td class="">
                  <?php echo a($value, 'status_html'); ?>
                    <a href="<?php echo \dash\url::this(). '/setting?domain='. a($value, 'name'); ?>">
                    <div class="ibtn x30 wide"><?php echo '<span>'.T_("Autorenew"). '</span>'; if(isset($value['autorenew']) && $value['autorenew']) { echo '<i class="sf-refresh fc-blue"></i>'; } else{ echo '<i class="sf-times fc-red"></i>'; }?></div>
                    </a>
                </td>

                <td class="collapsing txtL fs09"><?php echo \dash\fit::date(a($value, 'dateexpire')); ?></td>
                <td class="collapsing txtL fs09">
                  <div><?php echo \dash\fit::date(a($value, 'dateregister')); ?></div>
                  <div><?php echo \dash\fit::date(a($value, 'dateupdate')); ?></div>
                </td>
                <td class="collapsing ltr txtL">
                    <code><?php echo a($value, 'ns1'); ?></code>
                    <br>
                    <code><?php echo a($value, 'ns2'); ?></code>
                </td>

            </tr>
            <?php } //endfor ?>
        </tbody>
    </table>
</div>
<?php } //endif ?>
<?php \dash\utility\pagination::html(); ?>