$(document).ready(function () {
    hideFields();

    $(".fields-toggle").change(function () {
        $("."+this.value).toggleClass('hide');
    });

    $("#options-link").click(function () {
        $("#meta").toggleClass('hide');
    });

});

function hideFields() {
    $("input:checkbox:checked").each(function()
    {
        $("."+$(this).val()).removeClass('hide');
    }
);}















// ******************************************************** declare mobile input
$("#mobile").intlTelInput({
//autoFormat: false,
//autoHideDialCode: false,
defaultCountry: "ir",
// defaultCountry: "auto",
// nationalMode: true,
// numberType: "MOBILE",
//onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
preferredCountries: ['ir'],
// responsiveDropdown: true,
// utilsScript: "static/js/intlTelInput-utils.js"
});