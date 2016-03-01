{literal}
<!DOCTYPE html>
<html lang="en">

<head>
	 <base href="https://www.liveaboardfleet.net/lodge/" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/ico/favicon.png">

    <title>Aggressor Safari Lodge</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <!-- Custom styles for this template -->
    <link href="assets/css/main.css" rel="stylesheet">
  	 <link rel="stylesheet" href="css/styles.css">

    <!-- jQuery -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

   <script src="jquery-ui-1.10.3/jquery-1.9.1.js"></script>
   <script src="js/bootstrap.js"></script>
   <link rel="stylesheet" href="jquery-ui-1.10.3/themes/base/jquery.ui.all.css">
   <script src="jquery-ui-1.10.3/ui/jquery.ui.core.js"></script>
   <script src="jquery-ui-1.10.3/ui/jquery.ui.widget.js"></script>
   <script src="jquery-ui-1.10.3/ui/jquery.ui.datepicker.js"></script>
   <script src="jquery-ui-1.10.3/ui/jquery.ui.menu.js"></script>
   <script src="jquery-ui-1.10.3/ui/jquery.ui.autocomplete.js"></script>
   <script src="jquery-ui-1.10.3/ui/jquery.ui.dialog.js"></script>
	<script src="js/script.js"></script>


	<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.0/css/bootstrap-toggle.min.css" rel="stylesheet">
	<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.0/js/bootstrap-toggle.min.js"></script>

   <script>

   $(function() {
      $( "#start_date" ).datepicker({ 
         dateFormat: "yy-mm-dd",
         changeMonth: true,
         changeYear: true,
         minDate: 0, 
         maxDate: "36M",
            onSelect: function (date) {
               var date1 = $('#start_date').datepicker('getDate');
               date1.setDate(date1.getDate() + 10);
               var date2 = $('#start_date').datepicker('getDate');
               date2.setDate(date2.getDate() + 60);
               $('#end_date').datepicker('setDate', date2);
               //sets minDate to dt1 date + 1
               $('#end_date').datepicker('option', 'minDate', date1);
            } 
      });
      $( "#end_date" ).datepicker({ 
         dateFormat: "yy-mm-dd",
         changeMonth: true,
         changeYear: true,
         minDate: "1M", 
         maxDate: "36M",
         onClose: function () {
            var dt1 = $('#start_date').datepicker('getDate');
            var dt2 = $('#end_date').datepicker('getDate');
            //check to prevent a user from entering a date below date of dt1
            if (dt2 <= dt1) {
                var minDate = $('#end_date').datepicker('option', 'minDate');
                $('#end_date').datepicker('setDate', minDate);
            }
        } 
      });

   });

	</script>

</head>
{/literal}

  <body>

    <!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Aggressor Safari L<i class="fa fa-circle"></i>DGE</a>
        </div>
      </div>
    </div>

   <div id="blue">
      <div class="container">
         <div class="row centered">
            <div class="col-lg-8 col-lg-offset-2">
            </div>
         </div><!-- row -->
      </div><!-- container -->
   </div><!-- blue wrap -->


   <div id="dg">
      <div class="container">
         <div class="row">
				<div id="main_element">

