<?php
require 'function.php';


session_start();
$product = query("SELECT * FROM product");
$id = $_SESSION['user'][0]['id'];
$cart = query("SELECT * FROM cart WHERE user_id='$id'");
$total = 0;




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/base/_custom.css">
    <link rel="stylesheet" href="./css/pages/_skeleton.css">
    <title>Shopping Cart | Home</title>
</head>

<body>
    <header id="header" class="header">
        <div class="container">
            <div class="flex__navbar">
                <div class="logo"><a href="#">Art - Shoe</a></div>

                <?php if (isset($_SESSION['user'])) { ?>

                    <div class="logo">
                        <a href="">Halo <?= $_SESSION['user'][0]['username'] ?></a>
                        <span>/</span>
                        <a href="logout.php">Logout</a>
                    </div>

                <?php } else { ?>

                    <div class="logo">
                        <a href="login.php">Login</a>
                        <span>/</span>
                        <a href="registration.php">Register</a>
                    </div>

                <?php } ?>

                <div class="shoppping__cart">
                    <ul>
                        <li class="sub__menu">
                            <img src="./css/img/cart.png" alt="">
                            <div id="shopping__list">
                                <table id="cart__content" class="full_width">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>QTY</th>
                                            <th>Price</th>

                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody >

                                        <?php foreach ($cart as $key => $value) { ?>
                                            <tr>
                                                <td style="font-size: 10px;"> <?= $value['name_product'] ?></td>
                                                <td style="font-size: 10px;"> <?= $value['qty'] ?></td>
                                                <td style="font-size: 10px;"> <?= $value['price_product'] * $value['qty']?></td>
                                                <td style="display: flex;"> 
                                                    <button class="adds" cart-id="<?= $value['id'] ?>">+</button>
                                                 <button class="removes" cart-id="<?= $value['id'] ?>">-</button>
                                            </td>
                                                <?php $total += $value['total']?>
                                            </tr>
                                            <?php } ?>
                                            <tr>
                                                <td style="font-size: 10px;">Total All</td>
                                                <td></td>
                                                <td></td>
                                                <td style="font-size: 10px;"><?= $total?></td>
                                            </tr>
                                    </tbody>
                                </table>
                                <a href="#" id="clear-cart" class="button u-full-width">Clear Cart</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        </div>

    </header>
    <div id="banner">
        <div class="container">
            <div class="row">
                <div class="banner__container">
                    <div class="banner__content">
                        <h2 id="learn">Good shoe,Good Run</h2>
                        <!-- <form action="#"  method="post" class="form"> -->
                            <input id="search" class="u-full-width" type="text" placeholder="Find Shoe" id="search-course">
                            <!-- <input type="submit" id="submit-search-course" class="submit-search-course"> -->
                        <!-- </form> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section>
        <div id="courses-list" class="container">
            <h1 id="heading" class="heading">Product</h1>
            <div class="row__content">
                <div id="dt" style="width:80%;display:flex;" >


                    <?php foreach ($product as $key => $value) { ?>
                        <div class="card">
                            <img src="./img/<?= $value["thumb"]; ?>" class="course-image_1">
                            <div class="info-card">
                                <h4><?= $value["name"]; ?></h4>
                                <p><?= $value["description"]; ?></p>
                                <img src="./css/img/stars.png">
                                <span class="u-pull-right "><?= $value["price"]; ?></span></p>
                                <button class="u-full-width button-primary button input add-to-cart" data-id="<?= $value["id"]; ?>">Add to Cart</button>
                            </div>
                        </div>



                    <?php } ?>




                </div>



    </section>
    <footer>

        <footer id="footer" class="footer">
            <div class="container">
                <div class="row">
                    <div class="four columns">
                        <nav id="primary" class="menu">
                            <a class="link" href="#">Mobile Applications</a>
                            <a class="link" href="#">Support</a>
                            <a class="link" href="#">Help</a>
                        </nav>
                    </div>
                    <div class="four columns">
                        <nav id="secondary" class="menu">
                            <a class="link" href="#">About Us</a>
                        </nav>
                    </div>
                </div>
            </div>
        </footer>
        <!-- <script src="./js/index.js"></script> -->

        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script>
            $('.add-to-cart').click(function(e) {
                e.preventDefault();

                $.ajax({
                    url: "addcart.php",
                    type: "post",
                    data: {
                        productid: $(this).attr('data-id'),
                    },
                    success: function(response) {
                        alert('success add to cart');
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });

            });

            $('.adds').click(function(e) {
                e.preventDefault();

                $.ajax({
                    url: "add.php",
                    type: "post",
                    data: {
                        action:"add",
                        cartid: $(this).attr('cart-id'),
                    },
                    success: function(response) {
                        alert('QTY has been added');
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });

            });

            $('.removes').click(function(e) {
                e.preventDefault();

                $.ajax({
                    url: "remove.php",
                    type: "post",
                    data: {
                        action: "remove",
                        cartid: $(this).attr('cart-id'),
                    },
                    success: function(response) {
                        alert('QTY has been remove');
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });

            });


            $("#search").keyup(function () {
        var that = this,
        value = $(this).val();

        if (value.length >= 1 ) {
            $.ajax({
                type: "GET",
                url: "search.php",
                data: {
                    'search' : value
                },
                dataType: "text",
                success: function(msg){
                        data = $.parseJSON(msg);
                  
                        var htm = "";
                        for (let i = 0; i < data.length; i++) {
                          
                          htm += '<div class="card"><img src="./img/'+data[i]['thumb']+'" class="course-image_1"><div class="info-card"><h4>'+data[i]['name']+'</h4><p>'+data[i]['description']+'</p><img src="./css/img/stars.png"><span class="u-pull-right ">'+data[i]['price']+'</span></p><button class="u-full-width button-primary button input add-to-cart" data-id="'+data[i]['id']+'">Add to Cart</button></div></div>';
                            console.log(data);
                        }
                        $('#dt').html(htm);
                     
                }
            });
        }
    });


        </script>
</body>

</html>