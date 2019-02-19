<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>DNS Tools | Ajax DNS</title>
<link rel="stylesheet" href="ajax/style.css" type="text/css" />
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
<script type="text/javascript" src="ajax/ajaxdns.js"></script>
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
			<td><div id="logo"><a href="http://www.ajaxdns.com"/><img src="ajax/images/logo_trans.png" border="0" alt="DNS Tools | Ajax DNS" title="Ajax DNS Beta" /></a></div></td>
			<td><div id="form"><input id="URL" value="<?php echo GetHostByName($REMOTE_ADDR); ?>" type="text" onkeyup="enteredIt(event);" onFocus="focused();this.focus();this.select();" onblur="unfocused();"/></div><div id="toplinks" align="right" style="font-size:8pt;"><a href="javascript:linkPage();">Link Page</a> | <a href="http://ajaxdns.com/ajaxdns_widget.zip" target="_new">OS X Dashboard Widget</a> | <a href="http://www.boxvps.com/chat/livehelp.php?department=2&amp;serversession=1&amp;pingtimes=15" target="_new">Instant Live Chat</a><span style="color:yellow;"> (new)</span></div></td>
		</tr>
	</table>
	</div>
	<div id="menu">
	<div id="holder" align="center">
		<table cellpadding="0" cellspacing="0">
			<tr>
				<td><a href="javascript:dnsrecords();"><span class="live"><div id="tm-live" onmouseover="hover('tm-live');" onmouseout="unhover('tm-live');"></div></span></a></td>
				<td><a href="javascript:whois();"><span class="live"><div id="tm-whois" onmouseover="hover('tm-whois');" onmouseout="unhover('tm-whois');"></div></span></a></td>
				<td><a href="javascript:ipwhois();"><span class="live"><div id="tm-ipwhois" onmouseover="hover('tm-ipwhois');" onmouseout="unhover('tm-ipwhois');"></div></span></a></td>
				<td><a href="javascript:httpheaders();"><span class="live"><div id="tm-httpheaders" onmouseover="hover('tm-httpheaders');" onmouseout="unhover('tm-httpheaders');"></div></span></a></td>
				<td><a href="javascript:rbl();"><span class="live"><div id="tm-rbl" onmouseover="hover('tm-rbl');" onmouseout="unhover('tm-rbl');"></div></span></a></td>
				<td><a href="javascript:ping();"><span class="live"><div id="tm-ping" onmouseover="hover('tm-ping');" onmouseout="unhover('tm-ping');"></div></span></a></td>
				<td><a href="javascript:traversal();"><span class="live"><div id="tm-traversal" onmouseover="hover('tm-traversal');" onmouseout="unhover('tm-traversal');"></div></span></a></td>
			</tr>
		</table>
		</div>
	</div>
</div>
<div id="dnsinformation">
	<div id="busy">
		<div style="float:left;"><img src="ajax/images/ship_load_ing.gif" alt="tenships" width="135" height="97" />
		</div>
	</div>

<p style="font-family:sans-serif;"><center>
	<br/>
	<table cellpadding="0" cellspacing="0" align="center"><tr><td class="tl"></td><td class="top"></td><td class="tr"></td></tr><tr><td class="left"></td><td class="nav" align="center"><div class="results">
<div style="text-align:center;">
<?php

function tla_ads() {

$CONNECTION_TIMEOUT = 10;

$LOCAL_XML_FILENAME = "local_84484.xml";

if( !file_exists($LOCAL_XML_FILENAME) ) die("Text Link Ads script error: $LOCAL_XML_FILENAME does not exist. Please create a blank file named $LOCAL_XML_FILENAME.");
if( !is_writable($LOCAL_XML_FILENAME) ) die("Text Link Ads script error: $LOCAL_XML_FILENAME is not writable. Please set write permissions on $LOCAL_XML_FILENAME.");

if( filemtime($LOCAL_XML_FILENAME) < (time() - 3600) || filesize($LOCAL_XML_FILENAME) < 20) {
$request_uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : "";
$user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "";
tla_updateLocalXML("http://www.text-link-ads.com/xml.php?inventory_key=Q1CIADJ83AO5YT9CNSQ8&referer=" . urlencode($request_uri) ."&user_agent=" . urlencode($user_agent), $LOCAL_XML_FILENAME, $CONNECTION_TIMEOUT);
}

$xml = tla_getLocalXML($LOCAL_XML_FILENAME);

$arr_xml = tla_decodeXML($xml);

if ( is_array($arr_xml) ) {
echo "\n<ul style=\"margin: 0; padding: 0; width: 100%; overflow: hidden; border: 0px; border-spacing: 0px; background-color: #8c90d1; list-style: none;\">\n";
for ($i = 0; $i < count($arr_xml['URL']); $i++) {
echo "<li style=\"float: left; margin: 0; clear: none; width: 25%; padding: 0; display: inline;\"><span style=\"margin: 0; display: block; font-size: 12px; color: #000000; width: 100%; padding: 3px;\">".$arr_xml['BeforeText'][$i]." <a style=\"font-size: 12px; color: #000000;\" href=\"".$arr_xml['URL'][$i]."\">".$arr_xml['Text'][$i]."</a> ".$arr_xml['AfterText'][$i]."</span></li>\n";
}
echo "</ul>";
}

}

