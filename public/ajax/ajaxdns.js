var isBusy = false;
var theHolder = '';
function createRequestObject() {
	var xmlHttp;
	var browser = navigator.appName;
	if (window.XMLHttpRequest){
        	var xmlHttp = new XMLHttpRequest();
	}
	else if (window.ActiveXObject){
        	var xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	return xmlHttp;
}

var http = createRequestObject(); 
var http2 = createRequestObject(); 

function ajaxRequest(domain,action,rectype,af,rs,fa,br,rc) {
	if (isBusy)
	{
		return false;
	}
	var random = Math.random();
	getrequest = 'ajax/ajax_feed.php?domain=' + domain + '&action=' + action + '&rectype=' + rectype + '&if=' + af + '&rs=' + rs + '&fa=' + fa + '&br=' + br + '&rc=' + rc + '&ie_cache_fix=' + random;
	http.open('get', getrequest);
	isBusy = true;
	http.onreadystatechange = handleDNSStuff; 
	http.send(null);
}

/* Function called to handle page transitions and DOM elements changing */
function handleDNSStuff() {
	if(http.readyState == 1) {
		show('busy');
	}
	if(http.readyState == 4) {
		isBusy = false;
		var response = http.responseText;
		response = response.replace(/Reverse.+PTR/, "Reverse DNS:<b>");
		document.getElementById('dnsinformation').innerHTML = response;
		hide('busy');
		scrollTo(0,0);
		clearMenu();
		document.getElementById(theHolder).style.backgroundPosition = '-100px 0';
	}
}

/* ************* Page Functions (mostly DOM/CSS) ************* */

function getElementsByClassName(oElm, strTagName, strClassName){
    var arrElements = (strTagName == "*" && oElm.all)? oElm.all : oElm.getElementsByTagName(strTagName);
    var arrReturnElements = new Array();
    strClassName = strClassName.replace(/\-/g, "\\-");
    var oRegExp = new RegExp("(^|\\s)" + strClassName + "(\\s|$)");
    var oElement;
    for(var i=0; i<arrElements.length; i++){
        oElement = arrElements[i];      
        if(oRegExp.test(oElement.className)){
            arrReturnElements.push(oElement);
        }   
    }
    return (arrReturnElements)
}

function menuHover(e,menuitem) {
	if (!e) var e = window.event;
	var fromdiv = e.relatedTarget || e.fromElement;
alert(fromdiv.id);
	if (menuitem == 'traversal' && (fromdiv.id == 'ttl' || fromdiv.id == 'ttop' || fromdiv.id == 'ttr' || fromdiv.id == 'tleft' || fromdiv.id == 'tnav' || fromdiv.id == 'tright' || fromdiv.id == 'tbl' || fromdiv.id == 'tbottom' || fromdiv.id == 'tbr')) {
	alert('hi');
		document.getElementById('ttl').style.background = 'url(images/tl.gif)';
	}
}

function menuUnhover(e,menuitem) {
	if (!e) var e = window.event;
	var fromdiv = e.relatedTarget || e.fromElement;

	if (menuitem == 'traversal' && (fromdiv.id == 'ttl' || fromdiv.id == 'ttop' || fromdiv.id == 'ttr' || fromdiv.id == 'tleft' || fromdiv.id == 'tnav' || fromdiv.id == 'tright' || fromdiv.id == 'tbl' || fromdiv.id == 'tbottom' || fromdiv.id == 'tbr')) {
		document.getElementById('ttl').background = '';
	}
}

function clearBox(box) {
		document.getElementById('URL').select;
		document.getElementById('URL').style.backgroundColor="white";
}

/* wtf was i doing here?
function urlback() {
}*/

function domainlink() {
	godomain = document.getElementById('URL').value;
        if (/^\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(godomain)){
		window.open('http://' + godomain);
        }
	else {
		alert("Valid domains FTW!");
	}
}

function show(div) {
	document.getElementById(div).style.display = 'block';
}
function hide(div) {
	document.getElementById(div).style.display = 'none';
}
function invisible(div) {
	document.getElementById(div).style.visibility = 'hidden';
}
function visible(div) {
	document.getElementById(div).style.visibility = 'visible';
}

function linkPage() {
	domain = document.getElementById('URL').value;
	switch(theHolder){
		case 'tm-live':
			action = 'dns'
			break
		case '':
			action = 'dns'
			break
		case 'tm-whois':
			action = 'whois'
			break
		case 'tm-ipwhois':
			action = 'ipwhois'
			break
		case 'tm-httpheaders':
			action = 'httpheaders'
			break
		case 'tm-rbl':
			action = 'rbl'
			break
		case 'tm-ping':
			action = 'ping'
			break
		case 'tm-traversal':
			action = 'traversal'
			break
	}
	pagelink = 'http://www.ajaxdns.com/?domain=' + domain + '&action=' + action;
	window.location=pagelink;
}

function details() {
	if (document.getElementById('details').innerHTML == '<a href="javascript:details();">Show Details</a>') {
		show('floatinginfo');
		document.getElementById('details').innerHTML = '<a href="javascript:details();">Hide Details</a>';
	}
	else {
		hide('floatinginfo');
		document.getElementById('details').innerHTML = '<a href="javascript:details();">Show Details</a>';
	}
}

function clearMenu() {
	document.getElementById('tm-live').style.backgroundPosition = '0 0';
	document.getElementById('tm-whois').style.backgroundPosition = '0 0';
	document.getElementById('tm-ipwhois').style.backgroundPosition = '0 0';
	document.getElementById('tm-httpheaders').style.backgroundPosition = '0 0';
	document.getElementById('tm-rbl').style.backgroundPosition = '0 0';
	document.getElementById('tm-ping').style.backgroundPosition = '0 0';
	document.getElementById('tm-traversal').style.backgroundPosition = '0 0';
}

/* ************* Keyboard Shortcuts ************* */

urlFocus = false;
function focused() {
	urlFocus = true;
}
function unfocused() {
	urlFocus = false;
}

function textsizer(e){
	if (urlFocus == false) {
		var evtobj=window.event? event : e
		var unicode=evtobj.charCode? evtobj.charCode : evtobj.keyCode
		var actualkey=String.fromCharCode(unicode)
		if (actualkey=="a")
			document.body.style.fontSize="120%"
		if (actualkey=="w")
			whois();
		if (actualkey=="i")
			ipwhois();
		if (actualkey=="d")
			dnsrecords();
		if (actualkey=="h")
			httpheaders();
		if (actualkey=="r")
			rbl();
		if (actualkey=="p")
			ping();
		if (actualkey=="l"){
			document.getElementById('URL').focus();
			document.getElementById('URL').select();
		}
		if (actualkey=="t")
			traversal();
		if (actualkey=="z")
			document.body.style.fontSize="100%"
		if (actualkey=="v")
			domainlink();
	}
}
document.onkeypress=textsizer

function enteredIt(e){
	var evtobj=window.event? event : e
	var unicode=evtobj.charCode? evtobj.charCode : evtobj.keyCode
	var actualkey=String.fromCharCode(unicode)
	if (unicode == 13 ) {
		switch(theHolder){
			case 'tm-live':
				dnsrecords();
				break;
			case '':
				dnsrecords();
				break;
			case 'tm-whois':
				whois();
				break;
			case 'tm-ipwhois':
				ipwhois();
				break;
			case 'tm-httpheaders':
				httpheaders();
				break;
			case 'tm-rbl':
				rbl();
				break;
			case 'tm-ping':
				ping();
				break;
			case 'tm-traversal':
				traversal();
				break;
		}
	}
}

function hover(div) {
	document.getElementById(div).style.backgroundPosition = '-100px 0';
}
function unhover(div) {
	if (div == theHolder) {
	}
	else {
		document.getElementById(div).style.backgroundPosition = '0 0';
	}
}

/* ************* DNS Request Functions ************* */

function page_request() {
	if (document.getElementById('URL').value == '') {
		return false;
	}	
	else {
		domain = document.getElementById('URL').value;
		if (checkDomain(domain)) {
			return true;
		}
	}
}

function dnsrecords() {
	if(page_request()) {
	var domainname = document.getElementById("URL").value;
	domainname = domainname.replace(/ /g, "");
	theHolder = 'tm-live';
	ajaxRequest(domainname,'dns', 'ANY');
}
}

function traversal() {
	if(page_request()) {
	page_request();
	var domainname = document.getElementById("URL").value;
	domainname = domainname.replace(/ /g, "");
	theHolder = 'tm-traversal';
	ajaxRequest(domainname,'traverse');
}
}

function httpheaders() {
	if(page_request()) {
	page_request();
	var domainname = document.getElementById("URL").value;
	domainname = domainname.replace(/ /g, "");
	theHolder = 'tm-httpheaders';
	ajaxRequest(domainname,'headers');
}
}

function whois() {
	if(page_request()) {
	page_request();
	var domainname = document.getElementById("URL").value;
	domainname = domainname.replace(/ /g, "");
	theHolder = 'tm-whois';
	ajaxRequest(domainname,'whois');
}
}

function ipwhois() {
	if(page_request()) {
	page_request();
	var domainname = document.getElementById("URL").value;
	domainname = domainname.replace(/ /g, "");
	theHolder = 'tm-ipwhois';
	ajaxRequest(domainname,'ipwhois');
}
}

function rbl() {
	if(page_request()) {
	page_request();
	var domainname = document.getElementById("URL").value;
	domainname = domainname.replace(/ /g, "");
	theHolder = 'tm-rbl';
	ajaxRequest(domainname,'rbl');
}
}

function ping() {
	if(page_request()) {
		page_request();
		var domainname = document.getElementById("URL").value;
		domainname = domainname.replace(/ /g, "");
		theHolder = 'tm-ping';
		ajaxRequest(domainname,'ping');
	}
}

function sendEmail() {
	var name = document.getElementById('name').value;
	var email = document.getElementById('email').value;
	var comments = document.getElementById('comments').value;
	if (formValidation()) {
		ajaxRequest(name,'sendemail',email,comments);
	}
}

function formValidation(){
	if(notEmpty(document.getElementById('name').value)){
		if(notEmpty(document.getElementById('email').value)){
			if(notEmpty(document.getElementById('comment').value)){
				if(checkEmail(document.getElementById('email').value)){
					return true;
				}
			}
		}
	}
	else {
		return false;
	}
}

function notEmpty(elem){
	var str = elem;
	if(str.length == 0){
		alert("You must fill in all fields");
		return false;
	} 
	else {
		return true;
	}
}

function checkEmail(email) {
	if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)){
		return true
	}
	else {
		return false
	}
}

function checkDomain(domain) {
        if (/^\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(domain) || checkIP(domain)){
                return true
        }
        else {
		alert("Please provide a valid domain or IP address.");
                return false
        }
}

function checkIP(ip) {
	if (/^\b(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\b/.test(ip)) {
		return true
	}
	else {
                return false
	}
}
