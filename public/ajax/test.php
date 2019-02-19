<pre><?php
	require_once 'Net/DNS.php';

	$resolver = new Net_DNS_Resolver();
	$resolver->debug = 1;
	$resolver->nameservers = array('4.2.2.2');
	$response = $resolver->query('php.net');
	if ($response) {
		foreach ($response->answer as $rr) {
			$rr->display();
			echo "<br>";
		}
	}
?></pre>
