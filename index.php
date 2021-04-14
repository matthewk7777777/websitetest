<?php include_once './includes/quip.dbh.inc.php' ?>

<!DOCTYPE html>
<html>
<head>
    <title>Responsive</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="styles.instaquip.css">
    <link crossorigin="anonymous" rel="stylesheet" id="sb-font-awesome-css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css?ver=5.5.3" type="text/css" media="all">
    


<style>
</style>
</head>

<body>
    <div class="header-container">
        <div class="left-nav">
            <div class="logo">
                <div class="home-link"><a href="#"><h1>quip</h1></a></div>

            </div>
        </div>

        <div class="right-nav" id="right-nav-bar">
            <div class="find-container">
                    <a href="index.php">Find a Quip</a>
            </div>

            <div class="how-it-works-container">
                    <a href="#">How it Works</a>
            </div>

            <div class="instructions-container">
                    <a href="#">Instructions</a>
            </div>

            <div class="instructions-container">
                <a href="#">Free Quips</a>
            </div>
            
            <div class="instructions-container">
                <a href="#">Return Quip</a>
            </div>
            
        </div>

        <div class="dropdown">
            <button onclick="myFunction()" class="dropbtn"><i class="fa fa-bars"></i></button>
                <div id="myDropdown" class="dropdown-content">
                <a href="index.php">Find a Quip</a>
                <a href="#">How it Works</a>
                <a href="#">Instructions</a>
                <a href="#">Make Money</a>
                <a href="#">Return Quip</a>
                </div>
          </div>

    </div>
    




    




    <div class="selection-container">
        <div class="product-list">
            <div class="items">



                    <div class="product-images">
                    <?php
                    $query = mysqli_query($conn, "SELECT * FROM stripe_checkout WHERE avail_status='Available' ORDER BY id ASC") or die(mysqli_error($conn));
                    if ($query->num_rows > 0) {
                        while ($row = mysqli_fetch_array($query)) {
                            $id = $row['id'];
                    ?>


                        <a href="product.php?id=<?php echo $id; ?>">
                            <div class="product-wrapper">
                                <div class="item" height="250px"  style="position: relative; overflow: hidden;">
                                    <div class="price-box">$<?php echo $row['price']/100;?></div>
                                    <img src="img/<?php echo $row['image_upload']; ?>" class="img-pad" height="200px" width="200"px alt="product">
                                    
                                </div> 
                                <div class="id-wrapper">
                                    <div class="quipId">Quip #<?php echo $row['id']; ?></div>
                                </div>

                                <div class="text">
    
                                    <div class="desciption">
                                        <div class="item-description"><?php echo $row['description']; ?></div>
                                    </div> 

                                    <div class="city">

                                        <?php 
                                        $lat = $row['latitude'];
                                        $long = $row['longitude'];
                                        if ($lat < "35.291683" and $lat > "35.086169" and $long > "-111.749144" and $long < "-111.475733") {
                                            echo "Flagstaff";
                                            }elseif ($lat < "32.771989" and $lat > "32.450123" and $long > "-114.708773" and $long < "-114.370205") {
                                                echo "Yuma";
                                            }elseif ($lat < "32.512950" and $lat > "31.918639" and $long > "-111.247834" and $long < "-110.660801") {
                                                echo "Tucson";
                                            }elseif ($lat < "33.930326" and $lat > "32.648143" and $long > "-112.752431" and $long < "-111.235345") {
                                                echo "Phoenix";
                                            }elseif ($lat < "34.676875" and $lat > "34.481134" and $long > "-112.530180" and $long < "-112.231211") {
                                                echo "Prescott";
                                            }elseif ($lat < "n" and $lat > "s" and $long > "w" and $long < "e") {
                                                echo "city";
                                            }elseif ($lat < "n" and $lat > "s" and $long > "w" and $long < "e") {
                                                echo "city";        
                                            }else {
                                            echo "Other";
                                            }  
                                        


                                        ?>
                                        
                                    </div>
                                </div>

                                <div class="map-section">
                                    <div id="<?php echo $row['id']; ?>" style="height:200px; width:200px"></div>
                                    <script src="OpenLayers-2.13.1/OpenLayers.js"></script>
                                    <script>
                                        var lat            = <?php echo $row['latitude']; ?>;
                                        var lon            = <?php echo $row['longitude']; ?>;
                                        var zoom           = 9;

                                        var fromProjection = new OpenLayers.Projection("EPSG:4326");   // Transform from WGS 1984
                                        var toProjection   = new OpenLayers.Projection("EPSG:900913"); // to Spherical Mercator Projection
                                        var position       = new OpenLayers.LonLat(lon, lat).transform( fromProjection, toProjection);

                                        map = new OpenLayers.Map("<?php echo $row['id']; ?>");
                                        var mapnik         = new OpenLayers.Layer.OSM();
                                        map.addLayer(mapnik);

                                        var markers = new OpenLayers.Layer.Markers( "Markers" );
                                        map.addLayer(markers);
                                        markers.addMarker(new OpenLayers.Marker(position));

                                        map.setCenter(position, zoom);
                                    </script>
                                    <script>
                                        [].forEach.call(document.getElementsByClassName("olControlAttribution olControlNoSelect"), function (el) {
                                        el.style.display = 'none';
                                            });
                                    </script> 
                                    
                                       

                                </div>    
                            </div>
                        </a>


            
                    <?php
                    }
                    }

                    else{
                        echo'<p style="text-align: center;">Products not found...</p>';
                    }

                    ?>

                    </div>
            </div>

        </div>

    </div>
    

    <footer>
            <div class="container">
                <div class="footer-top">
                    <h1><a href="#">instaquip</a></h1>
                </div>
                <div class="footer-nav">
                    <div class="social-column">
                        <div class="icons">
                            <a href="#" class="fa fa-facebook"></a><br>
                            <a href="#" class="fa fa-instagram"></a><br>
                            <a href="#" class="fa fa-twitter"></a><br>
                            <a href="#" class="fa fa-youtube"></a>
                        </div>
                    </div>



                    <div class="about-column">
                        <h3>About</h3>
                        <div class="about-menu">
                            <ul>
                                <li id="menu-item-5021" class="about-item"><a href="#">FAQS</a></li>
                                <li id="menu-item-5022" class="about-item"><a href="#">Use Instructions</a></li>
                                <li id="menu-item-5023" class="about-item"><a href="#">How it Works</a></li>
                                <li id="menu-item-5024" class="about-item"><a href="#">Service Quips</a></li>
                                <li id="menu-item-5025" class="about-item"><a href="#">Insurance</a></li>

                            </ul>
                        </div>    
                    </div>

                    <div class="service-column">
                        <h3>Service</h3>
                        <div class="service-menu">
                            <ul>
                                <li id="menu-item-5026" class="service-item"><a href="#">Get Help</a></li>
                                <li id="menu-item-5027" class="service-item"><a href="#">Report a Trailer</a></li>
                                <li id="menu-item-5028" class="service-item"><a href="#">Contact Us</a></li>
                                <li id="menu-item-5029" class="service-item"><a href="#">About</a></li>
                                <li id="menu-item-5030" class="service-item"><a href="#">Company Information</a></li>

                            </ul>
                        </div>   
                    </div>

                    <div class="return-column">
                        <h3>Return a Quip</h3>
                        <div class="return-menu">
                            <form action="connect.php" method="post">
                                <input type="text" name="trailerId" class="iD-input" placeholder="Trailer ID (i.e. 559)">
                                <br>
                                <textarea name="phoneNumber" class="text-inpu contact-input" placeholder="Phone Number (i.e. 6024584562)" style="margin: 0px; height: 54px; width: 153px;"></textarea>
                                <br>
                                <button type="submit" class="btn btn-big">Confirm</button>
                            </form>
                        </div>   
                    </div>






                </div>
                <div class="footer-bottom">
                    <div class="footer-item">©2021 Instaquip</div>
                    <div class="footer-item"><a href="#">Terms of Service</a></div>
                    <div class="footer-item"><a href="#">Rental Agreement</a></div>
                    <div class="footer-item"><a href="#">Privacy Policy</a></div>
                </div>
            </div>
    </footer>



    <script>
        /* When the user clicks on the button, 
        toggle between hiding and showing the dropdown content */
        function myFunction() {
          document.getElementById("myDropdown").classList.toggle("show");
        }
        
        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
          if (!event.target.matches('.dropbtn', '.fa fa-bars')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
              var openDropdown = dropdowns[i];
              if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
              }
            }
          }
        }
        </script>






</body>
</html>
