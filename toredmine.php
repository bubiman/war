<?php

require_once ('ActiveResource.php');

$wer = $_GET["wer"];
$ticketid = $_GET["ticketid"];
$apikey = $_GET["apikey"];
$stimme = $_GET["stimme"];


//phpurl+"toredmine.php?ticketid="+this.ticket+"&stimme="+this.wie+"&wer="+usertoredminecustomfieldid(redmineuser)+"&apikey="+apikey;





class Issue extends ActiveResource {

	var $request_format = 'xml'; // REQUIRED!
}

$issue = new Issue();
$issue->site = 'https://'.$apikey.':pass@redmine.piratenfraktion-nrw.de/';


$issues = $issue->find ($ticketid);

$customFields=array(
	'@type' => "array", 
	'custom_field' => array(
		array('id'=> $wer, 'value' => $stimme),
	)
); 
$issue->set ('custom_fields', $customFields);
$issue->save();


?>