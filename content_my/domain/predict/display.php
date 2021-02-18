<?php if(\dash\data::myPayCalc() && is_array(\dash\data::myPayCalc())) {?>
<div class="row">
    <?php foreach (\dash\data::myPayCalc() as $period => $value) {?>
       <div class="c">
            <a class="stat x70" href="<?php echo \dash\url::that(). '?until='. a($value, 'key'); ?>">
                <h3><?php echo a($value, 'title'); ?> <?php if(a($value, 'count')) { echo '<span>( '. \dash\fit::number(a($value, 'count')). ' '. T_('Domain'). ' )</span>';} ?></h3>
                <div class="val"><?php echo \dash\fit::number(a($value, 'price')); ?></div>
            </a>
        </div>
    <?php }//endfor ?>

</div>
<?php } ?>


<?php
$result = '';

$result .= '<nav class="items ltr">';
$result .= '<ul>';
foreach (\dash\data::dataTable() as $key => $value)
{
    $result .= '<li>';
    $result .= '<a class="f item" href="'. \dash\url::this(). '/setting?domain='. a($value, 'name'). '">';
    $result .= '<div class="key">'. a($value, 'name'). '</div>';
    $result .= '<div class="value"><span class="s0">'. T_("Renew amount"). '</span> '.\dash\fit::number(a($value, 'renew_price')).' '. \lib\currency::unit(). '</div> ';

    if(isset($value['autorenew']) && $value['autorenew'])
    {
      $result .= '<div title="'. T_("Autorenew is active").'" class="value s0"><i class="sf-refresh fc-blue"></i></div>';
    }
    else
    {
      $result .= '<div title="'. T_("Autorenew is deactive").'" class="value s0"><i class="sf-refresh fc-mute"></i></div>';
    }

    $result .= '<time class="value datetime s0" title="'.T_("Expire date").'">'. \dash\fit::date(a($value, 'dateexpire')). '</time>';

    $result .= '<div class="go s0 '. a($value, 'status_icon') .'"></div>';

    $result .= '</a>';
    $result .= '</li>';
}
$result .= '</ul>';
$result .= '</nav>';

echo $result;

\dash\utility\pagination::html();
?>