<?php
session_start();

//  $tprice=0;
//  $tqnty=0;

$ptoducts = array(
	"101" => array("Price:$150.00" => "images/football.png"),
	"102" => array("Price:$120.00" => "images/tennis.png"),
	"103" => array("Price:$90.00" => "images/basketball.png"),
	"104" => array("Price:$110.00" => "images/table-tennis.png"),
	"105" => array("Price:$80.00" => "images/soccer.png"),
);
$prices = array(
	"101" => "150",
	"102" => "120",
	"103" => "90",
	"104" => "110",
	"105" => "80"
);

// foreach($prices as $price => $name){

// 	// echo $price;
// 	echo $name."<br>";
// };
// echo $prices['101'] . "<br>";
// echo $prices['102'] . "<br>";
// echo $prices['103'] . "<br>";
// echo "<pre>";
// print_r($_GET);
// echo "</pre>";
// echo $_GET['id'] . "<br>";
// include 'ischeck.php';

if ($_GET['val'] == 'add') {

	if (!isset($_SESSION['cart'])) {
		// echo "in if";
		$_SESSION['cart'] = array();
		$_SESSION['tprice'] = 0;
		$_SESSION['tqnty'] = 0;
	}
	if (isset($_SESSION["cart"])) {

		if (ischeck($_GET['id']) == true) {

			$_SESSION['tqnty'] += 1;
			$_SESSION['tprice'] += $prices[$_GET['id']];
			// $tprice=$tprice+$prices[$_GET['id']];


			array_push($_SESSION['cart'], $_GET);
		}
	}
}
if ($_GET['val'] == 'delete') {

	// echo "indel";
	if (ischeck($_GET['id']) == false) {

		$_SESSION['tqnty'] -= 1;
		$_SESSION['tprice'] -= $prices[$_GET['id']];
	}

	delete($_GET['id']);
}




// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";


function ischeck($id)
{
	foreach ($_SESSION as $idx => $arr) {
		if ($idx == 'tprice' || $idx == 'tqnty') {
			continue;
		}
		foreach ($arr as $k => $v) {

			if ($v['id'] == $id) {
				// echo "false";
				return false;
			}
		}
	}
	// echo "true";

	return true;
}

// session_unset();
// session_destroy();


function disply()
{


	$html = "<table><tr><th>product id</th><th>product price</th></tr>";
	foreach ($_SESSION as $key => $val) {
		if ($key == 'tprice' || $key == 'tqnty') {
			continue;
		}

		foreach ($val as $key1 => $val1) {

			$html .= "<tr><form action='' method=GET><td>"
				. $val1['id'] .
				"</td><td>"
				. $val1['price'] .
				"</td><td>"
				. "<a href=products.php?id=" . $val1['id'] . "&price=" . $val1['price'] . "&val=delete" . ">delete</a>" .
				"</td></form></tr>";
		}

		$html .= "</table>";
	}

	echo $html;
}


function delete($id)
{
	foreach ($_SESSION as $idx => $arr) {
		if ($idx == 'tprice' || $idx == 'tqnty') {
			continue;
		}
		foreach ($arr as $k => $v) {

			if ($v['id'] == $id) {
				echo $v['id'] . "<br>" . $id;
				unset($_SESSION[$idx][$k]);
			}
		}
	}
	
}
?>
