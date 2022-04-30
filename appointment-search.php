<?php
session_start();
// error_reporting(0);
include('includes/dbconnection.php');
?>

<!DOCTYPE html>

<!--Cafe search section start-->
<section class="">
            <div class="">
                <?php 
                
                     //get the search keyword
                     $search = $_POST['search'];

                ?>
                <h2 class = "cream">Appointment on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>
            </div>
    </section>
    <!--Cafe search section ends-->

    <!--Cafe Menu section start-->
    <section class="">
        <div class="">
            <h2 class="">Search</h2>

            <?php

                //sql query to get beverage based on search
                $sql = "SELECT * from tblappointment WHERE AptNumber LIKE '%$search%' OR PhoneNumber LIKE '%$search%'";

                //execute the query
                $res = mysqli_query($con, $sql);

                //count the rows
                $count = mysqli_num_rows($res);

                //check if beverage is available or not
                if($count>0){
                    //beverage available
                    while($row=mysqli_fetch_assoc($res)){
                        //get the values
                        $id = $row['ID'];
                        $name = $row['Name'];
                        $email = $row['Email'];
                        $phonenumber = $row['PhoneNumber'];
                        $AptDate = $row['AptDate'];
                        $AptTime = $row['AptTime'];
                        ?>

                        <form action="" method="POST">
                                    <table class="tbl-30">
                                        <tr>
                                            <td>Name: </td>
                                            <td>
                                                <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>email: </td>
                                            <td>
                                                <input type="text" name="username" value="<?php echo $username; ?>">
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td colspan="2">
                                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                                            </td>
                                        </tr>
                                    </table>
                        </form>
                        <div class="cafe-menu-box">
                            <div class="cafe-menu-img">
                                <?php
                                    //check if image name is available
                                    if($image_name==""){
                                        //image not available
                                        echo "<div class='error'>Image Not Available.</div>";
                                    }
                                    else{
                                        //image available
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/beverage/<?php echo $image_name; ?>" alt="Iced Hazelnut Dutch Truffle" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                            </div>

                            <div class="cafe-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                    <p class="cafe-price">$<?php echo $price; ?></p>
                                    <p class="cafe-details"><?php echo $description; ?></p>
                                    <br>

                                    <a href="<?php echo SITEURL; ?>order.php?beverage_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>
                        <?php
                    }
                }
                else{
                    //beverage not availble
                    echo "<div class='error'>Beverage Not Found</div>";
                }
            
            ?>


            <div class="clearfix"></div>
        </div>
    </section>
    <!--Cafe Menu section ends-->

<?php include('partials-front/footer.php'); ?>