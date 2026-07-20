<?php
include 'db.php';

$sql="SELECT p.*,c.city_name,t.type_name 
      FROM properties p
      JOIN cities c ON p.city_id=c.cities_id
      JOIN propertieType t on p.type_id=t.type_id
      ORDER BY p.id DESC LIMIT 6";

$result=mysqli_query($conn,$sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="nav.css">
</head>
<body>
    <nav class="navbar">
        <div class="nav-logo">
            <h4>🏠 Hous And More</h4>
        </div>
        
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="estates.php">Real estates</a></li>
            <li><a href="search.php">Search</a></li>
        </ul>
    </nav>


    <section class="hero">
        <h1>Find Your Dream Home</h1>
        <p>Browse the best properties for sale and rent in your city</p>
         <a href="estates.php" class="hero-btn">Browse Properties</a>
    </section>

    <section class="steats">
        <div class="steat-box">
            <h3><?php
                include 'db.php';
                $count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM properties"));
                echo $count['c'];
            ?></h3>
            <p>Properties Listed</p>
        </div>
    </section>
    <section class="steats">
        <div class="steat-box">
            <h3><?php
                $count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM cities"));
                echo $count['c'];
            ?></h3>
            <p>Cities Covered</p>
        </div>
    </section>

    <h2 class="section-title">Latest Properties</h2>
    <div class="container">
        <?php while($row = mysqli_fetch_assoc($result)){ ?>
        <a href="details.php?id=<?php echo $row['id'];?>" style="text-decoration:none; color:black;">
            <div class="card">
                <img class="image" src="image/<?php echo $row['imge'] ;?>" alt="<?php echo $row['titel'];?>" width="300">
                <h2><?php echo $row['titel']; ?></h2>
                <p><strong>City:</strong> <?php echo $row['city_name']; ?></p>
                <p><strong>Type:</strong> <?php echo $row['type_name']; ?></p>
                <p><strong>Price:</strong> <?php echo number_format($row['price']); ?></p>
                <p><strong>Area:</strong> <?php echo $row['area']; ?> m²</p>
                <p><strong>Bedrooms:</strong> <?php echo $row['bedrooms']; ?></p>
                <p><strong>Bathrooms:</strong> <?php echo $row['bathrooms']; ?></p>
                <p><strong>Status:</strong> <?php echo $row['status']; ?></p>
            </div>
        </a>
        <?php } ?>
    </div>
    <div class="see-all">
        <a href="estates.php">See All Properties </a>
    </div>
    
</body>
</html>