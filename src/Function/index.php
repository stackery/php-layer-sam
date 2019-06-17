Hello World!  You've reached <?php print($_SERVER['REQUEST_URI']); ?>
<?php
   require 'aws/aws-autoloader.php';
?>
<?php
use Aws\S3\S3Client;

// Instantiate an Amazon S3 client.
$s3 = new S3Client([
    'version' => 'latest',
    'region'  => $_ENV['AWS_REGION']
]);
?>
<?php
// Upload a publicly accessible file. The file size and type are determined by the SDK.
try {
   $uri = $_SERVER['REQUEST_URI'];
   $date = date("D M d, Y G:i");
    $s3->putObject([
        'Bucket' => $_ENV['BUCKET_NAME'],
        'Key'    => "$uri",
        'Body'   => "hello at $date",
        'ACL'    => 'public-read',
    ]);
} catch (Aws\S3\Exception\S3Exception $e) {
    echo "There was an error uploading the file.\n";
}
?>
<?php
print_r(get_loaded_extensions());
?>
<h2>cwd</h2>
<p>
<?

print(getcwd());
?>
</p>
<?
phpinfo();
?>


<h2>SERVER</h2>
<table>
<?php
   while (list($var,$value) = each ($_SERVER)) {
      echo "<tr><td>$var</td><td>$value</td></tr>";
   }
?>


</table>
<h2>ENV VARS</h2>
<table>
<?php
   while (list($var,$value) = each ($_ENV)) {
      echo "<tr><td>$var</td><td>$value</td></tr>";
   }
?>


</table>