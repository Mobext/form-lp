<?php 
	session_start();
	
	include_once("mysql_connect.php");

	// var_dump("session: ".$_SESSION['isAdmin']);
	if ($_SESSION['isAdmin'] != 'ADMIN') {
		
		header("Location: login.php");
	}


 ?>

 
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>WRC</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon.png">

    <link rel="stylesheet" type="text/css" href="css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="css/reset.css" />
    <link rel="stylesheet" type="text/css" href="css/estilos.css" />
    <link rel="stylesheet" type="text/css" href="css/estilos_participantes.css" />
    <link rel="stylesheet" type="text/css" href="css/table.css" />
    
    <link rel="stylesheet" type="text/css" href="css/tooltipster.bundle.css" />
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.0.min.js"></script>


    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
     
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>




     <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-W84VK86');

    </script>
    <!-- End Google Tag Manager -->


        <!-- Google Tag Manager NBA_GTM_v1 -->
        <noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-TJTKXW" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <script>
            (function(w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({
                    'gtm.start': new Date().getTime(),
                    event: 'gtm.js'
                });
                var f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s),
                    dl = l != 'dataLayer' ? '&l=' + l : '';
                j.async = true;
                j.src =
                    '//www.googletagmanager.com/gtm.js?id=' + i + dl;
                f.parentNode.insertBefore(j, f);
            })(window, document, 'script', 'dataLayer', 'GTM-TJTKXW');

        </script>
        <!-- End Google Tag Manager NBA_GTM_v1 -->


        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W84VK86"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->



</head>

<body>




<?php 

$SQL = "SELECT COUNT(*) AS TOTAL FROM participantes";
$RESULTADO = mysqli_query($con, $SQL)or die (mysqli_error($con));
$row = mysqli_fetch_array($RESULTADO);

$total = $row[0];



$SQL = "SELECT COUNT(*) AS TOTAL FROM `participantes` WHERE DATE(`date`) = CURDATE()";
$RESULTADO = mysqli_query($con, $SQL)or die (mysqli_error($con));
$row_today = mysqli_fetch_array($RESULTADO);

$total_today = $row_today[0];


 ?>

<div class="anchoAdmin">
 
    <header class="headAdmin">
        <a href="index.php"><img src="logo.svg"  class="logoAdm"></a>
        <a href="logout.php" ><p>SALIR</p></a>
        <p class="total">Total Registrados - <?php echo $total ?>
          <p class="total">Registrados Hoy - <?php echo $total_today ?>
        <!-- <p class="total">Total Registrados - <?php echo $total ?></p> <p class="total">Total del Dia - 20</p> -->
        <a href="reporteexcelclass.php"> <p class="descarga">DESCARGAR LISTADO</p></a>
    </header>

    <table id="pagination"  class='customers paleBlueRows tablaTitulos'>
        <thead>
                <tr>
                <th style="width:5%">NOMBRE</th>
                <th style="width:5%">APELLIDO</th>
                <th style="width:5%">MAIL</th>
                <th style="width:5%">TELEFONO</th>
                <th style="width:5%">LOCALIDAD</th>
                <th style="width:5%">MODELO</th>
                <th style="width:5%">TRANSFORMACION</th>
                <th style="width:5%">MENSAJE</th>
                <!-- <th style="width:5%">CONSECIONARIO</th> -->
                <th style="width:5%">FECHA</th>

              </tr>
        </thead>

        <tbody id="test-list" style="">
            <?php 

                       $SQL = "SELECT * FROM participantes";
                       $RESULTADO = mysqli_query($con, $SQL)or die (mysqli_error($con));

                       while($row  = mysqli_fetch_assoc($RESULTADO))
                         {
                             echo "<tr>";
                                 echo "<td style='width:5%' class='pagination-item'>" . $row['nombre'] . "</td>";
                                 echo "<td style='width:5%' class='pagination-item'>" . $row['apellido'] . "</td>";
                                 echo "<td style='width:5%' class='pagination-item'>" . $row['mail'] . "</td>";
                                 echo "<td style='width:5%' class='pagination-item'>" . $row['telefono'] . "</td>";
                                 echo "<td style='width:5%' class='pagination-item'>" . $row['localidad'] . "</td>";
                                 echo "<td style='width:5%' class='pagination-item'>" . $row['modelo'] . "</td>";
                                 echo "<td style='width:5%' class='pagination-item'>" . $row['transformacion'] . "</td>";
                                 echo "<td style='width:15%' class='pagination-item'><a ><p class='myText overflow-ellipsis'>" . $row['mensaje'] . "<p></a></td>";
                                 // echo "<td style='width:5%' class='pagination-item'><a ><p>" . $row['consecionario'] . "<p></a></td>";
                                 

                                 
                                 if (!$row['date']) {
                                     echo "<td style='width:5%' class='pagination-item'> </td>";
                                 }

                                 if ($row['date']){
                                     echo "<td style='width:5%' class='pagination-item'>" .date('m/d/Y',strtotime($row['date'])) . "</td>";
                                 }

                             echo "</tr>";

                         } 

                ?> 
        </tbody>
    </table>


        <!-- The Modal -->
        <div id="myModal" class="modal2">
          <span class="close">&times;</span>
          <img class="modal-content" id="img01">
          <div id="caption"></div>
        </div>

        <!-- The Modal text-->
        <div id="myModalText" class="modal">
          <span class="close2">&times;</span>
          <p class="modal-content2" id="text01"></p>
          <!-- <div id="caption2"></div> -->
        </div>