function tla_updateLocalXML($url, $file, $time_out)
{
	if($handle = fopen($file, "a")){
		fwrite($handle, "\n");
		fclose($handle);
	}
	if($xml = file_get_contents_tla($url, $time_out)) {
		$xml = substr($xml, strpos($xml,'<?'));

		if ($handle = fopen($file, "w")) {
			fwrite($handle, $xml);
			fclose($handle);
	}
	}
	}

	function tla_getLocalXML($file)
	{
		$contents = "";
		if($handle = fopen($file, "r")){
			$contents = fread($handle, filesize($file)+1);
			fclose($handle);
	}
	return $contents;
	}

	function file_get_contents_tla($url, $time_out)
	{
		$result = "";
		$url = parse_url($url);

		if ($handle = @fsockopen ($url["host"], 80)) {
			if(function_exists("socket_set_timeout")) {
				socket_set_timeout($handle,$time_out,0);
	} else if(function_exists("stream_set_timeout")) {
		stream_set_timeout($handle,$time_out,0);
	}

	fwrite ($handle, "GET $url[path]?$url[query] HTTP/1.0\r\nHost: $url[host]\r\nConnection: Close\r\n\r\n");
	while (!feof($handle)) {
		$result .= @fread($handle, 40960);
	}
	fclose($handle);
	}

	return $result;
	}

	function tla_decodeXML($xmlstg)
	{

		if( !function_exists('html_entity_decode') ){
			function html_entity_decode($string)
			{
				$string = preg_replace('~&#x([0-9a-f]+);~ei', 'chr(hexdec("\1"))', $string);
				$string = preg_replace('~&#([0-9]+);~e', 'chr(\1)', $string);
				$trans_tbl = get_html_translation_table(HTML_ENTITIES);
				$trans_tbl = array_flip($trans_tbl);
				return strtr($string, $trans_tbl);
	}
}

$out = "";
$retarr = "";

preg_match_all ("/<(.*?)>(.*?)</", $xmlstg, $out, PREG_SET_ORDER);
$search_ar = array('&#60;', '&#62;', '&#34;');
$replace_ar = array('<', '>', '"');
$n = 0;
while (isset($out[$n]))
{
	$retarr[$out[$n][1]][] = str_replace($search_ar, $replace_ar,html_entity_decode(strip_tags($out[$n][0])));
	$n++;
}
return $retarr;
}

tla_ads();

?>
</div><br/>
<div style="margin:0 auto;">


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
	<p>Searches several <i>SPAM Listing</i> databases to see if your domain and/or IP address is listed.  Great to troubleshoot mail delivery problems.</p>
	<h2>Ping</h2>
	<p><i>Ping a domain or IP address</i> to check if online.</p>
	<h2>DNS Traversal</h2>
	<p>Checks <i>root nameservers</i> for NS records for your domain.  Helpful to troubleshoot propagation issues.</p>
	</div>
	</pre></div></td><td class="right"></td></tr><tr><td class="bl"></td><td class="bottom"></td><td class="br"></td></tr></table>
	
	</div>
	<div align="center" style="font-size:10pt;color:#ffffff;"><a href="http://www.boxvps.com/vps-hosting.php">Virtual Servers Half Price Coupon: 50off</a></div>
</div>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-66926-2");
pageTracker._initData();
pageTracker._trackPageview();
</script>
<script language="javascript" src="http://www.boxvps.com/newstats/piwik.js" type="text/javascript"></script>
<script type="text/javascript">
<!--
piwik_action_name = '';
piwik_idsite = 2;
piwik_url = 'http://www.boxvps.com/newstats/piwik.php';
piwik_log(piwik_action_name, piwik_idsite, piwik_url);
//-->
</script>
</body>	
</html>
