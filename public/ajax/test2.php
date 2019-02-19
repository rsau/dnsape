<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>DNS Tools | Ajax DNS</title>
	<link rel="stylesheet" href="style2.css" type="text/css" />
	<!--[if IE]>
		<link rel="stylesheet" href="ie7-style.css" type="text/css" />
	<![endif]-->
	<!--[if lt IE 7]>
		<link rel="stylesheet" href="ie6-style.css" type="text/css" />
		<script type="text/javascript">
			IE7_PNG_SUFFIX = "_trans.png";
		</script>
		<script src="ie7/ie7-standard-p.js" type="text/javascript"></script>
	<![endif]-->
	<script type="text/javascript" src="ajaxdns.js"></script>
</head>
<body onload="<?php
if ($_GET['domain']) {
	$domain = $_GET['domain'];
	$action = $_GET['action'];
	echo "document.getElementById('URL').value = '".$domain."';";
	switch ($action) {
		case 'dns':
			echo "dnsrecords();";
			break;
		case 'whois':
			echo "whois();";
			break;
		case 'ipwhois':
			echo "ipwhois();";
			break;
		case 'httpheaders':
			echo "httpheaders();";
			break;
		case 'rbl':
			echo "rbl();";
			break;
		case 'ping':
			echo "ping();";
			break;
		case 'traversal':
			echo "traversal();";
			break;
	}
}
?>">
<div id="scroller" align="center">
	<div id="header">
	<table cellpadding="10" cellspacing="0" align="center">
		<tr style="vertical-align:middle;">
			<td><div id="logo"><a href="http://www.ajaxdns.com"><img src="images/logo_trans.png" border="0" alt="DNS Tools | Ajax DNS" title="Ajax DNS Beta" /></a></div></td>
			<td><div id="form"><input id="URL" value="<?php echo GetHostByName($REMOTE_ADDR); ?>" type="text" onkeyup="enteredIt(event);" onfocus="focused();this.focus();this.select();" onblur="unfocused();"/></div><div id="toplinks" align="right" style="font-size:8pt;"><a href="javascript:linkPage();">Link Page</a> | <a href="http://digg.com/design/Ajax_DNS_tools">Digg us!</a></div></td>
		</tr>
	</table>
	</div>
	<div id="menu">
	<div id="holder">
		<div class="menuitem" id="tm-live" onmouseover="hover('tm-live');" onmouseout="unhover('tm-live');" onclick="dnsrecords();"></div>
		<div class="menuitem" id="tm-whois" onmouseover="hover('tm-whois');" onmouseout="unhover('tm-whois');" onclick="whois();"></div>
		<div class="menuitem" id="tm-ipwhois" onmouseover="hover('tm-ipwhois');" onmouseout="unhover('tm-ipwhois');" onclick="ipwhois();"></div>
		<div class="menuitem" id="tm-httpheaders" onmouseover="hover('tm-httpheaders');" onmouseout="unhover('tm-httpheaders');" onclick="httpheaders();"></div>
		<div class="menuitem" id="tm-rbl" onmouseover="hover('tm-rbl');" onmouseout="unhover('tm-rbl');" onclick="rbl();"></div>
		<div class="menuitem" id="tm-ping" onmouseover="hover('tm-ping');" onmouseout="unhover('tm-ping');" onclick="ping();"></div>
		<div class="menuitem" id="tm-traversal" onmouseover="hover('tm-traversal');" onmouseout="unhover('tm-traversal');" onclick="traversal();"></div>
		<br style="clear:both" />
	</div>
</div>
<div id="dnsinformation">
	<div id="busy">
		<div style="float:left;"><img src="images/ship_load_ing.gif" alt="tenships" width="135" height="97" />
		</div>
	</div>

<div class="results">
<div style="text-align:center;">
</div>
<div align="left">
	<h1>DNS Tools</h1>
	<h2>Live DNS</h2>
	<p>See all <i>DNS records</i> and <i>Reverse DNS records</i> for a domain.</p>
	<h2>Whois Search</h2>
	<p>Shows both <i>registry</i> and <i>registrar</i> results for a domain.</p>
	<h2>IP Whois</h2>
	<p>Shows the RIR (Regional Internet Registry) results for the <i>IP address</i> owner.</p>
	<h2>HTTP Headers</h2>
	<p>Shows server returned <i>HTTP Headers</i> for domain or IP address.  Traverses redirects as well, great for troubleshooting <i>.htaccess</i> and Apache issues.</p>
	<h2>RBL Search</h2>
	<p>Searches several <i>SPAM Listing</i> databases to see if your domain and/or IP address if listed.  Great to troubleshoot mail delivery problems.</p>
	<h2>Ping</h2>
	<p><i>Ping a domain or IP address</i> to check if online.</p>
	<h2>DNS Traversal</h2>
	<p>Checks <i>root nameservers</i> for NS records for your domain.  Helpful to troubleshoot propagation issues.</p>
	</div>
	
	</div>
	<div align="center" style="font-size:10pt;color:#ffffff;"><a href="http://www.mabushosting.net/index2.php?page=vpsservers">VPS servers</a>? <a href="http://www.tenships.com/custom-web-design.php">Custom web design</a>? Oh my!</div>
</div>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-66926-2";
urchinTracker();
</script>
<div id="tlas"><a href="http://www.buyyourcar.co.uk/" target="blank" >Used Cars &amp; New Cars</a> - <a href="http://yoprofilepimp.com" target="blank" >Hot New Myspace Layouts and Codes</a></div>
</div>
</body>	
</html>
