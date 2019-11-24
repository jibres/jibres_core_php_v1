
function cleaveRunner()
{
  new Cleave('input[data-format="number"]',
  {
    numeral: true
  });

  new Cleave('input[data-format="int"]',
  {
    numericOnly: true,
    delimiter: ',',
  });

  new Cleave('input[data-format="toman"]',
  {
      numeral: true,
      prefix: 'تومان'
  });


  new Cleave('input[data-format="date"]',
  {
    date: true,
    datePattern: ['Y', 'm', 'd']
  });

  new Cleave('input[data-format="time"]',
  {
    time: true,
    timePattern: ['h', 'm']
  });


  new Cleave('input[data-format="creditCard"]',
  {
    creditCard: true
  });


  new Cleave('input[data-format="phone"]',
  {
    phone: true
  });

  new Cleave('input[data-format="phone-ir"]',
  {
    phone: true,
    phoneRegionCode: 'IR'
  });

}

