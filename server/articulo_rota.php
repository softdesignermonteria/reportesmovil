<?php

    include('conexion.php');

	$fecha_i=  $_REQUEST['fecha_i'];
	$fecha_f=  $_REQUEST['fecha_f'];
	  
    $sql = "select * from ( SELECT k.nombre_producto, sum(df.total) as valor_total_articulos,
    COUNT(k.id)  AS total_articulos FROM factura f, detalle_factura df, kardex k
    WHERE k.id=df.kardex_id and f.id = df.factura_id  
	and year(f.fecha)+month(f.fecha) = year('".$fecha_i."')+month('".$fecha_f."')
    GROUP BY k.id ) h order by h.total_articulos desc limit 100";
	
	//print_r($sql);
 	$resultado=mysql_query($sql,$conexion);
	
	echo"<table width='100%'  align='center' id='tabla2' data-role='table' id='table-custom-2' 
				data-mode='columntoggle' class='ui-body-d ui-shadow table-stripe ui-responsive' 
				data-column-btn-theme='b' data-column-btn-text='Columnas a Mostrar...' data-column-popup-theme='a'>";
	   echo"<thead><tr>";
         echo "<th>Nombre Producto</th>";
    	 echo "<th>Valor Total</th>";
    	 echo "<th># de Articulos</th>";
       echo"</tr></thead><tbody>";
	while($fila=mysql_fetch_array($resultado)){
		
		echo"<tr>";
    	   echo"<td>".$fila['nombre_producto']."</td>";
    	   echo"<td>".number_format($fila['valor_total_articulos'],0,',','.')."</td>";
    	   echo"<td>".$fila['total_articulos']."</td>";
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