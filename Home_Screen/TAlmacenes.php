<?php 
	$result = mysqli_query($conn, $TodosAlmacenes);
	$content='<div class="row" id="myUL">';
	while($row = mysqli_fetch_assoc($result)){
		$content.='<div id="'.$row["IdAlmacen"].'"class="col-4 card" style="width: 18rem; text-align: center; margin-top: 10px; cursor: pointer;"><a href="../Productos/IndexP.php?id='.$row["IdAlmacen"].'"><img class="card-img-top" src="./img/'.$row["IdAlmacen"].'.png" class="card-img-top imgsetup" alt="..."><a><div class="card-body" style="text-align: center;"><label class="card-text">'.$row["NombreAlmacen"].'</label>
          </div>
        </div>';
	}
	$content .= '</div></div></div>';
	mysqli_free_result($result);
	echo $content;
?>