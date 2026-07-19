<?php
include 'db.php';

if(isset($_GET['search'])){
    $search=$_GET['search'];
}else{
    $search="";
}

if(isset($_GET['city_id'])){
    $city_id=$_GET['city_id'];
}else{
    $city_id="";
}

if(isset($_GET['type_id'])){
    $type_id=$_GET['type_id'];
}else{
    $type_id="";
}

if(isset($_GET['sort'])){
    $sort=$_GET['sort'];
}else{
    $sort="";
}

$sql = "SELECT p.*, c.city_name, t.type_name 
        FROM properties p 
        JOIN cities c ON p.city_id = c.cities_id 
        JOIN propertieType t ON p.type_id = t.type_id
        WHERE p.titel LIKE '%$search%'";

if($city_id != ""){
    $sql .= " AND p.city_id = '$city_id'";
}

if($type_id != ""){
    $sql .= " AND p.type_id = '$type_id'";
}
if($sort=="price_asc"){
    $sql .= " ORDER BY p.price ASC";
}else if($sort=="price_deac"){
    $sql .= " ORDER BY p.price DESC";
}else if($sort=="area_asc"){
    $sql .= " ORDER BY p.area ASC";
}else if($sort=="area_desc"){
    $sql .= " ORDER BY p.area DESC";
}


$result = mysqli_query($conn, $sql);
$citiesResult=mysqli_query($conn,"SELECT * FROM cities");
$typeResult=mysqli_query($conn,"SELECT * FROM propertieType");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <form method="get">
        <input type="text" name="search" placeholder="search by title">
        <button type="submit">Search</button>

        
        <select name="city_id" onchange="this.form.submit()">
            <option value="" selected>All Cites</option>
            <?php while($city = mysqli_fetch_assoc($citiesResult)){ ?>
            <option value="<?php echo $city['cities_id'];?>" <?php echo ($city_id==$city['cities_id'])? "selected":"" ;?> >
                <?php echo $city['city_name'];?> </option>
                <?php }?>
        </select>

        <select name="type_id" onchange="this.form.submit()">
            <option value="" selected>All Type</option>
            <?php while($type = mysqli_fetch_assoc($typeResult)){ ?>
            <option value="<?php echo $type['type_id']; ?>" <?php echo ($type_id==$type['type_id'])? "selected":"" ;?>>
                <?php echo $type['type_name'];?></option>
                <?php }?>
        </select>

        <select name="sort" onchange="this.form.submit()">
            <option value="">newst</option>
            <option value="price_asc" <?php echo($sort=="price_asc") ? "selected":"";?>>Price: Low-High</option>
            <option value="price_deac" <?php echo($sort=="price_deac") ? "selected":"";?>>Price: High-Low</option>
            <option value="area_asc" <?php echo($sort=="area_asc") ? "selected":"";?>>area: Low-High </option>
            <option value="area_desc" <?php echo($sort=="area_desc") ? "selected":"";?>>area: High-Low</option>
        </select>
    </form>

    
    <div class="container">
        <?php
    if (mysqli_num_rows($result) > 0) {
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