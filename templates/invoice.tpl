<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=320, initial-scale=1" />
  <title>{$reservationID}</title>
  <style type="text/css">

    /* ----- Client Fixes ----- */

    /* Force Outlook to provide a "view in browser" message */
    #outlook a {
      padding: 0;
    }

    /* Force Hotmail to display emails at full width */
    .ReadMsgBody {
      width: 100%;
    }

    .ExternalClass {
      width: 100%;
    }

    /* Force Hotmail to display normal line spacing */
    .ExternalClass,
    .ExternalClass p,
    .ExternalClass span,
    .ExternalClass font,
    .ExternalClass td,
    .ExternalClass div {
      line-height: 100%;
    }


     /* Prevent WebKit and Windows mobile changing default text sizes */
    body, table, td, p, a, li, blockquote {
      -webkit-text-size-adjust: 100%;
      -ms-text-size-adjust: 100%;
    }

    /* Remove spacing between tables in Outlook 2007 and up */
    table, td {
      mso-table-lspace: 0pt;
      mso-table-rspace: 0pt;
    }

    /* Allow smoother rendering of resized image in Internet Explorer */
    img {
      -ms-interpolation-mode: bicubic;
    }

     /* ----- Reset ----- */

    html,
    body,
    .body-wrap,
    .body-wrap-cell {
      margin: 0;
      padding: 0;
      background: #ffffff;
      font-family: Arial, Helvetica, sans-serif;
      font-size: 14px;
      color: #464646;
      text-align: left;
    }

    img {
      border: 0;
      line-height: 100%;
      outline: none;
      text-decoration: none;
    }

    table {
      border-collapse: collapse !important;
    }

    td, th {
      text-align: left;
      font-family: Arial, Helvetica, sans-serif;
      font-size: 14px;
      color: #464646;
      line-height:1.5em;
    }

    b a,
    .footer a {
      text-decoration: none;
      color: #464646;
    }

    a.blue-link {
      color: blue;
      text-decoration: underline;
    }

    /* ----- General ----- */

    td.center {
      text-align: center;
    }

    .left {
      text-align: left;
    }

    .body-padding {
      padding: 24px 40px 40px;
    }

    .border-bottom {
      border-bottom: 1px solid #D8D8D8;
    }

    table.full-width-gmail-android {
      width: 100% !important;
    }


    /* ----- Header ----- */
    .header {
      font-weight: bold;
      font-size: 16px;
      line-height: 16px;
      height: 16px;
      padding-top: 19px;
      padding-bottom: 7px;
    }

    .header a {
      color: #464646;
      text-decoration: none;
    }

    /* ----- Footer ----- */

    .footer a {
      font-size: 12px;
    }
  </style>

  <style type="text/css" media="only screen and (max-width: 650px)">
    @media only screen and (max-width: 650px) {
      * {
        font-size: 16px !important;
      }

      table[class*="w320"] {
        width: 320px !important;
      }

      td[class="mobile-center"],
      div[class="mobile-center"] {
        text-align: center !important;
      }

      td[class*="body-padding"] {
        padding: 20px !important;
      }

      td[class="mobile"] {
        text-align: right;
        vertical-align: top;
      }
    }
  </style>

</head>
<body style="padding:0; margin:0; display:block; background:#ffffff; -webkit-text-size-adjust:none">

{if $print eq "Yes"}
<script>
window.print();
</script>
{/if}

