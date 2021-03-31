<?php 
	include("ConsultaP.php");
	$result = mysqli_query($conn, $TodosProductos);
	$content='<div class="row" id="myUL">';
	while($row = mysqli_fetch_assoc($result)){
		$content.='<div id="'.$row["IdProducto"].'"class="col-4 card" style="width: 18rem; margin-top: 10px; cursor: pointer;">
          <a href="../Productos/Cantidad.php?id='.$row["IdProducto"].'"><img src="./image/'.$row["IdProducto"].'.png" class="card-img-top imgsetup" alt="..."></a>
          <div class="card-body" style="text-align: center;">
            <label class="card-text">'.$row["NombreProducto"].'</label>
          </div>
        </div>';
	}
	$content .= '</div></div></div>';
	echo $content;
	mysqli_free_result($result);
?>
