<?php

if (! function_exists('getRandomFilenameFromB64')) {
    function getRandomFilenameFromB64(string $b64Data)
    {
        $b64Data = explode(',', $b64Data);
        if (count($b64Data) > 1) {
            $decoded = base64_decode($b64Data[1]);
        } else {
            $decoded = base64_decode($b64Data[0]);
        }
        $f = finfo_open();
        $mime_type = finfo_buffer($f, $decoded, FILEINFO_MIME_TYPE);

        $fileExt = getFileExtFromMimeType($mime_type);

        $fileExt = $fileExt ? '.'.$fileExt :'';
        return substr(str_shuffle(MD5(microtime())), 0, 10).$fileExt;
    }
}

if (! function_exists('getFileExtFromMimeType')) {
    function getFileExtFromMimeType(string $mimeType)
    {
        if (strstr($mimeType, 'svg')) {
            return 'svg';
        }

        if (strstr($mimeType, 'jpeg')) {
            return 'jpg';
        }

        if (strstr($mimeType, 'png')) {
            return 'png';
        }

        return '';
    }
}
