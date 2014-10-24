<?php
#+++
# Make_statuscodes.php
#   create the include file with all of the latest IANA standards RFC3463 + changes


print "<?php\n";
print "#Generated by Make_statuscodes.php on ". date('c'). "\n\n";
print "#from http://www.iana.org/assignments/smtp-enhanced-status-codes/smtp-enhanced-status-codes-1.csv\n";
print "#and smtp-enhanced-status-codes-3.csv\n\n";

$fh = fopen("http://www.iana.org/assignments/smtp-enhanced-status-codes/smtp-enhanced-status-codes-1.csv", "r");
if ($fh !== FALSE) {
  $a = fgets($fh);  # 1st line is titles
  while (!feof($fh)) {
    $a = fgetcsv($fh, 0, ',', '"');
    $a[0] = preg_replace('/\..*/', '', $a[0]);  # 5.x.x ->  5
    $a[1] = preg_replace('/\n\s*/', ' ', $a[1]);  #remove line breaks
    $a[1] = preg_replace('/\s\s+/', ' ', $a[1]);  #remove double spaces
    $a[1] = preg_replace('/"/', '\\"', $a[1]);    #requote quotes
    $a[2] = preg_replace('/\n\s*/', ' ', $a[2]);  #remove line breaks
    $a[2] = preg_replace('/\s\s+/', ' ', $a[2]);  #remove double spaces
    $a[2] = preg_replace('/"/', '\\"', $a[2]);    #requote quotes
    print "\$status_code_classes['$a[0]']['title'] = \"". $a[1]. "\";  # $a[3]\n";
    print "\$status_code_classes['$a[0]']['descr'] = \"". $a[2]. "\";\n";
  }
  fclose ($fh);
}
print "\n";


#X.7.17,Mailbox owner has changed,5XX,"This status code is returned when a message is
#received with a Require-Recipient-Valid-Since
#field or RRVS extension and the receiving
#system is able to determine that the intended
#recipient mailbox has not been under
#continuous ownership since the specified date.",[RFC-ietf-appsawg-rrvs-header-field-10] (Standards Track),M. Kucherawy,IESG


$fh = fopen("http://www.iana.org/assignments/smtp-enhanced-status-codes/smtp-enhanced-status-codes-3.csv", "r");
if ($fh !== FALSE) {
  $a = fgets($fh);  # 1st line is titles
  while (!feof($fh)) {
    $a = fgetcsv($fh, 0, ',', '"');
    $a[0] = preg_replace('/^X./i', '', $a[0]);    #X.5.0 -> 5.0
    $a[1] = preg_replace('/\n\s*/', ' ', $a[1]);  #remove line breaks
    $a[1] = preg_replace('/\s\s+/', ' ', $a[1]);  #remove double spaces
    $a[1] = preg_replace('/"/', '\\"', $a[1]);    #requote quotes
    $a[3] = preg_replace('/\n\s*/', ' ', $a[3]);  #remove line breaks
    $a[3] = preg_replace('/\s\s+/', ' ', $a[3]);  #remove double spaces
    $a[3] = preg_replace('/"/', '\\"', $a[3]);    #requote quotes
    print "\$status_code_subclasses['$a[0]']['title'] = \"". $a[1]. "\";  # $a[4]\n";
    print "\$status_code_subclasses['$a[0]']['descr'] = \"". $a[3]. "\";\n";
  }
  fclose ($fh);
}
print "\n\n?>";

?>
