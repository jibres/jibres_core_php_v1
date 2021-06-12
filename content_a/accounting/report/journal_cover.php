<style type="text/css">.page-break{page-break-after:always}</style>
<div class="printArea" data-size='A4'>
  <div class="m-80 fs12">
    <h4 class="txtC m-20"><?php if(\dash\url::subchild() === 'journal'){ echo T_("General Journal"); }else{echo T_("Ledger");} ?></h4>
    <h1 class="txtC"><?php echo \lib\store::title() ?></h1>
    <h2 class="txtC m-20"><?php echo a(\dash\data::currentYearDetail(), 'title') ?></h2>








  <table class="tbl1 v4">
    <tbody>
      <?php if(\lib\store::detail('companyeconomiccode')) {?>
      <tr>
        <th class=""><?php echo T_('Economic code') ?></th>
        <td class="collapsing txtL"><?php echo \dash\fit::text(\lib\store::detail('companyeconomiccode')) ?></td>
      </tr>
    <?php } //endif ?>
      <?php if(\lib\store::detail('companynationalid')) {?>
      <tr>
        <th class=""><?php echo T_('National ID') ?></th>
        <td class="collapsing txtL"><?php echo \dash\fit::text(\lib\store::detail('companynationalid')) ?></td>
      </tr>
    <?php } //endif ?>
      <?php if(\lib\store::detail('companyregisternumber')) {?>
      <tr>
        <th class=""><?php echo T_('Register number') ?></th>
        <td class="collapsing txtL"><?php echo \dash\fit::text(\lib\store::detail('companyregisternumber')) ?></td>
      </tr>
    <?php } //endif ?>
      <?php if(\lib\store::detail('postcode')) {?>
      <tr>
        <th class=""><?php echo T_('Postcode') ?></th>
        <td class="collapsing txtL"><?php echo \dash\fit::text(\lib\store::detail('postcode')) ?></td>
      </tr>
    <?php } //endif ?>

      <?php if(\lib\store::detail('phone')) {?>
      <tr>
        <th class=""><?php echo T_('Phone') ?></th>
        <td class="collapsing txtL"><?php echo \dash\fit::text(\lib\store::detail('phone')) ?></td>
      </tr>
    <?php } //endif ?>
    </tbody>
  </table>

  </div>
</div>
