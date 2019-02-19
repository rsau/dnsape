<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * PEAR::Net_DNSBL
 *
 * This class acts as interface to generic Realtime Blocking Lists
 * (RBL)
 *
 * PHP versions 4 and 5
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * Net_DNSBL looks up an supplied host if it's listed in 1-n supplied
 * Blacklists
 *
 * @category   Net
 * @package    DNSBL
 * @author     Sebastian Nohn <sebastian@nohn.net>
 * @copyright  2004-2007 Sebastian Nohn <sebastian@nohn.net>
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    CVS: $Id: testNetDNSBLSURBL.php,v 1.10 2006/12/25 10:40:59 nohn Exp $
 * @link       http://pear.php.net/package/Net_DNSBL
 * @see        Net_DNS
 * @since      File available since Release 1.0.0
 */

require_once "Net/DNSBL/SURBL.php";
require_once "PHPUnit/Framework/TestCase.php";

class testNetDNSBLSURBL extends PHPUnit_Framework_TestCase {
    private $surbl;
    
    protected function setUp() {
        $this->surbl = new Net_DNSBL_SURBL;
    }
    
    public function testSpamUrlsAlwaysGetReportedAsSpam() {
        $this->assertTrue($this->surbl->isListed("http://surbl-org-permanent-test-point.com/justatest"));
        $this->assertEquals(array(0 => 'multi.surbl.org permanent test point'), $this->surbl->getTxt('http://surbl-org-permanent-test-point.com/justatest'));
        $this->assertTrue($this->surbl->isListed("http://wasdavor.surbl-org-permanent-test-point.com/justatest"));
        $this->assertTrue($this->surbl->isListed("http://127.0.0.2/"));
        $this->assertTrue($this->surbl->isListed("http://127.0.0.2/justatest"));
    }

    public function testNoSpamUrlsNeverGetReportedAsSpam() {
        $this->assertFalse($this->surbl->isListed("http://www.nohn.net"));
        $this->assertFalse($this->surbl->isListed("http://www.php.net/"));
        $this->assertFalse($this->surbl->isListed("http://www.heise.de/24234234?url=lala"));
        $this->assertFalse($this->surbl->isListed("http://www.nohn.net/blog/"));
        $this->assertFalse($this->surbl->isListed("http://213.147.6.150/justatest"));
        $this->assertFalse($this->surbl->isListed("http://www.google.co.uk/search?hl=en&q=test&btnG=Google+Search&meta="));
    }

    public function testMixedSpamAndNospamUrlsWorkAsExpected() {
        $this->assertFalse($this->surbl->isListed("http://www.nohn.net"));
        $this->assertTrue($this->surbl->isListed("http://surbl-org-permanent-test-point.com"));
        $this->assertTrue($this->surbl->isListed("http://wasdavor.surbl-org-permanent-test-point.com/justatest"));
        $this->assertTrue($this->surbl->isListed("http://127.0.0.2/justatest"));
        $this->assertFalse($this->surbl->isListed("http://213.147.6.150/justatest"));
        $this->assertTrue($this->surbl->isListed("http://surbl-org-permanent-test-point.com/justatest"));
        $this->assertFalse($this->surbl->isListed("http://www.php.net"));
        $this->assertFalse($this->surbl->isListed("http://www.google.com"));
        $this->assertFalse($this->surbl->isListed("http://www.google.co.uk/search?hl=en&q=test&btnG=Google+Search&meta="));
    }

    public function testInvalidArguments() {
        $this->assertFalse($this->surbl->isListed("hurgahurga"));
        $this->assertFalse($this->surbl->isListed(null));
        $this->assertFalse($this->surbl->isListed(false));
        $this->assertFalse($this->surbl->isListed(true));
    }
}
?>
