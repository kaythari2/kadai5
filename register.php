<?php
ini_set('display_errors', 1);
error_reporting(~0);
require_once("dbcontroller.php");
require_once("config.php");

$dbController = new DBController($connector);
$mCommons = $dbController->getMCommonList();
$mMakers = $dbController->getMMakerList();

var_dump($mCommons);
var_dump($mMakers);
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

        <div id="contents" class="clearfix">
            <form id="submit_form" name="submit_form" action="#" method="post">
                <div class="inner">
                    <h2>車輌管理</h2>

                    <div class="column">
                        <h3>車輌登録画面</h3>
                        <table class="tableTypeB">
                            <tbody>
                                <tr>
                                    <th>ステータス</th>
                                    <td>
                                        <select name="st_cd">
                                            <?php foreach ($mCommons[CAR_STATUS] as $key => $value) {
                                            ?>
                                                <option value="<?php echo $key; ?>" 
                                                <?php 
                                                /*
                                                if (isset($_GET['id']) && $data["st_cd"] == $key) {
                                                                                        echo "selected";
                                                                                    } 
                                                                                    */
                                                                                    ?>
                                                                                    >
                                                                                     <?php echo $value; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>メーカー名</th>
                                    <td>
                                        <select name="maker_cd">
                                        <?php foreach ($mMakers as $key =>$value) {
                                            ?>
                                            <option value="<?php echo $value['id'];?>" <?php if (isset($_GET['id']) && $data['maker_name']==$value['name']) { echo "selected"; }?> > <?php echo $value['name'];?></option>
                                            <?php
                                        }
                                        ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>車名</th>
                                    <td>
                                        <select name="car_name_cd">
                                            <option value="10101040">プリウス</option>
                                        </select>
                                    </td>
                                </tr>
                                <!--<tr>
                            <th>グレード</th>
                            <td><input type="text" name="grade_name" value="" class="wL"></td>
                        </tr>-->
                                <tr>
                                    <th>型式</th>
                                    <td><input type="text" name="car_type" value="" class="wM"></td>
                                </tr>
                                <tr>
                                    <th>車台番号</th>
                                    <td><input type="text" name="frame_number" value="" class="wM"></td>
                                </tr>
                                <tr>
                                    <th>初年度登録</th>
                                    <td>
                                        <select name="first_entry_date_y">
                                            <option value="2017">2017</option>
                                        </select>&nbsp;年&nbsp;
                                        <select name="first_entry_date_m">
                                            <option value="11">11</option>
                                        </select>&nbsp;月
                                    </td>
                                </tr>
                                <!--<tr>
                            <th>排気量</th>
                            <td>
                                <input type="text" name="displacement" value="" class="wS">&nbsp;
                                <select name="displacement_unit_cd">
                                    <option value="1">cc</option>
                                </select>
                            </td>
                        </tr>-->
                                <!--<tr>
                            <th>車検日</th>
                            <td>
                                <label><input type="radio" name="inspection_flg" value="0">&nbsp;無</label>&nbsp;
                                <label><input type="radio" name="inspection_flg" value="1">&nbsp;有</label>&nbsp;
                                <select name="insplection_date_y">
                                    <option value="2017">2017</option>
                                </select>&nbsp;年&nbsp;
                                <select name="insplection_date_m">
                                    <option value="11">11</option>
                                </select>&nbsp;月&nbsp;
                                <select name="insplection_date_m">
                                    <option value="11">20</option>
                                </select>&nbsp;日
                            </td>
                        </tr>-->
                                <!--<tr>
                            <th>車歴</th>
                            <td>
                                <select name="car_history_cd">
                                    <option value="1">自家用</option>
                                </select>
                            </td>
                        </tr>-->
                                <!--<tr>
                            <th>ドア数</th>
                            <td><input type="text" name="door_cnt" value="" class="wS"></td>
                        </tr>-->
                                <!--<tr>
                            <th>ボディ形状</th>
                            <td>
                                <select name="shape_cd">
                                    <option value="6">セダン</option>
                                </select>
                            </td>
                        </tr>-->
                                <tr>
                                    <th>外装色</th>
                                    <td><input type="text" name="out_color_name" value="" class="wM"></td>
                                </tr>
                                <!--<tr>
                            <th>内装色</th>
                            <td><input type="text" name="in_color_name" value="" class="wM"></td>
                        </tr>-->
                                <tr>
                                    <th>シフト</th>
                                    <td>
                                        <select name="shift_posi_cd">
                                            <option value="1">フロア</option>
                                        </select>&nbsp;
                                        <input type="text" name="shift_cnt" value="" class="wS">&nbsp;
                                        <select name="shift_cd">
                                            <option value="1">AT</option>
                                        </select>
                                    </td>
                                </tr>
                                <!--<tr>
                            <th>エアコン</th>
                            <td>
                                <select name="aircon_cd">
                                    <option value="1">AC</option>
                                </select>
                            </td>
                        </tr>-->
                                <!--<tr>
                            <th>評価点</th>
                            <td>
                                <select name="valuation_cd">
                                    <option value="17">S</option>
                                </select>
                            </td>
                        </tr>-->
                                <!--<tr>
                            <th>外装評価点</th>
                            <td>
                                <select name="ext_valuation_cd">
                                    <option value="1">A</option>
                                </select>
                            </td>
                        </tr>-->
                                <!--<tr>
                            <th>内装評価点</th>
                            <td>
                                <select name="in_valuation_cd">
                                    <option value="2">B</option>
                                </select>
                            </td>
                        </tr>-->
                                <!--<tr>
                            <th>リサイクル料金</th>
                            <td><input type="text" name="" value="" class="wM">&nbsp;円</td>
                        </tr>-->
                                <!--<tr>
                            <th>業販価格</th>
                            <td><input type="text" name="" value="" class="wM">&nbsp;円</td>
                        </tr>-->
                                <tr>
                                    <th>小売価格</th>
                                    <td><input type="text" name="" value="" class="wM">&nbsp;円</td>
                                </tr>
                            </tbody>
                        </table>
                    </div><!-- End of.column -->

                    <div class="btnBox">
                        <button type="button" id="car_submit_btn" class="btnRed wL">登録</button>
                    </div>
                </div><!-- End of.inner -->
            </form>
        </div><!-- End of#contents -->

        <div id="footer">
            <p>&#169; COPYLIGHT (C) 2017 GENIO CO.,LTD. ALL RIGHT RESERVED.</p>
        </div>

    </div><!-- End of#container -->

</body>

</html>