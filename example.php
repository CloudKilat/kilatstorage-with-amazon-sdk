<?php
// Require the Composer autoloader.
require 'vendor/autoload.php';

// make sure the SDK is installed
// you can used Composer to autoload it: https://docs.aws.amazon.com/sdk-for-php/v3/developer-guide/getting-started_installation.html

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

// Instantiate an Amazon S3 client.
$s3 = new S3Client([
    'version' => 'latest',
    'region'  => 'id-jkt-1',
    'credentials' => [
        'key'    => 'YOUR_ACCESS_KEY_HERE',
        'secret' => 'YOUR_SECRET_KEY_HERE',
    ],
    'endpoint' => 'http://s3-id-jkt-1.kilatstorage.id/'
]);

$bucket_name = "YOUR_BUCKET_NAME_HERE";

// list of buckets
$buckets = $s3->listBuckets();
foreach ($buckets['Buckets'] as $bucket) {
    echo $bucket['Name'] . "<br>";
}

// create a bucket
try {
    $result = $s3->createBucket([
        'Bucket' => $bucket_name,
    ]);
} catch (S3Exception $e) {
    echo $e->getMessage();
}

// put an object
$file_path = "YOUR_FILE_PATH_TO_UPLOAD_HERE";
$key = basename($file_path);
try {
    $result = $s3->putObject([
        'Bucket'     => $bucket_name,
        'Key'        => $key,
        'SourceFile' => $file_path,
    ]);
} catch (S3Exception $e) {
    echo $e->getMessage();
}


// list objects of a bucket
try {
    $result = $s3->listObjects([
        'Bucket' => $bucket_name,
    ]);
    foreach ($result['Contents'] as $bucket) {
        echo $bucket['Key'] . "<br>";
    }
} catch (S3Exception $e) {
    echo $e->getMessage();
}

// delete an object
$key = "YOUR_OBJECT_NAME_TO_DELETE_HERE";
try {
    $result = $s3->deleteObject([
        'Bucket' => $bucket_name,
        'Key' => $key,
    ]);
} catch (S3Exception $e) {
    echo $e->getMessage();
}

// delete a bucket
try {
    $result = $s3->deleteBucket([
        'Bucket' => $bucket_name,
    ]);
} catch (S3Exception $e) {
    echo $e->getMessage();
}
