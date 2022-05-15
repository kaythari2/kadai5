<?php
ini_set('display_errors', 1);
error_reporting(~0);
require_once("config.php");
require_once("dbcontroller.php");

$dbController = new DBController($connector);
$mCommons = $dbController->getMCommonList();

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">

<head>
    <meta http-equiv="content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="content-language" content="ja">
    <meta http-equiv="content-style-type" content="text/css">
    <meta http-equiv="content-script-type" content="text/javascript">
    <meta http-equiv="imagetoolbar" content="no">
    <meta name="viewport" content="width=1024">
    <meta http-equiv="keywords" content="">
    <meta http-equiv="discription" content="">
    <title>車輌管理</title>
    <link rel="stylesheet" type="text/css" href="./css/styles.css" media="screen, print">
    <link rel="stylesheet" type="text/css" href="./css/jquery-ui.min.css" media="screen, print">
    <script type="text/javascript" src="./js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="./js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="./js/main.js"></script>
</head>

<body class="car">

    <div id="container">
        <div class="globalNav clearfix">
            <ul>
                <li class="slide">
                    <a href="#">トップページ</a>
                </li>
                <li class="slide">
                    <a href="./list.html">車輌管理</a>
                </li>
            </ul>
        </div><!-- End of.globalNav -->
    </div>
</body>
</html>