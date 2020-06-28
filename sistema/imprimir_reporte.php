<?php 

	require_once('lib/pdf/mpdf.php');

  $host = 'localhost';
  $user = 'root';
  $password = '';
  $db = 'inventariosistemaweb';

  $conection = @mysqli_connect($host, $user, $password, $db);

  $query = "SELECT d.iddatos, d.num_reporte, d.marca, d.modelo, d.no_serie, d.descripcion, t.tipo_registro, m.motivo, d.departamento, d.ubicacion_fisica, d.ubicacion_sistema, d.dateadd, u.idusuario, u.nombre, u.foto, u.correo, u.usuario, u.telefono, u.direccion, r.rol FROM usuario u INNER JOIN datos d ON d.usuario_id = u.idusuario INNER JOIN motivo m ON d.motivo = m.idmotivo INNER JOIN rol r ON u.rol = r.idrol INNER JOIN tipo_registro t ON d.tipo_registro = t.idtipo_registro ORDER BY iddatos ASC";
  $prepare = $conection->prepare($query);
  $prepare->execute();
  $resultSet = $prepare->get_result();
  while($usuario[] = $resultSet->fetch_array());
  $resultSet->close();
  $prepare->close();
  $conection->close();  

	$html .= '<header class="clearfix">
      <div id="logo">
        <img src="reportes/img/UV_logo.jpg">
      </div>
      <h1>Inventario de la Direccion de Control de Bienes Muebles e Inmuebles de la UV</h1>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="service">NOMBRE</th>
            <th class="desc">NUM.REPORTE</th>
            <th class="desc">MARCA</th>
            <th class="desc">DESCRIPCION</th>
            <th class="service">TIPO DE REGISTRO</th>
            <th class="service">MOTIVO</th>
            <th class="service">FECHA</th>
            <th class="service">AREA</th>
          </tr>
        </thead>
        <tbody>';

        foreach ($usuario as $Usuario) {
          $html .= '<tr>
            <td class="desc">'.$Usuario["nombre"].'</td>
            <td class="desc">'.$Usuario["num_reporte"].'</td>
            <td class="desc">'.$Usuario["marca"].'</td>
            <td class="desc">'.$Usuario["descripcion"].'</td>
            <td class="desc">'.$Usuario["tipo_registro"].'</td>
            <td class="desc">'.$Usuario["motivo"].'</td>
            <td class="desc">'.$Usuario["dateadd"].'</td>
            <td class="desc">'.$Usuario["departamento"].'</td>
          </tr>';
        }
        $html .= '
        </tbody>
      </table>
    </main>';

	$mpdf = new mPDF('c','A4-L');
  $css = file_get_contents('reportes/css/style.css');
  $mpdf->writeHTML($css, 1);
	$mpdf->writeHTML($html);
	$mpdf->Output('Reporte_Inventario.pdf', 'I');
?>