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
    <a href="www.shopceylon.com" type="button" class="btn btn-outline-success">LogOut</a>
    <a href="orders.php" type="button" class="btn btn-outline-success">Past Orders</a>
    <a href="details.php" type="button" class="btn btn-outline-success">Edit</a>

    <a class="navbar-brand" href="#">
      <img src="images/avatar.jpg" alt="user" style="width:40px;" class="rounded-pill">
    </a>
  </div>
</nav>

  <div id="main">
      <section id="content">
        <div class="container">   
		  <form class="formValidate" id="formValidate" method="post" action="place-order.php" novalidate="novalidate">
            <div class="row" style="width: auto;">
              <div class="col s12 m4 l3">
                <h4 class="header">Order Items</h4>
              </div>
              <div>
                  <table id="data-table-customer" class="responsive-table display" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Name</th>

                        <th>Image</th>

                        <th>Item Price/Piece</th>

                        <th>Quantity</th>
                      </tr>
                    </thead>

                    <tbody>
				<?php
				$result = mysqli_query($con, "SELECT * FROM items where not deleted;");
				while($row = mysqli_fetch_array($result))
				{
					echo '<tr><td>'.$row["name"].'</td>
          <td><img src="data:image/jpeg;base64,'.base64_encode($row['image']).'" id="'.$row["id"].'_image" name="'.$row['id'].'_image" type="file" data-error=".errorTxt'.$row["id"].'"></td>
          <td>'.$row["price"].'</td>';                      
					echo '<td><div class="input-field col s12"><label for='.$row["id"].' class="">Quantity</label>';
					echo '<input id="'.$row["id"].'" name="'.$row['id'].'" type="text" data-error=".errorTxt'.$row["id"].'"><div class="errorTxt'.$row["id"].'"></div></td></tr>';
				}
				?>
                    </tbody>
</table>
              </div>
			  <div class="input-field col s12">
              <i class="mdi-editor-mode-edit prefix"></i>
              <textarea id="description" name="description" class="materialize-textarea"></textarea>
              <label for="description" class="">Any note(optional)</label>
			  </div>
			  <div>
			  <div class="input-field col s12">
                              <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Order
                                <i class="mdi-content-send right"></i>
                              </button>
                            </div>
            </div>
			</form>
            <div class="divider"></div>
            
          </div>
        </div>
        <!--end container-->

      </section>
      <!-- END CONTENT -->


  </div>
    <!-- END FOOTER -->



    <!-- ================================================
    Scripts
    ================================================ -->
    
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="js/plugins.min.js"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="js/custom-script.js"></script>
    <script type="text/javascript">
    $("#formValidate").validate({
        rules: {
			<?php
			$result = mysqli_query($con, "SELECT * FROM items where not deleted;");
			while($row = mysqli_fetch_array($result))
			{
				echo $row["id"].':{
				min: 0,
				max: 10
				},
				';
			}
		echo '},';
		?>
        messages: {
			<?php
			$result = mysqli_query($con, "SELECT * FROM items where not deleted;");
			while($row = mysqli_fetch_array($result))
			{  
				echo $row["id"].':{
				min: "Minimum 0",
				max: "Maximum 10"
				},
				';
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