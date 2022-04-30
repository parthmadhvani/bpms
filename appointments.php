<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');



  ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>BarberKing Appointments</title>

  <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i,900,900i" rel="stylesheet">

  <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
  <link rel="stylesheet" href="css/animate.css">

  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/magnific-popup.css">

  <link rel="stylesheet" href="css/aos.css">

  <link rel="stylesheet" href="css/ionicons.min.css">

  <link rel="stylesheet" href="css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="css/jquery.timepicker.css">


  <link rel="stylesheet" href="css/flaticon.css">
  <link rel="stylesheet" href="css/icomoon.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
      <div class="container">
        <a class="navbar-brand" href="index.php">BarberKing</a>
       
        <div class="collapse navbar-collapse" id="ftco-nav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
            <li class="nav-item"><a href="services.php" class="nav-link">Services</a></li>
            
            <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
            <li class="nav-item active"><a href="appointments.php" class="nav-link">Appointments</a></li>
            <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
            
            <li class="nav-item"><a href="admin/index.php" class="nav-link">Admin</a></li>
          </ul>
        </div>
      </div>
    </nav>

  <section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg-2.jpg');"
    data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
        <div class="col-md-9 ftco-animate pb-5">
          <h2 class="mb-0 bread">Appointments</h2>
          <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i
                  class="ion-ios-arrow-forward"></i></a></span> <span>Appointment <i
                class="ion-ios-arrow-forward"></i></span></p>
        </div>
      </div>
    </div>
  </section>



  <section class="ftco-section ftco-pricing">
    <div class="container">
      <div class="row justify-content-center pb-3">
        <div class="col-md-10 heading-section text-center ftco-animate">
          <h1 class="big">Search</h1>
          <span class="subheading">Search</span>
          <h2 class="mb-4">Your Appointment</h2>
          <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
        </div>
      </div>
  </section>
  <div class="form">
  <form class="appointment_form" action="" method="POST">
            <div class="appointment_form_content">
            <input type="search" name="search" class="search_input" placeholder="Search Appointment">
            <input type="submit" name="search-btn" class="search-btn" value="search">
            </div>
  </form>
  </div>

 

  <?php
    if(isset($_POST['search-btn']))
    {
        // echo "Great";
      $search = $_POST['search'];
    //   echo $search;
        //sql query to get beverage based on search
        $sql = "SELECT * from tblappointment WHERE AptNumber='$search' OR PhoneNumber=$search";
    
        //execute the query
        $res = mysqli_query($con, $sql);

        //count the rows
        $count = mysqli_num_rows($res);

        //check if beverage is available or not
        // echo $count;
        if($count>0)
        {
            //beverage available
            while($row=mysqli_fetch_assoc($res))
            {
                //get the values
                        $id = $row['ID'];
                        $name = $row['Name'];
                        $email = $row['Email'];
                        $phonenumber = $row['PhoneNumber'];
                        $aptdate = $row['AptDate'];
                        $apttime = $row['AptTime'];
                        $location = $row['Location'];
                        $services = $row['Services'];
                        $status = $row["Status"];
                        if($status==1){
                          $aaa = 'Accepted';
                        }
                        if($status==2){
                          $aaa = 'Rejected';
                        }
                        if($status==""){
                          $aaa = 'Pending';
                        }
                        // $services = $row['Services'];
            }   
            // echo $services;
            $str_arr = explode (",", $services); 
            // print_r($str_arr);
            ?>
    <div class="">
          <!-- <form class="appointment_form" action="" method="POST">
            <input type="search" name="search" class="search_input" placeholder="Search Appointment">
            <input type="submit" name="search-btn" class="search-btn" value="search">
          </form> -->
          <form  class="appointment_form2" action="" method="POST">
         <div class="appointment_form2_content">
         <table class="tbl-30">
            <tr>
              <td>Name: </td>
              <td>
                <input type="text" name="Name" class="input_other" value="<?php echo $name; ?>">
              </td>
            </tr>

            <tr>
              <td>Email: </td>
              <td>
                <input type="email" name="Email" class="input_other" value="<?php echo $email; ?>">
              </td>
            </tr>
            <tr>
              <td>Services: </td>
              <td>
              <div class="col-sm-12">
                    <div id="list1" class="dropdown-check-list" tabindex="100">
                      <span class="form-group anchor services_index">Select services</span>
                        <ul class="items">
                          <?php $query=mysqli_query($con,"select ServiceName from tblservices");
                          while($row=mysqli_fetch_array($query))
                          {
                            $print = false;
                            for($i=0;$i<sizeof($str_arr);$i++){
                              if($str_arr[$i]==$row['ServiceName']){
                                $print = true;
                                break;
                              }
                              // else $print=false;
                          }
                          
                          if($print){
                            ?>
                                  <li><input name="services[]" value="<?php echo $row['ServiceName'];?>" type="checkbox" checked /> <?php echo $row['ServiceName'];?> </li>
                            <?php
                          }
                          else{
                            ?>	<li><input name="services[]" value="<?php echo $row['ServiceName'];?>" type="checkbox"/> <?php echo $row['ServiceName'];?> </li>
                            <?php
                          }
                        } ?> 
                        </ul>
                    </div>
              </div>
              </td>
            </tr>
            <tr>
              <td>Phone Number: </td>
              <td>
                <input type="text" name="PhoneNumber" class="input_other" value="<?php echo $phonenumber; ?>">
              </td>
            </tr>
            <tr>
              <td>Date: </td>
              <td>
                <input type="date" name="AptDate" class="input_other" value="<?php echo $aptdate; ?>">
              </td>
            </tr>
            <tr>
              <td>Time: </td>
              <td>
                <input type="time" name="AptTime" class="input_other" value="<?php echo $apttime; ?>">
              </td>
            </tr>
            <tr>
              
              <td>Location: </td>
              <td>
              <div class="col-sm-12">
                <div class="list_location" class="dropdown-check-list" tabindex="100">
                    <select name="location">
                      <option value="">Select Location</option>
                      <?php $query=mysqli_query($con,"select * from admin");
                        while($row=mysqli_fetch_array($query))
                        {
                      ?>
                      <option value="<?php echo $row['franch_name'];?>"><?php echo $row['franch_name'];?></option>
                      <?php } ?> 
                    </select>
                </div>
              </div>
              </td>
            </tr>
            <tr>
              <td>Status: </td>
              <td>
                <input type="text" name="AptTime" class="input_other" value="<?php echo $aaa; ?>">
              </td>
            </tr>
            <tr>
            <tr>
              <td colspan="2">
                <input type="hidden" name="ID" value="<?php echo $id; ?>">
                <input type="submit" class="btn-app-submit" name="submit" value="Update Appointment" class="btn-secondary">
              </td>
            </tr>
          </table>
         </div>
        </form>
  </div>
  <?php
        }
        else{
            //beverage not availble
            echo "<div>Appointment Not Found</div>";
        }
    }
   
    ?>

  

  <?php 
    //check whether the submit button is clicked or not
    if(isset($_POST['submit'])){
        //echo "Button Clicked";
        //Get all the values from form to update
        $id = $_POST['ID'];
        $email = $_POST['Email'];
        $phonenumber = $_POST['PhoneNumber'];
        $aptdate = $_POST['AptDate'];
        $apttime = $_POST['AptTime'];
        $name = $_POST['Name'];
        $location = $_POST['location'];
        $services = $_POST['services'];
        $chk="";
        foreach($services as $chk1)  
        {  
         $chk .= $chk1.",";  
        }  

        //Create a SQL Query to Update Admin
        $sql2 = "UPDATE tblappointment SET
        Email = '$email',
        PhoneNumber = '$phonenumber',
        AptDate = '$aptdate',
        AptTime = '$apttime',
        Name = '$name',
        Location = '$location',
        Services = '$chk'
        WHERE ID = '$id'
        ";

        //Execute the Query
        $res2 = mysqli_query($con,$sql2);

        //check query execute successfully or not
        if($res2==true){
            ?>
            <!-- <script>alert("Your Date Has Been Updated")</script> -->
            <?php
        }
        else{
            //Redirect to manage admin page
            ?>
            <!-- <script>alert("Your Data Could Not Be Updated")</script> -->
            <?php
        }
    ?>
    
  <?php
    }
