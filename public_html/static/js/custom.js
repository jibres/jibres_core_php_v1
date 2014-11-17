      $("#mobile-number").intlTelInput({
        //autoFormat: false,
        //autoHideDialCode: false,
        defaultCountry: "ir",
        // nationalMode: true,
        numberType: "MOBILE",
        //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        preferredCountries: ['ir'],
        // responsiveDropdown: true,
        utilsScript: "static/js/intlTelInput-utils.js"
      });
