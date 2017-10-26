<?php

$GLOBAL['path'] = "/home/livenet/www/lodge";
$GLOBAL['domain'] = "https://reservations.aggressorsafarilodge.com/";
define ('PATH',$GLOBAL['path']);

// email headers - This is fine tuned, please do not modify
$sitename = "Aggressor Safarie Lodge";
$site_email = "info@aggressor.com";

$header = "MIME-Version: 1.0\r\n";
$header .= "Content-type: text/html; charset=iso-8859-1\r\n";
$header .= "From: $sitename <$site_email>\r\n";
$header .= "Reply-To: $sitename <$site_email>\r\n";
$header .= "X-Priority: 3\r\n";
$header .= "X-Mailer: PHP/" . phpversion()."\r\n";
define('header_email',$header);
?>
