   <?php
    require 'function.php';


    if (isset($_POST['submit'])) {
        if (add($_POST) > 0) {
            echo "
                <script>
                    alert('data berhasil ditambahkan!');
                    document.location.href = 'index.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('data gagal ditambahkan!');
                    document.location.href = 'index.php';
                </script>
            ";
        }
    }

    ?>
   <!DOCTYPE html>
   <html lang="en">

   <head>
       <meta charset="UTF-8">
       <meta http-equiv="X-UA-Compatible" content="IE=edge">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>Create</title>
   </head>

   <body>



       <div class="container">

           <div class="card">

               <form action="" method="post" enctype="multipart/form-data">
                   <ul>
                       <li>
                           <label for="name">name : </label>
                           <input type="text" name="name" id="name" required>
                       </li>
                       <li>
                           <label for="price">price : </label>
                           <input type="text" name="price" id="price">
                       </li>
                       <li>
                           <label for="description">description :</label>
                           <input type="text" name="description" id="description">
                       </li>
                       <li>
                           <label for="description">File :</label>
                           <input type="file" name="thumb" id="thumb">
                       </li>

                       <li>
                           <button type="submit" name="submit">Add Product !</button>
                       </li>
                   </ul>

               </form>
           </div>

       </div>
   </body>

   </html>