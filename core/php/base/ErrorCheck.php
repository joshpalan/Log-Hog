<?php

namespace Core\Base;


class ErrorCheck
{

    public static function testErrorBase()
    {
        $tmpFuncBaseURL = "";
        $boolTestBaseURL = file_exists($tmpFuncBaseURL . "error.php");
        while (!$boolTestBaseURL) {
            $tmpFuncBaseURL .= "../";
            $boolTestBaseURL = file_exists($tmpFuncBaseURL . "error.php");
        }
        return $tmpFuncBaseURL;
    }

    public static function checkIfFilesAreReadable($arrayOfFiles, $urlPath, $currentFile)
    {
        $cIFAReBaseUrl = testErrorBase();
        foreach ($arrayOfFiles as $file) {
            if (!is_readable($cIFAReBaseUrl . $file)) {
                echoErrorJavaScript($urlPath, $file . " could not be read from " . $currentFile, 1072);
            }
        }
    }

    public static function checkIfFilesAreWritable($arrayOfFiles, $urlPath, $currentFile)
    {
        $cIFAWBaseUrl = testErrorBase();
        foreach ($arrayOfFiles as $file) {
            if (!is_writable($cIFAWBaseUrl . $file)) {
                echoErrorJavaScript($urlPath, $file . " could not be written to from " . $currentFile, 1073);
            }
        }
    }

    public static function checkIfFilesExist($arrayOfFiles, $urlPath, $currentFile)
    {
        $cIFATBaseUrl = testErrorBase();
        foreach ($arrayOfFiles as $file) {
            if (!file_exists($cIFATBaseUrl . $file)) {
                fileMissingError($file, $urlPath, $currentFile);
            }
        }
    }

    public static function configFileErrorChecks($config, $urlPath, $currentFile = "")
    {
        foreach ($config['watchList'] as $key => $item) {
            if (is_array($item)) {
                break;
            }
            if (strpos($item, "\\") !== false) {
                echoErrorJavaScript($urlPath, "Local/.../Config::Watchlist  - " . $currentFile, 1);
            }
        }
    }

    public static function fileMissingError($file, $urlPath, $currentFile)
    {
        echoErrorJavaScript($urlPath, $file . " is not accessable from " . $currentFile, 1074);
    }

    public static function throwSetupError($urlPath)
    {
        echoErrorJavaScript($urlPath, "An error occured durring setup", 2);
    }

    public static function echoErrorJavaScript($urlPath, $mainMessage, $errorNumber)
    {
        $urlPath = $urlPath . "error.php?error=" . $errorNumber . "&page=" . $mainMessage;
        echo "<script type=\"text/javascript\"> window.location.href = '" . $urlPath . "'; </script>";
        exit();

    }
}