</div>

<div id="pagination-container"></div>
    

<script type="text/javascript">


  // var request = $.ajax({
  //     type: 'POST',
  //     url: 'query.php',
  //     success: function(response) {
  //         // console.log(response['data']['participantes']);
          
  //         var data = response['data']['participantes'];
  //         // done(response);

      

  //         jQuery.each(data, function(i, val) {

  //             // console.log("data: "+val.dni+ " "+ val.nombre_completo);
          
  //             $('#test-list').append('<tr><td>'+val.dni+'</td><td >'+val.nombre_completo+'</td><td >'+val.email+'</td><td >'+val.titulo+'</td><td >'+val.especialreceta+'</td><td >'+val.receta+'</td><td >'+val.imagen+'</td></tr>');
    
          
            

  //         });


  //       // return data;
  //     }
  // });


       


  
  // Modal for Pictures
  var modal = document.getElementById('myModal');

  // Get the image and insert it inside the modal - use its "alt" text as a caption
  var img = document.getElementsByClassName('myImg');
  var modalImg = document.getElementById("img01");
  var captionText = document.getElementById("caption");

  var i;
  for (i = 0; i < img.length; i++) {
      // img[i].style.backgroundColor = "red";
      img[i].onclick = function(){
          modal.style.display = "block";
          modalImg.src = this.src;
          captionText.innerHTML = this.alt;
      }
  }




  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];

  // When the user clicks on <span> (x), close the modal
  span.onclick = function() { 
      modal.style.display = "none";
  }


  // Modal for Text

  var modalText = document.getElementById('myModalText');
  var text = document.getElementById('text01');
  // Get the button that opens the modal
  var ptext = document.getElementsByClassName("myText");

  // Get the <span> element that closes the modal
  var span2 = document.getElementsByClassName("close2")[0];
  var caption2Text = document.getElementById("caption2");
  var j;
  for (j = 0; j < ptext.length; j++) {
      // img[j].style.backgroundColor = "red";
      ptext[j].onclick = function(){
          modalText.style.display = "block";
          

          text.innerHTML = this.innerHTML; //this.text;
          
      }
  }

  // When the user clicks the button, open the modal 
  // btn.onclick = function() {
  //     modal.style.display = "block";
  // }

  // When the user clicks on <span> (x), close the modal
  span2.onclick = function() {
      modalText.style.display = "none";
      text.innerHTML = "";
  }
  
  

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
      if (event.target == modalText) {
          modalText.style.display = "none";
      }
  }


  $('#pagination').DataTable( {
         "pagingType": "full_numbers",
          "pageLength": 20,
          "paging" : true,
          "info" : false,
          "searching" : false,
          "lengthChange" : false,
          "order" : [[7,'desc']]

     } );
</script>
    
</body>

</html>
