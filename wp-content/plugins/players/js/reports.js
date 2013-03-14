jQuery(document).ready(function($) {

  if($('#incident_date').length)
  {
    $(function()
    {
      var pickerOpts = {
        dateFormat: "dd-mm-yy"
      };
      jQuery("#incident_date").datepicker(pickerOpts);
    });

  }

});