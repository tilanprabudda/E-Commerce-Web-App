<?php
include 'includes/connect.php';
include 'includes/wallet.php';
$continue=0;
$total = 0;
if($_SESSION['customer_sid']==session_id())
{
		if($_POST['payment_type'] == 'Wallet'){
		$_POST['cc_number'] = str_replace('-', '', $_POST['cc_number']);
		$_POST['cc_number'] = str_replace(' ', '', $_POST['cc_number']); 
		$_POST['cvv_number'] = (int)str_replace('-', '', $_POST['cvv_number']);
		$sql1 = mysqli_query($con, "SELECT * FROM wallet_details where wallet_id = $wallet_id");
		while($row1 = mysqli_fetch_array($sql1)){
			$card = $row1['number'];
			$cvv = $row1['cvv'];
			if($card == $_POST['cc_number'] && $cvv==$_POST['cvv_number'])
			$continue=1;
			else
				header("location:index.php");
		}
		}
		else
			$continue=1;
}

$result = mysqli_query($con, "SELECT * FROM users where id = $user_id");
while($row = mysqli_fetch_array($result)){
	$name = $row['name'];
	$contact = $row['contact'];
}

if($continue){
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Shop Ceylon</title>
  <link rel="shortcut icon" href="images/logon.png" sizes="32x32">
  <link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="css/style.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="css/custom/custom.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="js/plugins/data-tables/css/jquery.dataTables.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">  

</head>

<body>


<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="www.shopceylon.com">
      <img src="images/logon.png" alt="Logo" style="width:60px;" class="rounded-pill">
    </a>
    <a href="routers/logout.php" type="button" class="btn btn-outline-success">LogOut</a>
    <a href="index.php" type="button" class="btn btn-outline-success">New Orders</a>
    <a href="details.php" type="button" class="btn btn-outline-success">Edit</a>

    <a class="navbar-brand" href="#">
      <img src="images/avatar.jpg" alt="user" style="width:40px;" class="rounded-pill">
    </a>
  </div>
</nav>

      <!-- START CONTENT -->
      <section id="content">

        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper">
          <div class="container">
            <div class="row">
              <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title">Provide Order Details</h5>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->


        <!--start container-->
        <div class="container">
          <p class="caption">Receipt</p>
          <div class="divider"></div>
          <!--editableTable-->
<div id="work-collections" class="seaction">
<div class="row">
<div>
<ul id="issues-collection" class="collection">
<?php
    echo '<li class="collection-item avatar">
        <i class="mdi-content-content-paste red circle"></i>
        <p><strong>Name:</strong>'.$name.'</p>
		<p><strong>Contact Number:</strong> '.$contact.'</p>
		<p><strong>Address:</strong> '.htmlspecialchars($_POST['address']).'</p>	
		<p><strong>Payment Type:</strong> '.$_POST['payment_type'].'</p>			
        <a href="#" class="secondary-content"><i class="mdi-action-grade"></i></a>';
		
	foreach ($_POST as $key => $value)
	{
		if(is_numeric($key)){		
		$result = mysqli_query($con, "SELECT * FROM items WHERE id = $key");
		while($row = mysqli_fetch_array($result))
		{
			$price = $row['price'];
			$item_name = $row['name'];
			$item_id = $row['id'];
		}
			$price = $value*$price;
			    echo '<li class="collection-item">
        <div class="row">
            <div class="col s7">
                <p class="collections-title"><strong>#'.$item_id.' </strong>'.$item_name.'</p>
            </div>
            <div class="col s2">
                <span>'.$value.' Pieces</span>
            </div>
            <div class="col s3">
                <span>Rs. '.$price.'</span>
            </div>
        </div>
    </li>';
		$total = $total + $price;
	}
	}
    echo '<li class="collection-item">
        <div class="row">
            <div class="col s7">
                <p class="collections-title"> Total</p>
            </div>
            <div class="col s2">
                <span>&nbsp;</span>
            </div>
            <div class="col s3">
                <span><strong>Rs. '.$total.'</strong></span>
            </div>
        </div>
    </li>';
	if(!empty($_POST['description']))
		echo '<li class="collection-item avatar"><p><strong>Note: </strong>'.htmlspecialchars($_POST['description']).'</p></li>';
	if($_POST['payment_type'] == 'Wallet')
	echo '<div id="basic-collections" class="section">
		<div class="row">
			<div class="collection">
				<a href="#" class="collection-item">
					<div class="row"><div class="col s7">Current Balance</div><div class="col s3">'.$balance.'</div></div>
				</a>
				<a href="#" class="collection-item active">
					<div class="row"><div class="col s7">Balance after purchase</div><div class="col s3">'.($balance-$total).'</div></div>
				</a>
			</div>
		</div>
	</div>';
?>
<form action="routers/order-router.php" method="post">
<?php
foreach ($_POST as $key => $value)
{
	if(is_numeric($key)){
		echo '<input type="hidden" name="'.$key.'" value="'.$value.'">';
	}
}
?>
<input type="hidden" name="payment_type" value="<?php echo $_POST['payment_type'];?>">
<input type="hidden" name="address" value="<?php echo htmlspecialchars($_POST['address']);?>">
<?php if (isset($_POST['description'])) { echo'<input type="hidden" name="description" value="'.htmlspecialchars($_POST['description']).'">';}?>
<?php if($_POST['payment_type'] == 'Wallet') echo '<input type="hidden" name="balance" value="<?php echo ($balance-$total);?>">'; ?>
<input type="hidden" name="total" value="<?php echo $total;?>">
<div class="input-field col s12">
<button class="btn cyan waves-effect waves-light right" type="submit" name="action" <?php if($_POST['payment_type'] == 'Wallet') {if ($balance-$total < 0) {echo 'disabled'; }}?>>Confirm Order
<i class="mdi-content-send right"></i>
</button>
</div>
</form>
</ul>


                </div>
				</div>
                </div>
              </div>
            </div>
        </div>
        <!--end container-->

      </section>
      <!-- END CONTENT -->
    </div>
    <!-- END WRAPPER -->

  </div>

    
    <!-- jQuery Library -->
    <script type="text/javascript" src="js/plugins/jquery-1.11.2.min.js"></script>    
    <!--angularjs-->
    <script type="text/javascript" src="js/plugins/angular.min.js"></script>
    <!--materialize js-->
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <!--scrollbar-->
    <script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script> 
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="js/plugins.min.js"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="js/custom-script.js"></script>
</body>

</html>
<?php
	}
	else
	{
		if($_SESSION['admin_sid']==session_id())
		{
			header("location:admin-page.php");		
		}
		else{
			header("location:login.php");
		}
	}
?>
