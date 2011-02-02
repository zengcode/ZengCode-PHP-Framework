<html style="background-color: buttonface; color: buttontext;">
<head>
<meta http-equiv="content-type" content="text/xml; charset=utf-8" />
<title>Simple calendar setups [popup calendar]</title>
  <link rel="stylesheet" type="text/css" media="all" href="calendar-win2k-cold-1.css" title="win2k-cold-1" />
  <script type="text/javascript" src="calendar.js"></script>
  <script type="text/javascript" src="lang/calendar-th.js"></script>
  <script type="text/javascript" src="calendar-setup.js"></script>
</head>
<body>

<form action="#" method="get">
<input type="hidden" name="show_date" id="show_date"  />
<input type="text" name="date" id="date" onchange="toThai(this.value,'show_date');" />
<button type="reset" id="f_trigger_b">เลือกวัน</button>
</form>
<script type="text/javascript">
    Calendar.setup({
        inputField     :    "date",      // id of the input field
        ifFormat       :    "%Y-%m-%d",       // format of the input field
        showsTime      :    false,            // will display a time selector
        button         :    "f_trigger_b",   // trigger for the calendar (button ID)
        singleClick    :    false,           // double-click mode
        step           :    1                // show all years in drop-down boxes (instead of every other year as default)
    });
</script>



<hr />

</body>
</html>
