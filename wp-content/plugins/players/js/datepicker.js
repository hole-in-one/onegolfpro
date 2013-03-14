jQuery(document).ready(function($) {

  if($('#date_joined').length)
  {
    $(function()
    {
      var pickerOpts = {
        dateFormat: "dd-mm-yy"
      };
      jQuery("#date_joined").datepicker(pickerOpts);
    });
  }

});