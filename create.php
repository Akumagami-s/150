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
                
               <!-- <ul>
                       <li>
                           
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
                   </ul> -->

                  <center> <h2>Form Isi Baju</h2></center>
<br>
                   <table style="margin:auto;">
                       <tr>
                           <td><label for="name">name : </label></td>
                           <td><input type="text" name="name" id="name" required></td>
                       </tr>
                       <tr>
                           <td>  <label for="price">price : </label></td>
                           <td><input type="text" name="price" id="price"></td>
                       </tr>
                       <tr>
                           <td><label for="description">description :</label></td>
                           <td> <input type="text" name="description" id="description"></td>
                       </tr>
                       <tr>
                           <td> <label for="description">File :</label></td>
                           <td><input type="file" name="thumb" id="thumb"></td>
                       </tr>
                       <tr>
    <td></td>
        <td></td>               </tr>
                       <tr></tr>
                       <tr>
                           <td colspan="2"><center><button type="submit" name="submit">Add Product !</button></center></td>
                       </tr>
                   </table>

               </form>
           </div>

       </div>
   </body>

   </html>