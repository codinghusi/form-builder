<?php

$filename = 'upload.zip';

echo "extracting...<br>";

$zip = new ZipArchive;
if ($zip->open($filename) === TRUE) {
    $env = file_get_contents('../.env');
    $zip->extractTo('../');
    $zip->close();
    unlink('../public/hot');
    file_put_contents('../.enf', $env);
    unlink($filename);
    echo 'ok.';
} else {
    echo 'error.';
}
