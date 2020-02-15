
function insideIframe()
{
  if (top.location != self.location)
  {
    $('body').attr('data-iframe', '');
    self.location = "https://jibres.com/static/page/iframe";
  }
};

