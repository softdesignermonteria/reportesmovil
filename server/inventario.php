<?php

    include('conexion.php');

    $sql = "SELECT SUM(multiplica*movimientos_inventario.cantidad) AS cantidad,
     kardex.`id`, kardex.`codigo`, kardex.`nombre_producto`, kardex.`valor`, empresa.`nombre_empresa` AS empresa_nombre_empresa,
     CURDATE() as fecha_actual, empresa.`tipo_costeo`,ifnull(calcular_costo(kardex.`id`, CURDATE() ,'0',empresa.`tipo_costeo`),0) as costo,
	 (SUM(multiplica*movimientos_inventario.cantidad) * ifnull(calcular_costo(kardex.`id`, CURDATE() ,'0',empresa.`tipo_costeo`),0) ) as total,
     empresa.`direccion` AS empresa_direccion, empresa.`nit` AS empresa_nit,empresa.`correo` AS empresa_correo,
     empresa.`web` AS empresa_web, empresa.`celular` AS empresa_celular, empresa.`telefonos` AS empresa_telefonos,
     (kardex.`valor` - calcular_costo(kardex.`id`, CURDATE() ,'0',empresa.`tipo_costeo`)) AS utilidad,( (kardex.`valor` - calcular_costo(kardex.`id`, CURDATE() ,'0',empresa.`tipo_costeo`)) * 100 /  kardex.`valor` ) AS porcentaje
	 FROM `kardex` kardex INNER JOIN `movimientos_inventario` movimientos_inventario ON kardex.`id` = movimientos_inventario.`kardex_id`
     INNER JOIN `empresa` empresa ON movimientos_inventario.`empresa_id` = empresa.`id` WHERE 
	  movimientos_inventario.anulado = '0' GROUP BY kardex.id,kardex.codigo, kardex.nombre_producto,kardex.valor
     ORDER BY 4 ASC";
	
	//print_r($sql);
 	$resultado=mysql_query($sql,$conexion);
	
	echo"<table width='100%'  align='center' data-role='table' id='table-custom-2' 
				data-mode='columntoggle' class='ui-body-d ui-shadow table-stripe ui-responsive' 
				data-column-btn-theme='b' data-column-btn-text='Columnas a Mostrar...' data-column-popup-theme='a'>";
	   echo"<thead><tr>";
         echo "<th>ID</th>";
    	 echo "<th>Ref</th>";
    	 echo "<th>Prod</th>";
		 echo "<th>Costo</th>";
		 echo "<th>Cant</th>";
		 echo "<th>Total</th>";
		 echo "<th>Valor</th>";
		 echo "<th>Utilidad</th>";
		 echo "<th>Porc.</th>";
       echo"</tr></thead><tbody>";
	while($fila=mysql_fetch_array($resultado)){
		
		
		 echo"<tr>";
			echo"<td>".$fila['id']."</td>";
			echo"<td>".$fila['codigo']."</td>";
			echo"<td>".$fila['nombre_producto']."</td>";
			echo"<td>".$fila['costo']."</td>";
			echo"<td>".$fila['cantidad']."</td>";
			echo"<td>".$fila['total']."</td>";
			echo"<td>".$fila['valor']."</td>";
			echo"<td>".$fila['utilidad']."</td>";
			echo"<td>".$fila['porcentaje']."</td>";
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