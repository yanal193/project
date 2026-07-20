<?php
include 'db.php';

$id=$_GET['id'];
$sql="SELECT p.*, c.city_name, t.type_name 
        FROM properties p 
        JOIN cities c ON p.city_id = c.cities_id 
        JOIN propertieType t ON p.type_id = t.type_id
        WHERE id=$id";

$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="details.css">
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

    <div class="details-container">
        <h1><?php echo $row['titel'];?></h1>
        <img src="image/<?php echo $row['imge'];?>" alt="<?php echo $row['titel']; ?>">

        <div class="price-tag"><?php echo number_format($row['price']); ?> JOD</div>

        <div class="details-info">
            <p><strong>City:</strong> <?php echo $row['city_name']; ?></p>
            <p><strong>Type:</strong> <?php echo $row['type_name']; ?></p>
            <p><strong>Area:</strong> <?php echo $row['area']; ?> m²</p>
            <p><strong>Bedrooms:</strong> <?php echo $row['bedrooms']; ?></p>
            <p><strong>Bathrooms:</strong> <?php echo $row['bathrooms']; ?></p>
            <p><strong>Status:</strong> <?php echo $row['status']; ?></p>
            <p><strong>Description:</strong> <?php echo $row['description']; ?></p>
        </div>

        <a href="estates.php" class="back-link">← Back to listings</a>
    </div>

</body>
</html>