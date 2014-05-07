<?php

    include('conexion.php');

    $sql = "select proveedores.id,nit,concat_ws(' ', nombre1,nombre2,apellido1, apellido2) as nombres, 
	razon_social, direccion_oficina,direccion_casa,telefono1,celular,departamentos.departamento as departamento, 
	municipios.municipio as municipio from proveedores,departamentos, municipios where 
	proveedores.departamentos_id=departamentos.id and proveedores.municipios_id=municipios.id";
	
	$resultado=mysql_query($sql,$conexion);
	
	echo"<table width='100%' align='center' data-role='table' id='table-custom-2' 
				data-mode='columntoggle' class='ui-body-d ui-shadow table-stripe ui-responsive' 
				data-column-btn-theme='b' data-column-btn-text='Columnas a Mostrar...' data-column-popup-theme='a'>";
	   echo"<thead><tr>";
         echo "<th>Id</th>";
    	 echo "<th>Nit</th>";
    	 echo "<th>Nombres</th>";
		 echo "<th>R.Social</th>";
		 echo "<th>D.Ofic</th>";
		 echo "<th>D.Casa</th>";
		 echo "<th>Tel</th>";
		 echo "<th>Celular</th>";
		 echo "<th>Dpto</th>";
		 echo "<th>Mpio</th>";
       echo"</tr></thead><tbody>";
	while($fila=mysql_fetch_array($resultado)){
		
		
		 echo"<tr>";
			echo"<td>".$fila['id']."</td>";
			echo"<td>".$fila['nit']."</td>";
			echo"<td>".$fila['nombres']."</td>";
			echo"<td>".$fila['razon_social']."</td>";
			echo"<td>".$fila['direccion_oficina']."</td>";
			echo"<td>".$fila['direccion_casa']."</td>";
			echo"<td>".$fila['telefono1']."</td>";
			echo"<td>".$fila['celular']."</td>";
			echo"<td>".$fila['departamento']."</td>";
			echo"<td>".$fila['municipio']."</td>";
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