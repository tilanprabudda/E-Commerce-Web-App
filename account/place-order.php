<?php
include 'includes/connect.php';
include 'includes/wallet.php';
$total = 0;
	if($_SESSION['customer_sid']==session_id())
	{
$result = mysqli_query($con, "SELECT * FROM users where id = $user_id");
while($row = mysqli_fetch_array($result)){
$name = $row['name'];	
$address = $row['address'];
$contact = $row['contact'];
$verified = $row['verified'];
}
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
        <style type="text/css">
  .input-field div.error{
    position: relative;
    top: -1rem;
    left: 0rem;
    font-size: 0.8rem;
    color:#FF4081;
    -webkit-transform: translateY(0%);
    -ms-transform: translateY(0%);
    -o-transform: translateY(0%);
    transform: translateY(0%);
  }
  .input-field label.active{
      width:100%;
  }
  .left-alert input[type=text] + label:after, 
  .left-alert input[type=password] + label:after, 
  .left-alert input[type=email] + label:after, 
  .left-alert input[type=url] + label:after, 
  .left-alert input[type=time] + label:after,
  .left-alert input[type=date] + label:after, 
  .left-alert input[type=datetime-local] + label:after, 
  .left-alert input[type=tel] + label:after, 
  .left-alert input[type=number] + label:after, 
  .left-alert input[type=search] + label:after, 
  .left-alert textarea.materialize-textarea + label:after{
      left:0px;
  }
  .right-alert input[type=text] + label:after, 
  .right-alert input[type=password] + label:after, 
  .right-alert input[type=email] + label:after, 
  .right-alert input[type=url] + label:after, 
  .right-alert input[type=time] + label:after,
  .right-alert input[type=date] + label:after, 
  .right-alert input[type=datetime-local] + label:after, 
  .right-alert input[type=tel] + label:after, 
  .right-alert input[type=number] + label:after, 
  .right-alert input[type=search] + label:after, 
  .right-alert textarea.materialize-textarea + label:after{
      right:70px;
  }
  </style>
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

  <!-- START MAIN -->
  <div id="main">
    <!-- START WRAPPER -->
    <div class="wrapper">

      <!-- START LEFT SIDEBAR NAV-->
      


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
          <p class="caption">Provide required delivery and payment details.</p>
          <div class="divider"></div>
            <div class="row">
              <div class="col s12 m4 l3">
                <h4 class="header">Details</h4>
              </div>
<div>
                <div class="card-panel">
                  <div class="row">
                    <form class="formValidate col s12 m12 l6" id="formValidate" method="post" action="confirm-order.php" novalidate="novalidate">
                      <div class="row">
                        <div class="input-field col s12">
							<label for="payment_type">Payment Type</label><br><br>
							<select id="payment_type" name="payment_type">
									<option value="Cash On Delivery" >Cash on Delivery</option>							
							</select>
                        </div>
                      </div>					
                      <div class="row">
                        <div class="input-field col s12">
                          <i class="mdi-action-home prefix"></i>
							<textarea name="address" id="address" class="materialize-textarea validate" data-error=".errorTxt1"><?php echo $address;?></textarea>
							<label for="address" class="">Name, Contact Number and Address </label>
							<div class="errorTxt1"></div>
                        </div>
                      </div>
                      <!-- <div class="row">
                        <div class="input-field col s12">
                          <i class="mdi-action-credit-card prefix"></i>
							<input name="cc_number" id="cc_number" type="text" data-error=".errorTxt2" required>
							<label for="cc_number" class="">Card Number</label>
							<div class="errorTxt2"></div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="input-field col s12">
                          <i class="mdi-communication-vpn-key prefix"></i>	
							<input name="cvv_number" id="cvv_number" type="text" data-error=".errorTxt3" required>
							<label for="cvv_number" class="">CVV Number</label>								
							<div class="errorTxt3"></div> -->
                        </div>
                      </div>					  
                      <div class="row">
                        <div class="row">
                          <div class="input-field col s12">
                            <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Submit
                              <i class="mdi-content-send right"></i>
                            </button>
                          </div>
                        </div>
                      </div>
					  <?php
					  	foreach ($_POST as $key => $value)
						{
							if($key == 'action' || $value == ''){
								break;
							}
							echo '<input name="'.$key.'" type="hidden" value="'.$value.'">';
						}
					  ?>
                    </form>
                  </div>
                </div>
              </div>
            <div class="divider"></div>
            
          </div>
        <!--end container-->

      </div>
	  
        <div class="container">
          <p class="caption">Estimated Receipt</p>
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
        <a href="#" class="secondary-content"><i class="mdi-action-grade"></i></a>';
		
	foreach ($_POST as $key => $value)
	{
		if($value == ''){
			break;
		}
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
?>
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
  <!-- END MAIN -->
    
    <!-- jQuery Library -->
    <script type="text/javascript" src="js/plugins/jquery-1.11.2.min.js"></script>    
    <!--angularjs-->
    <script type="text/javascript" src="js/plugins/angular.min.js"></script>
    <!--materialize js-->
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <!--scrollbar-->
    <script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script type="text/javascript" src="js/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script type="text/javascript" src="js/plugins/jquery-validation/additional-methods.min.js"></script>	
	<script type="text/javascript" src="js/plugins/formatter/jquery.formatter.min.js"></script>   
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="js/plugins.min.js"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="js/custom-script.js"></script>
	<script type="text/javascript">
    $("#formValidate").validate({
        rules: {
            address: {
                required: true,
                minlength: 5
            },
            cc_number: {
                required: true,
                minlength: 16,
            },
            cvv_number: {
                required: true,
                minlength: 3,
			},
		},
        messages: {
           address:{
                required: "Enter a address",
                minlength: "Enter at least 5 characters"
            },	
           cc_number:{
                required: "Please provide card number",
                minlength: "Enter at least 16 digits",
            },	
           cvv_number:{
                required: "Please provide CVV number",
                minlength: "Enter at least 3 digits",		
            },				
		},
        errorElement : 'div',
        errorPlacement: function(error, element) {
          var placement = $(element).data('error');
          if (placement) {
            $(placement).append(error)
          } else {
            error.insertAfter(element);
          }
        }
     });
	  $('#cc_number').formatter({
          'pattern': '{{9999}}-{{9999}}-{{9999}}-{{9999}}',
          'persistent': true
      });
	  $('#cvv_number').formatter({
          'pattern': '{{9}}-{{9}}-{{9}}',
          'persistent': true
      });
		$('#payment_type').change(function() {
		if ($(this).val() === 'Cash On Delivery') {
		  $("#cc_number").prop('disabled', true);
		  $("#cvv_number").prop('disabled', true);		  
		}
		if ($(this).val() === 'Wallet'){
		  $("#cc_number").prop('disabled', false);
		  $("#cvv_number").prop('disabled', false);	
		}
		});
    </script>
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