<?php
include 'includes/connect.php';


	if($_SESSION['admin_sid']==session_id())
	{
		?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Shop Ceylon</title>


  <!-- Favicons-->
  <link rel="shortcut icon" href="images/logon.png" sizes="32x32">


  <!-- CORE CSS-->
  <link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="css/style.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <!-- Custome CSS-->    
  <link href="css/custom/custom.min.css" type="text/css" rel="stylesheet" media="screen,projection">

  <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
  <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="js/plugins/data-tables/css/jquery.dataTables.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  
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
    <a class="navbar-brand" href="https://shopceylon.com/">
      <img src="images/logon.png" alt="Logo" style="width:60px;" class="rounded-pill">
    </a>
    <a href="https://shopceylon.com/" type="button" class="btn btn-outline-success">LogOut</a>
    <a href="index.php" type="button" class="btn btn-outline-success">Items Menu</a>
    <a href="all-orders.php" type="button" class="btn btn-outline-success">All Orders</a>
    <a href="all-orders.php?status=Yettobedelivered" type="button" class="btn btn-outline-success">Yet to be Delivered</a>
    <a href="all-orders.php?status=Cancelled%20by%20Customer" type="button" class="btn btn-outline-success">Cancelled by Customer</a>
    <a href="all-orders.php?status=Paused" type="button" class="btn btn-outline-success">Pused</a>
    <a href="users.php" type="button" class="btn btn-outline-success">User</a>



    <a class="navbar-brand" href="#">
      <img src="images/avatar.jpg" alt="user" style="width:40px;" class="rounded-pill">
    </a>
  </div>
</nav>

      <!-- START CONTENT -->
      <section id="content">

        <!--breadcrumbs start-->
        
        <!--breadcrumbs end-->


        <!--start container-->
        <div class="container">
          
		  <form class="formValidate" id="formValidate" method="post" action="routers/menu-router.php" novalidate="novalidate">
            <div class="row">
              <div class="col s12 m4 l3">
                <h4 class="breadcrumbs-title">Edit Menu Items</h4>
              </div>
              <div>
				<table id="data-table-admin" class="responsive-table display" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Item Price/Piece</th>
                        <th>Image</th>
                      </tr>
                    </thead>

                    <tbody>
				<?php
				$result = mysqli_query($con, "SELECT * FROM items");
				while($row = mysqli_fetch_array($result))
				{
					echo '<tr><td><div class="input-field col s12"><label for="'.$row["id"].'_name">Name</label>';
					echo '<input value="'.$row["name"].'" id="'.$row["id"].'_name" name="'.$row['id'].'_name" type="text" data-error=".errorTxt'.$row["id"].'"><div class="errorTxt'.$row["id"].'"></div></td>';					
					echo '<td><div class="input-field col s12 "><label for="'.$row["id"].'_price">Price</label>';
					echo '<input value="'.$row["price"].'" id="'.$row["id"].'_price" name="'.$row['id'].'_price" type="text" data-error=".errorTxt'.$row["id"].'"><div class="errorTxt'.$row["id"].'"></div></td>';                   
					echo '<td>';
					if($row['deleted'] == 0){
						$text1 = 'selected';
						$text2 = '';
					}
					else{
						$text1 = '';
						$text2 = 'selected';						
					}
					echo '
					<img src="data:image/jpeg;base64,'.base64_encode($row['image']).'" id="'.$row["id"].'_image" name="'.$row['id'].'_image" type="file" data-error=".errorTxt'.$row["id"].'"><div class="errorTxt'.$row["id"].'"></div>
                    </td></tr>';
				}
				?>
                    </tbody>
</table>
              </div>
			  <div class="input-field col s12">
                              <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Modify
                                <i class="mdi-content-send right"></i>
                              </button>
                            </div>
            </div>
			</form>
		  <form class="formValidate" id="formValidate1" method="post" action="routers/add-item.php" novalidate="novalidate" enctype="multipart/form-data">
            <div class="row">
              <div class="col s12 m4 l3">
                <h4 class="header">Add Item</h4>
              </div>
              <div>
<table>
                    <thead>
                      <tr>
                        <th data-field="id">Name</th>
                        <th data-field="name">Item Price/Piece</th>
                        <th data-field="image">Image</th>
                      </tr>
                    </thead>

                    <tbody>
				<?php
				
					echo '<tr><td><div class="input-field col s12"><label for="name">Name</label>';
					echo '<input id="name" name="name" type="text" data-error=".errorTxt01"><div class="errorTxt01"></div></td>';					
					echo '<td><div class="input-field col s12 "><label for="price" class="">Price</label>';
					echo '<input id="price" name="price" type="text" data-error=".errorTxt02"><div class="errorTxt02"></div></td>';

					echo '<td><div class="input-field col s12 ">';
					echo '
					<input type="file" id="image" name="image" data-error=".errorTxt01"><div class="errorTxt01"></div></td>';                   
					echo '<td></tr>';
				?>
                    </tbody>
</table>
              </div>
			  <div class="input-field col s12">
                              <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Add
                                <i class="mdi-content-send right"></i>
                              </button>
                            </div>
            </div>
			</form>			
            <div class="divider"></div>
            
          </div>
        </div>
        </div>
        <!--end container-->

      </section>
      <!-- END CONTENT -->
    </div>
    <!-- END WRAPPER -->




    
    <!-- jQuery Library -->
    <script type="text/javascript" src="js/plugins/jquery-1.11.2.min.js"></script>    
    <!--angularjs-->
    <script type="text/javascript" src="js/plugins/angular.min.js"></script>
    <!--materialize js-->
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <!--scrollbar-->
    <script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <!-- data-tables -->
    <script type="text/javascript" src="js/plugins/data-tables/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/plugins/data-tables/data-tables-script.js"></script>
    
    <script type="text/javascript" src="js/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script type="text/javascript" src="js/plugins/jquery-validation/additional-methods.min.js"></script>
    
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="js/plugins.min.js"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="js/custom-script.js"></script>
	    <script type="text/javascript">
    $("#formValidate").validate({
        rules: {
			<?php
			$result = mysqli_query($con, "SELECT * FROM items");
			while($row = mysqli_fetch_array($result))
			{
				echo $row["id"].'_name:{
				required: true,
				minlength: 5,
				maxlength: 20 
				},';
				echo $row["id"].'_price:{
				required: true,	
				min: 0
				},';				
			}
		echo '},';
		?>
        messages: {
			<?php
			$result = mysqli_query($con, "SELECT * FROM items");
			while($row = mysqli_fetch_array($result))
			{  
				echo $row["id"].'_name:{
				required: "Ener item name",
				minlength: "Minimum length is 5 characters",
				maxlength: "Maximum length is 20 characters"
				},';
				echo $row["id"].'_price:{
				required: "Ener price of item",
				min: "Minimum item price is Rs. 0"
				},';				
			}
		echo '},';
		?>
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
    </script>
    <script type="text/javascript">
    $("#formValidate1").validate({
        rules: {
		name: {
				required: true,
				minlength: 5
			},
		price: {
				required: true,
				min: 0
			},
	},
        messages: {
		name: {
				required: "Enter item name",
				minlength: "Minimum length is 5 characters"
			},
		 price: {
				required: "Enter item price",
				minlength: "Minimum item price is Rs.0"
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
    </script>
</body>

</html>
<?php
	}
	else
	{
		if($_SESSION['customer_sid']==session_id())
		{
			header("location:index.php");		
		}
		else{
			header("location:login.php");
		}
	}
?>