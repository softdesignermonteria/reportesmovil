
<?php

    include('conexion.php');

	$fecha=  $_REQUEST['fecha'];
	$limite= $_REQUEST['limite'];
  
    $sql = "SELECT concat_ws(' ',cl.nombre1,cl.nombre2, cl.apellido1, cl.apellido2) as nombre,
	sum(f.total) as total_compras,
	COUNT(f.clientes_id) AS total_compra
	FROM factura f,clientes cl
	WHERE cl.id=f.clientes_id
	and year(f.fecha)+month(f.fecha) = year('".$fecha."')+month('".$fecha."')
	GROUP BY cl.nombre1,cl.nombre2,cl.apellido1,cl.apellido2,cl.id
	limit $limite";
	
	//print_r($sql);
 	$resultado=mysql_query($sql,$conexion);
	
	echo"<table width='100%'  align='center' id='tabla1' data-role='table' id='table-custom-2' 
				data-mode='columntoggle' class='ui-body-d ui-shadow table-stripe ui-responsive' 
				data-column-btn-theme='b' data-column-btn-text='Columnas a Mostrar...' data-column-popup-theme='a'>";
	   echo"<thead><tr>";
         echo "<th>Nombre</th>";
    	 echo "<th>Valor Compras</th>";
    	 echo "<th># de Compras</th>";
       echo"</tr></thead><tbody>";
	while($fila=mysql_fetch_array($resultado)){
		
		echo"<tr>";
    	   echo"<td>".$fila['nombre']."</td>";
    	   echo"<td>".number_format($fila['total_compras'],0,',','.')."</td>";
    	   echo"<td>".$fila['total_compra']."</td>";
        echo"</tr>";
	
	}
	echo "</tbody></table>";
    /*if(count($row)) {
        $end_result = '';
        foreach($row as $r) {
            $result         = $r['total_compras'];
            // we will use this to bold the search word in result
            $bold           = '<span class="found">' . $r['total_compra'] . '</span>';   
            $end_result     .= '<li>' . str_ireplace($bold, $result) . '</li>';           
        }
        echo $end_result;
    } else {
        echo '<li>No results found</li>';
    }*/

?>