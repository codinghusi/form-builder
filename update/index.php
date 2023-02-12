<?php

$filename = 'upload.zip';

echo "extracting...<br>";
$env = file_get_contents('../.env');

$zip = new ZipArchive;
if ($zip->open($filename)) {

    $zip->extractTo('../');
    $zip->close();
    unlink('../public/hot');
    file_put_contents('../.env', $env);
    unlink($filename);
    echo 'ok.';
} else {
    echo 'error.';
}
