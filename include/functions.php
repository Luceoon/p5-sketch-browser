<?php

    function downloadSketch($rFilename) {

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Disposition: attachment; filename="'.basename($rFilename).'"');
        header('Content-Length: ' . filesize($rFilename));
        readfile($rFilename);
        exit;
    }

    function renderCodeView($rBaseUri, $rFilename) {

        $rDownload_str = sprintf('<a href="%s?s=%s&download">Download</a> (%s KiB)', $rBaseUri, basename($rFilename, '.js'), round(filesize($rFilename) / 1024, 2));
        $rHeader = str_replace('{{$link}}', $rDownload_str, file_get_contents('include/assets/js/code-header.js'));
        echo $rHeader.file_get_contents($rFilename);
    }
?>