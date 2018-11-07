## Basic Usage KilatStorage with Amazon SDK V3

- - - -


### Description

This is example code for the AWS SDK for PHP Version 3.

### Notes

Make sure the SDK is installed, you can use Composer to autoload it: https://docs.aws.amazon.com/sdk-for-php/v3/developer-guide/getting-started_installation.html

### Usage

Require the Composer autoloader:

```php
require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;
```

Create a S3Client:

Instantiate an Amazon S3 client:

```php
$s3 = new S3Client([
    'version' => 'latest',
    'region'  => 'id-jkt-1',
    'credentials' => [
        'key'    => 'YOUR_ACCESS_KEY_HERE',
        'secret' => 'OUR_SECRET_KEY_HERE',
    ],
    'endpoint' => 'http://s3-id-jkt-1.kilatstorage.id/'
]);
```

#### Object Operations

Put an object from a file:

```php
$bucket = 'YOUR_BUCKET_NAME_HERE';
$file_Path = 'YOUR_FILE_NAME_HERE';
$key = basename($file_Path);
try {
    $result = $s3->putObject([
        'Bucket'     => $bucket,
        'Key'        => $key,
        'SourceFile' => $file_Path,
    ]);
    print_r($result);
} catch (S3Exception $e) {
    echo $e->getMessage();
}
```

Delete an object:

```php
try {
    $result = $s3->deleteObject([
        'Bucket' => 'YOUR_BUCKET_NAME_HERE',
        'Key' => 'YOUR_FILE_NAME_HERE',
    ]);
} catch (S3Exception $e) {
    echo $e->getMessage();
}
```


#### Bucket Operations

Get a list of buckets:

```php
try {
	$buckets = $s3->listBuckets();
	foreach ($buckets['Buckets'] as $bucket) {
	    echo $bucket['Name'] . "\n";
	}
} catch (S3Exception $e) {
	echo $e->getMessage();
    echo "\n";
}
```

Create a bucket:

```php
try {
    $result = $s3->createBucket([
        'Bucket' => 'YOUR_BUCKET_NAME_HERE',
    ]);
} catch (S3Exception $e) {
    echo $e->getMessage();
}
```

Get the contents of a bucket:

```php
try {
    $result = $s3->listObjects([
        'Bucket' => 'YOUR_BUCKET_NAME_HERE',
    ]);
    foreach ($result['Contents'] as $bucket) {
        echo $bucket['Key'] . "<br>";
    }
} catch (S3Exception $e) {
    echo $e->getMessage();
}
```

Delete an empty bucket:

```php
try {
    $result = $s3->deleteBucket([
        'Bucket' => 'delete-bucket',
    ]);
} catch (S3Exception $e) {
    echo $e->getMessage();
}
```

For more services: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-s3-2006-03-01.html