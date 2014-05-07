<?php

    include('conexion.php');

	$fecha=  $_REQUEST['fecha1'];
	  
    $sql = "SELECT
     factura.`id` AS factura_id,
     factura.`empresa_id` AS factura_empresa_id,
     factura.`tipo_documento_id` AS factura_tipo_documento_id,
     factura.`detalle_consecutivos_id` AS factura_detalle_consecutivos_id,
     factura.`prefijo` AS factura_prefijo,
     factura.`consecutivo` AS factura_consecutivo,
     factura.`centro_produccion_id` AS factura_centro_produccion_id,
     factura.`bodegas_id` AS factura_bodegas_id,
     factura.`clientes_id` AS factura_clientes_id,
     factura.`fecha` AS factura_fecha,
     factura.`vencimiento` AS factura_vencimiento,
     factura.`anulado` AS factura_anulado,
     factura.`fecha_registro` AS factura_fecha_registro,
     factura.`fecha_act` AS factura_fecha_act,
     factura.`ip` AS factura_ip,
     factura.`admin_id` AS factura_admin_id,
     factura.`subtotal` AS factura_subtotal,
     factura.`descuento` AS factura_descuento,
     factura.`iva` AS factura_iva,
     factura.`total` AS factura_total,
     empresa.`id` AS empresa_id,
     empresa.`nombre_corto` AS empresa_nombre_corto,
     empresa.`nombre_empresa` AS empresa_nombre_empresa,
     empresa.`nit` AS empresa_nit,
     empresa.`direccion` AS empresa_direccion,
     empresa.`logo` AS empresa_logo,
     empresa.`regimen_id` AS empresa_regimen_id,
     empresa.`telefonos` AS empresa_telefonos,
     empresa.`celular` AS empresa_celular,
     empresa.`web` AS empresa_web,
     empresa.`correo` AS empresa_correo,
     empresa.`activo` AS empresa_activo,
     empresa.`kardex_id_default` AS empresa_kardex_id_default,
     empresa.`tipo_costeo` AS empresa_tipo_costeo,
     empresa.`valor_caja_defecto` AS empresa_valor_caja_defecto,
     empresa.`cobro_tarifa` AS empresa_cobro_tarifa,
     empresa.`plantilla` AS empresa_plantilla,
     centro_produccion.`id` AS centro_produccion_id,
     centro_produccion.`centro_produccion` AS centro_produccion_centro_produccion
	 FROM
     `empresa` empresa INNER JOIN `factura` factura ON empresa.`id` = factura.`empresa_id`
     INNER JOIN `centro_produccion` centro_produccion ON factura.`centro_produccion_id` = centro_produccion.`id`
     WHERE factura.anulado = 0 and  factura.`fecha` = '".$fecha."' order by factura.`consecutivo` asc";
	
	//print_r($sql);
 	$resultado=mysql_query($sql,$conexion);
	$suma=0.00;
	echo"<table width='100%' align='center' id='tabla1' data-role='table' id='table-custom-2' 
				data-mode='columntoggle' class='ui-body-d ui-shadow table-stripe ui-responsive' 
				data-column-btn-theme='b' data-column-btn-text='Columnas a Mostrar...' data-column-popup-theme='a'>";
	   echo"<thead><tr>";
         echo "<th>Prefijo</th>";
    	 echo "<th>Consecutivo</th>";
    	 echo "<th>Centro Prod</th>";
		 echo "<th>Subtotal</th>";
		 echo "<th>Descuento</th>";
		 echo "<th>IVA</th>";
		 echo "<th>Total</th>";
       echo"</tr></thead><tbody>";
	while($fila=mysql_fetch_array($resultado)){
		
		echo"<tr>";
    	   echo"<td>".$fila['factura_prefijo']."</td>";
    	   echo"<td>".$fila['factura_consecutivo']."</td>";
		   echo"<td>".$fila['centro_produccion_centro_produccion']."</td>";
		   echo"<td>".number_format($fila['factura_subtotal'],0,',','.')."</td>";
		   echo"<td>".number_format($fila['factura_descuento'],0,',','.')."</td>";
		   echo"<td>".number_format($fila['factura_iva'],0,',','.')."</td>";
		   echo"<td>".number_format($fila['factura_total'],0,',','.')."</td>";
		echo"</tr>";
		$suma=$suma+$fila['factura_total'];
	}
	
	echo"<tr>";
          echo"<td colspan='6'><div align='right'>Totales</div></td>";
    	  echo"<td colspan='1'>".number_format($suma,0,',','.')."</td>";
  		echo"</tr></tbody>";
	echo "</table>";
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