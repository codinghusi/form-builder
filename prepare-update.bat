@echo off
del update/upload.zip
7z a -tzip update/upload.zip . -xr!update -xr!.env -xr!.git -xr!.idea
::start http://husi012.bplaced.net/teresa/update/index.php