?>

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
      <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
      <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
        stroke="#F96D00" />
    </svg></div>

    <?php include_once('includes/footer.php');?>
  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/jquery.timepicker.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
  <script>
	  var checkList = document.getElementById('list1');
checkList.getElementsByClassName('anchor')[0].onclick = function(evt) {
  if (checkList.classList.contains('visible'))
    checkList.classList.remove('visible');
  else
    checkList.classList.add('visible');

  // $str_arr
  // if(let i=0;$str_arr.length;i++){

  // }

  }
  </script>

<style>
.dropdown-check-list {
  display: inline-block;
  height: 60px !important;
  width:100%;
  padding-top: 1px;
}

.dropdown-check-list .anchor {
    position: relative;
    left: 15px;
    top: 5px;
    cursor: pointer;
    display: inline-block;
    padding: 7px 50px 7px 10px;
    border: 1px solid;
    text-transform: uppercase;
    color: #563b4c;
    font-size: 14px;
    font-weight: 500;
    border-radius: 2px;
    width:112%;
}

.dropdown-check-list .anchor:after {
  position: absolute;
  content: "";
  border-left: 2px solid black;
  border-top: 2px solid black;
  padding: 5px;
  right: 10px;
  top: 20%;
  -moz-transform: rotate(-135deg);
  -ms-transform: rotate(-135deg);
  -o-transform: rotate(-135deg);
  -webkit-transform: rotate(-135deg);
  transform: rotate(-135deg);
  color: red;
  font-weight: 100000;
}