<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
 <td valign="top" align="left" width="100%" style="background:#f9f8f8;">
 <center>

   <table class="w320 full-width-gmail-android" bgcolor="#f9f8f8" style="background-color:transparent" cellpadding="0" cellspacing="0" border="0" width="100%">
      <tr>
        <td width="100%" height="48" valign="top">
            <!--[if gte mso 9]>
            <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="mso-width-percent:1000;height:49px;">
              <v:fill type="tile" src="https://www.filepicker.io/api/file/al80sTOMSEi5bKdmCgp2" color="#ffffff" />
              <v:textbox inset="0,0,0,0">
            <![endif]-->
              <table class="full-width-gmail-android" cellspacing="0" cellpadding="0" border="0" width="100%">
                <tr>
                  <td class="header center" width="100%">
                    <a href="#">
                      <img src="https://www.liveaboardfleet.net/lodge/assets/img/logo.png">
                    </a>
                  </td>
                </tr>
              </table>
            <!--[if gte mso 9]>
              </v:textbox>
            </v:rect>
            <![endif]-->
        </td>
      </tr>
    </table>

    <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#ffffff">
      <tr>
        <td align="center">
          <center>
            <table class="w320" cellspacing="0" cellpadding="0" width="500">
              <tr>
                <td class="body-padding mobile-padding">

                <table cellspacing="0" cellpadding="0" width="100%">
                  <tr>
                  <td class="left" style="padding-bottom:20px; text-align:left; vertical-align: text-top;">
                    <b>Invoice Date:</b> {$date}<br><br>

		    {if $company ne ""}
			{$company}<br>
		    {/if}

                    {$first} {$last}<br>
                    {$address1}<br>
                    {if $address2 ne ""}
                    {$address2}<br>
                    {/if}
                    {$city}, {$state}{$province} {$zip}<br>
                    {$country}<br>

                  </td>
                  <td class="right" style="padding-bottom:20px; text-align:right; vertical-align: text-top;">
                    <h2>Confirmation # {$reservationID}</h2>
                    <b>Mail Payments to:</b><br>
                    WayneWorks Marine, LLC<br>
                    209 Hudson Trace<br>
                    Augusta, GA 30907<br>
                    USA<br>


                  </td>
                  </tr>
                </table>



                <table cellspacing="0" cellpadding="0" width="100%">
                <tr><td class="border-bottom" height="5" colspan="2"><h2>Reservation Details</h2></td></tr>

                <tr><td><b>Tents</b></td><td class="right" style="padding-bottom:5px; text-align:right; vertical-align: text-top;">{$tents}</td></tr>
                <tr><td><b>Nights</b></td><td class="right" style="padding-bottom:5px; text-align:right; vertical-align: text-top;">{$nights}</td></tr>
                <tr><td><b>Check-In</b></td><td class="right" style="padding-bottom:5px; text-align:right; vertical-align: text-top;">{$begin_date}</td></tr>
                <tr><td><b>Check-Out</b></td><td class="right" style="padding-bottom:5px; text-align:right; vertical-align: text-top;">{$end_date}</td></tr>


                <tr><td colspan="2"><br></td></tr>

                <tr><td class="border-bottom" height="5" colspan="2"><h2>Balance Summary</h2></td></tr>
                <tr><td><b>Lodge Rate:</b></td><td class="right" style="padding-bottom:5px; text-align:right; vertical-align: text-top;">${$rate}</td></tr>
                <tr><td><b>Line Items/Transfers:</b></td><td class="right" style="padding-bottom:5px; text-align:right; vertical-align: text-top;">${$line}</td></tr>
                <tr><td><b>Payments:</b></td><td class="right" style="padding-bottom:5px; text-align:right; vertical-align: text-top;">${$payments}</td></tr>
                <tr><td><b>Discounts:</b></td><td class="right" style="padding-bottom:5px; text-align:right; vertical-align: text-top;">${$discounts}</td></tr>
                <tr><td><b>Amount Due:</b></td><td class="right" style="padding-bottom:5px; text-align:right; vertical-align: text-top;">${$amount_due}</td></tr>


                </table>




                

                </td>
              </tr>
            </table>
          </center>
        </td>
      </tr>
    </table>

    <table class="w320" bgcolor="#E5E5E5" cellpadding="0" cellspacing="0" border="0" width="100%">
      <tr>
        <td style="border-top:1px solid #B3B3B3;" align="center">
          <center>
            <table class="w320" cellspacing="0" cellpadding="0" width="500" bgcolor="#E5E5E5">
              <tr>
                <td>
                  <table cellpadding="0" cellspacing="0" width="100%" bgcolor="#E5E5E5">
                    <tr>
                      <td class="center" style="padding:25px; text-align:center;">
                        <b>info@aggressor.com</b> <br>US & Canada: 800-348-2628 <br>International: + 1 706-933-2531
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </center>
        </td>
      </tr>
 
    </table>

  </center>
  </td>
</tr>
</table>
</body>
</html>
