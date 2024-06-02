<?php
// Fetch image path from the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pet";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT image_path FROM images ORDER BY id DESC LIMIT 1"; // Assuming the latest uploaded image is the hero banner image
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $imagePath = $row["image_path"];
} else {
    $imagePath = "default_image.jpg"; // Default image if no image is found in the database
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Tail Tales</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <div class="logo">
                        <img src="logo.png" alt="The Tail Tales">
                        <span>The Tail Tales<br><p>TheStoryBegins</p></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="search-bar">
                        <input type="text" class="form-control" placeholder="What are you looking for?">
                    </div>
                </div>
                <div class="col-md-3 text-right">
                    <div class="user-options">
                        <a href="#"><i class="fa-regular fa-heart"></i>My Wishlist</a>
                    <a href="#"><i class="fa-solid fa-cart-shopping"></i>My Cart: $0.00</a>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg ">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">


                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Categories
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li class="list-group-item"><i class="fas fa-dog"></i><a href="#">  Dogs</a></li>
                            <li class="list-group-item"><i class="fas fa-cat"></i><a href="#">  Cats</a></li>
                            <li class="list-group-item"><i class="fas fa-dove"></i><a href="#">  Birds</a></li>
                            <li class="list-group-item"><i class="fas fa-paw"></i><a href="#">  Small Animals</a></li>
                            <li class="list-group-item"><i class="fas fa-fish"></i><a href="#">  Fish & Turtles</a></li>
                            <li class="list-group-item"><i class="fas fa-shower"></i><a href="#">  Pet Grooming</a></li>
                            <li class="list-group-item"><i class="fas fa-stethoscope"></i><a href="#">  VET Care</a></li>
                            <li class="list-group-item"><i class="fas fa-tools"></i><a href="#">  General Maintenance</a></li>
                            <li class="list-group-item"><i class="fas fa-car"></i><a href="#">  Pet Travel Special</a></li>
                            <li class="list-group-item"><a href="#" class="text-danger"><i class="fas fa-plus-circle"></i>  View All</a></li>
                        </ul>
                      </div>

                    <ul class="navbar-nav">
                        
                        <li class="nav-item ">
                            <a class="nav-link" href="#">Home</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="#">Products</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="#">Profile</a>
                        </li>
                        <li>
                            <a class="nav-link"  href="admin_login.php">Admin_Panel</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <div class="category-list">
                        <h5>Categories</h5>
                        <ul class="list-group">
                            <li class="list-group-item"><i class="fas fa-dog"></i><a href="#">  Dogs</a></li>
                            <li class="list-group-item"><i class="fas fa-cat"></i><a href="#">  Cats</a></li>
                            <li class="list-group-item"><i class="fas fa-dove"></i><a href="#">  Birds</a></li>
                            <li class="list-group-item"><i class="fas fa-paw"></i><a href="#">  Small Animals</a></li>
                            <li class="list-group-item"><i class="fas fa-fish"></i><a href="#">  Fish & Turtles</a></li>
                            <li class="list-group-item"><i class="fas fa-shower"></i><a href="#">  Pet Grooming</a></li>
                            <li class="list-group-item"><i class="fas fa-stethoscope"></i><a href="#">  VET Care</a></li>
                            <li class="list-group-item"><i class="fas fa-tools"></i><a href="#">  General Maintenance</a></li>
                            <li class="list-group-item"><i class="fas fa-car"></i><a href="#">  Pet Travel Special</a></li>
                            <li class="list-group-item"><a href="#" class="text-danger"><i class="fas fa-plus-circle"></i>  View All</a></li>
                        </ul>
                    </div>
                    
                </div>
               
                <div class="col-md-10">
                    <div class="hero-banner">
                 
                     <img src="<?php echo $imagePath; ?>" alt="Uploaded Image" class="img-fluid" alt="Hero Banner">
                        <div class="hero-text">
                            <h1>The Best Pet<br>Food For<br>You</h1>
                            <p>We provide everything for your pet</p>
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="container mt-5">
        <div class="row text-center mb-4">
            <div class="col">
                <div class="info-box">
                    <img src="shipping-icon.jpeg" alt="Free Shipping">
                    <div class="content">
                        <p>Free Shipping</p>
                        <small>Enjoy free shipping month for our latest products</small>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="info-box">
                    <img src="secure-payment-icon.jpeg" alt="Secure Payment">
                    <div class="content">
                       <p>Secure Payment</p>
                       <small>Complete your payment with trusted payment gateways</small>
                   </div>
                </div>
            </div>
            <div class="col">
                <div class="info-box">
                    <img src="return-policy-icon.jpeg" alt="Return Policy">
                    <div class="content">
                    <p>Return Policy</p>
                    <small>1-4 day return policy for our special offer</small>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="info-box">
                  <img src="certified-icon.jpeg" alt="Certified For Pets">
                    <div class="content">
                      <p>Certified For Pets</p>
                      <small>Trusted sources who can bring you the product you need</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            
            <div class="col-md-3">
                <h3>Today's Deal</h3>
                <p>Choose your necessary products from this featured category</p>
                <div class="deal-banner">
                    <div class="deal-content">
                        <img src="flex.jpeg" alt="Furry Friends Welcome!">
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                
                <div class="row">
                    <!-- Product Cards Start -->
                    <div class="col-md-4">
                        <div class="card product-card">
                            <img src="Product2.jpg" class="card-img-top" alt="Product 1">
                            <div class="card-body text-center">
                                <div class="rating">
                                    <i style="font-size:10px;color:rgb(192, 179, 0)" class="fa">&#xf006;</i>
                                    <i style="font-size:10px;color:rgb(192, 179, 0)"  class="fa">&#xf006;</i>
                                    <i style="font-size:10px;color:rgb(192, 179, 0)"  class="fa">&#xf006;</i>
                                    <i style="font-size:10px" class="fa">&#xf006;</i>
                                    <i style="font-size:10px" class="fa">&#xf006;</i>
                                </div>
                                <h5 class="card-title">Whiskas Cat Food</h5>
                                <p class="card-text">₹19.00 <small class="text-muted"><del>₹20.00</del></small></p>
                                
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card product-card">
                            <img src="Product1.jpg" class="card-img-top" alt="Product 1">
                            <div class="card-body text-center">
                                <div class="rating">
                                    <i style="font-size:10px;color:rgb(192, 179, 0)" class="fa">&#xf006;</i>
                                    <i style="font-size:10px" class="fa">&#xf006;</i>
                                    <i style="font-size:10px" class="fa">&#xf006;</i>
                                    <i style="font-size:10px" class="fa">&#xf006;</i>
                                    <i style="font-size:10px" class="fa">&#xf006;</i>
                                </div>
                                <h5 class="card-title">Whiskas Cat Food</h5>
                                <p class="card-text">₹19.00 <small class="text-muted"><del>₹20.00</del></small></p>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card product-card">
                            <img src="Product3.jpg" class="card-img-top" alt="Product 1">
                            <div class="card-body text-center">
                                <div class="rating">
                                    <i style="font-size:10px;color:rgb(192, 179, 0)" class="fa">&#xf006;</i>
                                    <i style="font-size:10px" class="fa">&#xf006;</i>
                                    <i style="font-size:10px" class="fa">&#xf006;</i>
                                    <i style="font-size:10px" class="fa">&#xf006;</i>
                                    <i style="font-size:10px" class="fa">&#xf006;</i>
                                </div>
                                <h5 class="card-title">Whiskas Cat Food</h5>
                                <p class="card-text">₹19.00 <small class="text-muted"><del>₹20.00</del></small></p>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card product-card">
                            <img src="Product2.jpg" class="card-img-top" alt="Product 1">
                            <div class="card-body text-center">
                                <div class="rating">
                                    <i style="font-size:10px;color:rgb(192, 179, 0)" class="fa">&#xf006;</i>
                                    <i style="font-size:10px" class="fa">&#xf006;</i>
                                    <i style="font-size:10px" class="fa">&#xf006;</i>
                                    <i style="font-size:10px" class="fa">&#xf006;</i>
                                    <i style="font-size:10px" class="fa">&#xf006;</i>
                                </div>
                                <h5 class="card-title">Whiskas Cat Food</h5>
                                <p class="card-text">₹19.00 <small class="text-muted"><del>₹20.00</del></small></p>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card product-card">
                            <img src="Product1.jpg" class="card-img-top" alt="Product 1">
                            <div class="card-body text-center">
                                <div class="rating">
                                    <i style="font-size:10px;color:rgb(192, 179, 0)" class="fa">&#xf006;</i>
                                    <i style="font-size:10px" class="fa">&#xf006;</i>
                                    <i style="font-size:10px" class="fa">&#xf006;</i>
                                    <i style="font-size:10px" class="fa">&#xf006;</i>
                                    <i style="font-size:10px" class="fa">&#xf006;</i>
                                </div>
                                <h5 class="card-title">Whiskas Cat Food</h5>
                                <p class="card-text">₹19.00 <small class="text-muted"><del>₹20.00</del></small></p>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card product-card">
                            <img src="Product3.jpg" class="card-img-top" alt="Product 1">
                            <div class="card-body text-center">
                                <div class="rating">
                                    <i style="font-size:10px;color:rgb(192, 179, 0)" class="fa">&#xf006;</i>
                                    <i style="font-size:10px" class="fa">&#xf006;</i>
                                    <i style="font-size:10px" class="fa">&#xf006;</i>
                                    <i style="font-size:10px" class="fa">&#xf006;</i>
                                    <i style="font-size:10px" class="fa">&#xf006;</i>
                                </div>
                                <h5 class="card-title">Whiskas Cat Food</h5>
                                <p class="card-text">₹19.00 <small class="text-muted"><del>₹20.00</del></small></p>
                                
                            </div>
                        </div>
                    </div>
                    <!-- Repeat for other products -->
                </div>
            </div>
        </div>
    </div>
</main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>