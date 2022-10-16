<?php
include 'includes/connect.php';
include 'includes/wallet.php';

	if($_SESSION['customer_sid']==session_id())
	{
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
  <!-- END HEADER -->
<br>
      <!-- START CONTENT -->
      <section id="content">

        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper">
          <div class="container">
            <div class="row">
              <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title">Past Orders</h5>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->


        <!--start container-->
        <div class="container">
          <p class="caption">List of your past orders with details</p>
          <div class="divider"></div>
          <!--editableTable-->
<div id="work-collections" class="seaction">
             
					<?php
					if(isset($_GET['status'])){
						$status = $_GET['status'];
					}
					else{
						$status = '%';
					}
					$sql = mysqli_query($con, "SELECT * FROM orders WHERE customer_id = $user_id AND status LIKE '$status';;");
					echo '              <div class="row">
                <div>
                    <h4 class="header">List</h4>
                    <ul id="issues-collection" class="collection">';
					while($row = mysqli_fetch_array($sql))
					{
						$status = $row['status'];
						echo '<li class="collection-item avatar">
                              <i class="mdi-content-content-paste red circle"></i>
                              <span class="collection-header">Order No. '.$row['id'].'</span>
                              <p><strong>Date:</strong> '.$row['date'].'</p>
                              <p><strong>Payment Type:</strong> '.$row['payment_type'].'</p>
							  <p><strong>Address: </strong>'.$row['address'].'</p>							  
                              <p><strong>Status:</strong> '.($status=='Paused' ? 'Paused <a  data-position="bottom" data-delay="50" data-tooltip="Please contact administrator for further details." class="btn-floating waves-effect waves-light tooltipped cyan">    ?</a>' : $status).'</p>							  
							  '.(!empty($row['description']) ? '<p><strong>Note: </strong>'.$row['description'].'</p>' : '').'						                               
							  <a href="#" class="secondary-content"><i class="mdi-action-grade"></i></a>
                              </li>';
						$order_id = $row['id'];
						$sql1 = mysqli_query($con, "SELECT * FROM order_details WHERE order_id = $order_id;");
						while($row1 = mysqli_fetch_array($sql1))
						{
							$item_id = $row1['item_id'];
							$sql2 = mysqli_query($con, "SELECT * FROM items WHERE id = $item_id;");
							while($row2 = mysqli_fetch_array($sql2)){
								$item_name = $row2['name'];
							}
							echo '<li class="collection-item">
                            <div class="row">
                            <div class="col s7">
                            <p class="collections-title"><strong>#'.$row1['item_id'].'</strong> '.$item_name.'</p>
                            </div>
                            <div class="col s2">
                            <span>'.$row1['quantity'].' Pieces</span>
                            </div>
                            <div class="col s3">
                            <span>Rs. '.$row1['price'].'</span>
                            </div>
                            </div>
                            </li>';
							$id = $row1['order_id'];
						}
								echo'<li class="collection-item">
                                        <div class="row">
                                            <div class="col s7">
                                                <p class="collections-title"> Total</p>
                                            </div>
                                            <div class="col s2">
											<span> </span>
                                            </div>
                                            <div class="col s3">
                                                <span><strong>Rs. '.$row['total'].'</strong></span>
                                            </div>';
								if(!preg_match('/^Cancelled/', $status)){
									if($status != 'Delivered'){
								echo '<form action="routers/cancel-order.php" method="post">
										<input type="hidden" value="'.$id.'" name="id">
										<input type="hidden" value="Cancelled by Customer" name="status">	
										<input type="hidden" value="'.$row['payment_type'].'" name="payment_type">											
										<button class="btn waves-effect waves-light right submit" type="submit" name="action">Cancel Order
                                              <i class="mdi-content-clear right"></i> 
										</button>
										</form>';
								}
								}
								echo'</div></li>';

					}
					?>
					 </ul>
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
			header("location:all-orders.php");		
		}
		else{
			header("location:login.php");
		}
	}
?>