<section class="f" data-option='domain-irnic'>
<?php if(\dash\data::domainDetail_verify()){ ?>
  <div class="c8 s12">
<?php } else {?>
  <div class="c12">
<?php } ?>
    <div class="data">
      <h3><?php echo T_("Domain Holders");?></h3>
      <div class="body">
        <p><?php echo T_("Check detail of domain holders for IRNIC.");?></p>
      </div>
    </div>
  </div>
<?php if(\dash\data::domainDetail_verify()){ ?>
  <div class="c4 s12">
    <div class="action">
      <a class="btn primary" href="<?php echo \dash\url::that(). '/holder?domain='. \dash\request::get('domain') ?>"><?php echo T_("Manage Domain Holders") ?></a>
    </div>
  </div>
<?php } ?>


  <table class="tbl1 minimal">
    <thead>
      <tr>
        <th><?php echo T_("Type"); ?></th>
        <th><?php echo T_("Handle"); ?></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo T_("IRNIC holder"); ?></td>
        <td class="ltr"><?php echo \dash\data::domainDetail_holder(); ?></td>
      </tr>
      <tr>
        <td><?php echo T_("IRNIC admin"); ?></td>
        <td class="ltr"><?php echo \dash\data::domainDetail_admin(); ?></td>
      </tr>
      <tr>
        <td><?php echo T_("IRNIC billing"); ?></td>
<?php if(\dash\data::domainDetail_bill() === 'ji128-irnic') { ?>
        <td><img class="mRa10" src="<?php echo \dash\url::logo(); ?>" alt="<?php echo T_("Jibres"); ?>"><span class="compact s0"><?php echo \dash\data::domainDetail_bill(); ?></span></td>
<?php } else { ?>
        <td><span class="compact"><?php echo \dash\data::domainDetail_bill(); ?></span></td>
<?php } ?>
      </tr>
      <tr>
        <td><?php echo T_("IRNIC technical"); ?></td>
<?php if(\dash\data::domainDetail_bill() === 'ji128-irnic') { ?>
        <td><img class="mRa10" src="<?php echo \dash\url::logo(); ?>" alt="<?php echo T_("Jibres"); ?>"><span class="compact s0"><?php echo \dash\data::domainDetail_tech(); ?></span></td>
<?php } else { ?>
        <td><span class="compact"><?php echo \dash\data::domainDetail_tech(); ?></span></td>
<?php } ?>
      </tr>

    </tbody>
  </table>
</section>



<?php
$result = '';
$result .= '<nav class="items long2">';
  $result .= '<ul>';

    if(!\dash\data::internationalDomain())
    {
        $result .= '<li>';
          $result .= '<a class="f item" ';
          $go_class = 'detail';
          if(\dash\data::domainDetail_verify())
          {
            $go_class = 'go';
            $result .= 'href="'. \dash\url::that(). '/holder?domain='. \dash\request::get('domain'). '"';
          }
          $result .= '>';
          $result .= '<div class="key">'. T_("IRNIC holder"). '</div>';
          $result .= '<div class="value">'. \dash\data::domainDetail_holder(). '</div>';
          $result .= '<div class="go '.$go_class.'"></div>';
          $result .= '</a>';
          $result .= '</li>';

          $result .= '<li>';
          $result .= '<a class="f item" ';
          if(\dash\data::domainDetail_verify())
          {
            $result .= 'href="'. \dash\url::that(). '/holder?domain='. \dash\request::get('domain'). '"';
          }
          $result .= '>';
          $result .= '<div class="key">'. T_("IRNIC admin"). '</div>';
          $result .= '<div class="value">'. \dash\data::domainDetail_admin(). '</div>';
          $result .= '<div class="go '.$go_class.'"></div>';
          $result .= '</a>';
          $result .= '</li>';

          $result .= '<li>';
          $result .= '<a class="f item" ';
          if(\dash\data::domainDetail_verify())
          {
            $result .= 'href="'. \dash\url::that(). '/holder?domain='. \dash\request::get('domain'). '"';
          }
          $result .= '>';
          $result .= '<div class="key">'. T_("IRNIC billing"). '</div>';
          $result .= '<div class="value">'. \dash\data::domainDetail_bill(). '</div>';
          $result .= '<div class="go '.$go_class.'"></div>';
          $result .= '</a>';
          $result .= '</li>';

          $result .= '<li>';
          $result .= '<a class="f item" ';
          if(\dash\data::domainDetail_verify())
          {
            $result .= 'href="'. \dash\url::that(). '/holder?domain='. \dash\request::get('domain'). '"';
          }
          $result .= '>';
          $result .= '<div class="key">'. T_("IRNIC technical"). '</div>';
          $result .= '<div class="value">'. \dash\data::domainDetail_tech(). '</div>';
          $result .= '<div class="go '.$go_class.'"></div>';
          $result .= '</a>';
          $result .= '</li>';

        if(\dash\data::domainDetail_reseller())
        {
          $result .= '<li>';
          $result .= '<a class="f item">';
          $result .= '<div class="key">'. T_("Reseller"). '</div>';
          $result .= '<div class="value">'. \dash\data::domainDetail_reseller(). '</div>';
          $result .= '<div class="go detail ok"></div>';
          $result .= '</a>';
          $result .= '</li>';
        }

    }

$result .= '</ul>';
$result .= '</nav>';
?>