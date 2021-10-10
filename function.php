<?php

$conn = mysqli_connect("localhost", "django", "ReksaSyahputra1012!", "artshoe");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}


function add($data)
{
    global $conn;

    $name = htmlspecialchars($data["name"]);
    $price = htmlspecialchars($data["price"]);
    $description = htmlspecialchars($data["description"]);
    $thumb = upload();


    $query = "INSERT INTO product
				VALUES
			  (NULL, '$name', '$price', '$description','$thumb')
			";
    mysqli_query($conn, $query) or die(mysqli_error($conn));

    return mysqli_affected_rows($conn);
}

function addcart($user_id , $product_id)
{
    global $conn;

    $user_id = $user_id;


    $sd = query("SELECT * FROM cart  WHERE product_id='$product_id' AND user_id='$user_id'");
    
    if (count($sd) == 0) {
      $prod = query("SELECT * FROM product WHERE id='$product_id'");
      $qty = 1;
      $name = $prod[0]['name'];
      $price = $prod[0]['price'];
      $image = $prod[0]['image'];
      $total = $qty * $prod[0]['price'];
     
      $query = "INSERT INTO cart
          VALUES
          (NULL, '$user_id', '$product_id','$name','$price','$image', '$qty','$total')
        ";
      mysqli_query($conn, $query) or die(mysqli_error($conn));
      return mysqli_affected_rows($conn);



    } else {
     
      $cart = query("SELECT * FROM cart  WHERE product_id='$product_id' , user_id='$user_id'");
      $qtyd = $cart[0]['qty'] + 1;
      $tots =  $qtyd * $cart[0]['price_product'];
      $query = query("UPDATE cart SET qty='$qtyd',total='$tots' WHERE product_id='$product_id' , user_id='$user_id'");
     
      mysqli_query($conn, $query) or die(mysqli_error($conn));
      return mysqli_affected_rows($conn);



    }
    

   
}




function addqty($user_id , $cartid)
{

    global $conn;

    $user_id = $user_id;
    $cart = query("SELECT * FROM cart  WHERE id='$cartid'");
    $qtyd = $cart[0]['qty'] + 1;
    $tots =  $qtyd * $cart[0]['price_product'];
    $query = query("UPDATE cart SET qty='$qtyd',total='$tots' WHERE id='$cartid'");
   
    mysqli_query($conn, $query) or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
}

function removeqty($user_id , $cartid)
{

    global $conn;

    $user_id = $user_id;
    $cart = query("SELECT * FROM cart  WHERE id='$cartid'");
    $qtyd = $cart[0]['qty'] - 1;
    $tots =  $qtyd * $cart[0]['price_product'];
    
    $query = query("UPDATE cart SET qty='$qtyd',total='$tots' WHERE id='$cartid'");
    if ($qtyd == 0) {
      query("DELETE FROM cart WHERE id='$cartid'");
    }
    mysqli_query($conn, $query) or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
}



function upload()
{

    $namaFile = $_FILES['thumb']['name'];
    $ukuranFile = $_FILES['thumb']['size'];
    $error = $_FILES['thumb']['error'];
    $tmpName = $_FILES['thumb']['tmp_name'];
    if ($error === 4) {
        echo "<script>
				alert('Select image');
			  </script>";
        return false;
    }

   
    $ekstensithumbValid = ['jpg', 'jpeg', 'png'];
    $ekstensithumb = explode('.', $namaFile);
    $ekstensithumb = strtolower(end($ekstensithumb));
    if (!in_array($ekstensithumb, $ekstensithumbValid)) {
        echo "<script>
				alert('You're upload not image');
			  </script>";
        return false;
    }

    if ($ukuranFile > 1000000) {
        echo "<script>
				alert('size to bigger');
			  </script>";
        return false;
    }

    
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensithumb;

    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}
