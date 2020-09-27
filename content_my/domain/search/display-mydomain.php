<?php $sortLink = \dash\data::sortLink(); ?>


<?php if (\dash\detect\device::detectPWA()) { ?>
<nav class="items">
  <ul>
    <?php foreach (\dash\data::dataTable() as $key => $value) {?>
     <li>
       <a class="item f" href="<?php echo \dash\url::this(); ?>/setting?domain=<?php echo \dash\get::index($value, 'name'); ?>">
        <div class="key"><code><?php echo \dash\get::index($value, 'name'); ?></code></div>
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
                <th colspan="2"><?php echo T_("Domain"); ?></th>
                <th class="txtC"><?php echo T_("Status"); ?></th>
                <th class="txtL"><?php echo T_("Expire date"); ?></th>
                <th class="txtL"><?php echo T_("Create date"); ?><br><?php echo T_("Date modified"); ?></th>
                <th class="txtL"><?php echo T_("DNS"); ?></th>
            </tr>
        </thead>
        <tbody class="fs12">

            <?php foreach (\dash\data::dataTable() as $key => $value) {?>

            <tr <?php  if(\dash\get::index($value, 'status') === 'disable') { echo 'class="negative"'; }?> >
                <td>
                    <!-- <a target="_blank" href="http://<?php echo \dash\get::index($value, 'name'); ?>"><i class="sf-link"></i></a> -->
                    <a href="<?php echo \dash\url::this(); ?>/setting?domain=<?php echo \dash\get::index($value, 'name'); ?>" class="link flex"> <i class="sf-edit"></i> <code><?php echo \dash\get::index($value, 'name'); ?></code></a>
                </td>
                <td class="collapsing">

                    <a <?php if(\dash\get::index($value, 'verify')) {?> href="<?php echo \dash\url::this(). '/setting/transfer?domain='. \dash\get::index($value, 'name'); ?>" <?php } //endif ?>>
                        <div class="ibtn x30 wide">
                            <?php if(isset($value['lock']) && $value['lock'] == 1 ) { echo '<span>'.T_("Lock"). '</span>'; echo '<i class="sf-lock fc-green"></i>'; } elseif(isset($value['lock']) && $value['lock'] == 0){ echo '<span>'.T_("Lock"). '</span>'; echo '<i class="sf-unlock fc-red"></i>'; }else{echo '<span>'.T_("Unknown"). '</span>'; echo '<i class="sf-lock"></i>';}?>
                        </div>
                    </a>

                    <a href="<?php echo \dash\url::this(). '/setting?domain='. \dash\get::index($value, 'name'); ?>">
                    <div class="ibtn x30 wide"><?php echo '<span>'.T_("Autorenew"). '</span>'; if(isset($value['autorenew']) && $value['autorenew']) { echo '<i class="sf-refresh fc-blue"></i>'; } else{ echo '<i class="sf-times fc-red"></i>'; }?></div>
                    </a>
                </td>
                <td class="txtC">
                  <?php echo \dash\get::index($value, 'status_html'); ?>
                </td>
                <td class="collapsing txtL fs09"><?php echo \dash\fit::date(\dash\get::index($value, 'dateexpire')); ?></td>
                <td class="collapsing txtL fs09">
                  <div><?php echo \dash\fit::date(\dash\get::index($value, 'dateregister')); ?></div>
                  <div><?php echo \dash\fit::date(\dash\get::index($value, 'dateupdate')); ?></div>
                </td>
                <td class="collapsing ltr txtL">
                    <code><?php echo \dash\get::index($value, 'ns1'); ?></code>
                    <br>
                    <code><?php echo \dash\get::index($value, 'ns2'); ?></code>
                </td>

            </tr>
            <?php } //endfor ?>
        </tbody>
    </table>
</div>
<?php } //endif ?>
<?php \dash\utility\pagination::html(); ?>