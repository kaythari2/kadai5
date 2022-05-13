<?php
require_once('constants.php');
require_once("config.php");
require_once("dbcontroller.php");
require_once("functions.php");

$dbController = new DBController($connector);
$mCommons = $dbController->getMCommonList();

$totalRowCount = $dbController->getRowCount(
	htmlspecialchars($_GET['keyword']),
	htmlspecialchars($_GET['frame_number'])
);

$limit = (isset($_GET['limit']) && is_numeric($_GET['limit'])) ? (int) $_GET['limit'] : 20;

$totalPages = ceil($totalRowCount / $limit);

$page = (isset($_GET['page']) && is_numeric($_GET['page'])) ? (int) $_GET['page'] : 1;

$index = ($page - 1) * $limit;

if (isset($_GET["search"]) && (!empty($_GET['keyword']) || !empty($_GET['frame_number']))) {
	$tCars = $dbController->searchTCars(
		htmlspecialchars($_GET["keyword"]),
		htmlspecialchars($_GET["frame_number"]),
		$index,
		$limit
	);
} elseif (isset($_GET["order_by"])) {
	$tCars = $dbController->sortTCars(
		htmlspecialchars($_GET["order_by"]),
		htmlspecialchars($_GET["sort_order"]),
		$index,
		$limit
	);
} else {
	$tCars = $dbController->getTCarList($index, $limit);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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
					<a href="./">トップページ</a>
				</li>
				<li class="slide">
					<a href="./list.html">車輌管理</a>
				</li>
			</ul>
		</div><!-- End of.globalNav -->

		<div id="contents" class="clearfix">
			<form action="#" id="form1" method="get" accept-charset="utf-8">

				<div class="inner">
					<h2>車輌管理</h2>

					<div class="menuList clearfix">

						<h3>検索</h3>
						<div class="searchQBox">
							<table class="tableTypeD">
								<tbody>
									<tr>
										<th>キーワード</th>
										<td>
											<input type="text" name="keyword" class="input_item" value="<?php
																										echo (isset($_GET["keyword"]) ? htmlspecialchars($_GET["keyword"]) : '')
																										?>">
										</td>
									</tr>
									<tr>
										<th>車台番号</th>
										<td>
											<input type="text" name="frame_number" class="input_item" value="<?php
																												echo (isset($_GET["frame_number"]) ? htmlspecialchars($_GET["frame_number"]) : '')
																												?>">
										</td>
									</tr>
									<tr>
										<th>件数</th>
										<td>
											<select name="limit">
												<option value="20" <?php if (empty($_GET['limit']) || $_GET['limit'] == 20) {
																		echo "selected";
																	} ?>>20</option>
												<option value="50" <?php if (isset($_GET['limit']) && $_GET['limit'] == 50) {
																		echo "selected";
																	} ?>>50</option>
												<option value="100" <?php if (isset($_GET['limit']) && $_GET['limit'] == 100) {
																		echo "selected";
																	} ?>>100</option>
											</select>
										</td>
									</tr>
								</tbody>
							</table>
							<div style="text-align:center;">
								<button type="submit" name="search" class="search-btn">　検索　</button>
							</div>
						</div>
					</div>

					<a href="register.php"><button type="button" class="form-btn">　新規登録　</button></a>

					<h3>車輌一覧</h3>
					<div id="exhibit_bid_list_box">
						<table class="tableTypeB" id="exhibit_bid_list" style="margin: 0px;">
							<thead>
								<tr>
									<th><a href=<?php
												echo concatSortToUrl('maker_name');
												?> style="color:white">
											メーカー名<?php
													echo sortOrder("maker_name", $_GET["order_by"], $_GET["sort_order"]);
													?>
										</a></th>
									<th><a href=<?php
												echo concatSortToUrl('car_name');
												?> style="color:white">
											車名<?php
												echo sortOrder("car_name", $_GET["order_by"], $_GET["sort_order"]);
												?>
										</a></th>
									<th><a href=<?php
												echo concatSortToUrl('car_type');
												?> style="color:white">
											型式<?php
												echo sortOrder("car_type", $_GET["order_by"], $_GET["sort_order"]);
												?>
										</a></th>
									<th><a href=<?php
												echo concatSortToUrl('frame_number');
												?> style="color:white">
											車台番号<?php
												echo sortOrder("frame_number", $_GET["order_by"], $_GET["sort_order"]);
												?>
										</a></th>
									<th><a href=<?php
												echo concatSortToUrl('first_entry_date');
												?> style="color:white">
											初年度登録<?php
													echo sortOrder("first_entry_date", $_GET["order_by"], $_GET["sort_order"]);
													?>
										</a></th>
									<th><a href=<?php
												echo concatSortToUrl(('mileage'));
												?> style="color:white">
											走行距離<?php
												echo sortOrder("mileage", $_GET["order_by"], $_GET["sort_order"]);
												?>
										</a></th>
									<th><a href=<?php
												echo concatSortToUrl('out_color_name');
												?> style="color:white">
											外装色<?php
												echo sortOrder("out_color_name", $_GET["order_by"], $_GET["sort_order"]);
												?>
										</a></th>
									<th><a href=<?php
												echo concatSortToUrl('shift_cd');
												?> style="color:white">
											シフト<?php
												echo sortOrder("shift_cd", $_GET["order_by"], $_GET["sort_order"]);
												?>
										</a></th>
									<th><a href=<?php
												echo concatSortToUrl('sale_price');
												?> style="color:white">
											小売価格<?php
												echo sortOrder("sale_price", $_GET["order_by"], $_GET["sort_order"]);
												?>
										</a></th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($tCars as $car) {
								?>
									<tr>
										<td><?php
											echo htmlspecialchars($car['maker_name']);
											?></td>
										<td><?php
											echo htmlspecialchars($car['car_name']);
											?></td>
										<td><?php
											echo htmlspecialchars($car['car_type']);
											?></td>
										<td><?php
											echo htmlspecialchars($car['frame_number']);
											?></td>
										<td><?php
											echo toWareki(htmlspecialchars($car['first_entry_date']));
											?></td>
										<td><?php
											$mileageUnitCode = htmlspecialchars($mCommons[MILEAGE_UNIT_CODE][$car['mileage_unit_cd']]);
											echo formattedMileage(htmlspecialchars($car['mileage']), $mileageUnitCode);
											?></td>
										<td><?php
											echo formattedOutColor(htmlspecialchars($car['out_color_name']));
											?></td>
										<td><?php
											$shiftCode = htmlspecialchars($mCommons[SHIFT_CODE][$car['shift_cd']]);
											$shiftPosition = htmlspecialchars($mCommons[SHIFT_POSITION][$car['shift_posi_cd']]);
											$shiftCount = htmlspecialchars($car['shift_cnt']);
											echo formattedShift($shiftCode, $shiftCount, $shiftPosition);
											?></td>
										<td><?php
											echo formattedSalePrice(htmlspecialchars($car['sale_price']));
											?></td>
									</tr>
								<?php
								}
								?>
							</tbody>
						</table>
						<?php
						require("pagination.php");
						?>
					</div>
				</div><!-- End of.inner -->
			</form>
		</div><!-- End of#contents -->

		<div id="footer">
			<p>&#169; COPYLIGHT (C) 2011 GENIO CO.,LTD. ALL RIGHT RESERVED.</p>
		</div>

	</div><!-- End of#container -->

</body>

</html>

<?php
function withoutPageParamUrl()
{
	if (!strpos($_SERVER['QUERY_STRING'], "page")) {
		return $_SERVER['QUERY_STRING'] . "&";
	}
	return substr($_SERVER['QUERY_STRING'], 0, strpos($_SERVER['QUERY_STRING'], "page"));
}

function concatSortToUrl($column)
{
	$url = "?";
	if (isset($_GET["keyword"])) {
		$url .= "keyword=" . htmlspecialchars($_GET["keyword"]) . "&";
	}
	if (isset($_GET["frame_number"])) {
		$url .= "frame_number=" . htmlspecialchars($_GET["frame_number"]) . "&";
	}
	if (isset($_GET["limit"])) {
		$url .= "limit=" . htmlspecialchars($_GET["limit"]) . "&";
	}
	if (isset($_GET["keyword"]) && isset($_GET["frame_number"]) ) {
		$url .= "search=&";
	}
	$url .= getOrder($column, htmlspecialchars($_GET['order_by']), htmlspecialchars($_GET['sort_order']));
	return $url;
}

?>