.dropdown-check-list .anchor:active:after {
  right: 8px;
  top: 21%;
}

.dropdown-check-list ul.items {
  padding: 2px;
  display: none;
  margin: 0;
  border: 1px solid #ccc;
  border-top: none;
}

.dropdown-check-list ul.items li {
  list-style: none;
}

.services_index{
	text-align: left;
}

.dropdown-check-list.visible .anchor {
  color: #0094ff;
}

.dropdown-check-list.visible .items {
  display: block;
  text-align: left;
}

.search_input{
  width:30% !important;
  /* margin-left:150px; */
  margin-bottom:75px;
  border-radius: 3px;
}

.appointment_form{
  /* margin-left:500px; */
}

.appointment_form2{
  /* margin-left:650px;  */
}

.appointment_form2_content{
  text-align: -webkit-center;
}

.btn-app-submit{
  background-color:#f18c8e;
  margin:10% 0%;
}

.btn-app-submit:hover{
  font-weight: bold;
}

.appointment_form_content{
  text-align: center;
}
.appointment_form2 .input_other{
  margin:2px 0px 10px 30px;
  height: 40px !important;
    cursor: pointer;
    display: inline-block;
    padding: 5px 5px 5px 10px;
    border: 1px solid;
    text-transform: uppercase;
    color: #563b4c;
    font-size: 14px;
    font-weight: 500;
    border-radius: 2px;
    width:100%;
}

.appointment_form2 .list_location select{
  margin:2px 0px 10px 30px;
  height: 40px !important;
  left:-15px;
  position: relative;
    cursor: pointer;
    display: inline-block;
    padding: 7px 50px 7px 10px;
    border: 1px solid;
    text-transform: uppercase;
    color: #563b4c;
    font-size: 14px;
    font-weight: 500;
    border-radius: 2px;
    width:112%;
}

.search-btn{
  cursor: pointer;
  width:10% !important;
  text-align:center;
  text-transform: uppercase;
  background-color:#f18c8e;
}

.search-btn:hover{
  font-weight:bold;
}
</style>
</body>

</html>

