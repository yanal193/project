<?php
include 'db.php';

if(isset($_GET['search']) && $_GET['search'] != ""){
    $search=$_GET['search'];

    $sql = "SELECT p.*, c.city_name, t.type_name 
        FROM properties p 
        JOIN cities c ON p.city_id = c.cities_id 
        JOIN propertieType t ON p.type_id = t.type_id
        WHERE p.titel LIKE '%$search%'";

    $result = mysqli_query($conn, $sql);
}else{
    $search="";
    $result = false;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="nav.css">
    <link rel="stylesheet" href="estates.css">
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

    <form method="get">
        <input type="text" name="search" placeholder="search by title">
        <button type="submit">Search</button>
    </form>

     <div class="container">
        <?php
    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_assoc($result)) {
    ?>

        <a href="details.php?id=<?php echo $row['id'];?>" style="text-decoration:none; color:black;">
        <div class="card">
        <img class="image" src="image/<?php echo $row['imge'] ;?>" alt="<?php echo $row['titel'];?>" width="300">
        <h2><?php echo $row['titel']; ?></h2>
        <p><strong>City:</strong><?php echo $row['city_name']; ?> </p>
        <p><strong>Type:</strong><?php echo $row['type_name']; ?> </p>
        <p><strong>Price:</strong><?php echo number_format($row['price']); ?> </p>
        <p><strong>Area:</strong><?php echo $row['area']; ?> m² </p>
        <p><strong>Bedrooms:</strong><?php echo $row['bedrooms']; ?>  </p>
        <p><strong>Bathrooms:</strong><?php echo $row['bathrooms']; ?> </p>
        <p><strong>Status:</strong><?php echo $row['status']; ?> </p>
        
    </div>
    </a>
    
    <?php
        }
    }
    ?>

    </div>
    
</body>
</html>