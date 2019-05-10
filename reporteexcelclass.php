<?php


class Reporte{



	public function loadExcel(){



		/** Error reporting */
		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		date_default_timezone_set('Europe/London');

		define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');


			include_once("mysql_connect.php");
			



				
			$SQL = "SELECT * FROM participantes";
	
			
			$resultado = $con->query($SQL)or die (mysqli_error($con));
			if($resultado->num_rows > 0 ){
								
				date_default_timezone_set('America/Mexico_City');

				if (PHP_SAPI == 'cli')
					die('Este archivo solo se puede ver desde un navegador web');


		/** Include PHPExcel */
		require_once 'lib/PHPExcel.php';
		require_once 'lib/PHPExcel/IOFactory.php';
		// require_once 'lib/PHPExcel/mdl_usuario.php';
		set_include_path(get_include_path() . PATH_SEPARATOR . 'lib/');
		$cacheMethod = PHPExcel_CachedObjectStorageFactory:: cache_to_phpTemp;
		$cacheSettings = array( 'memoryCacheSize'  => '15MB');
		PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();
		
		// Set document properties
		$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
									 ->setLastModifiedBy("Maarten Balliauw")
									 ->setTitle("Office 2007 XLSX Test Document")
									 ->setSubject("Office 2007 XLSX Test Document")
									 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
									 ->setKeywords("office 2007 openxml php")
									 ->setCategory("Test result file");



		// Add some data
		$objPHPExcel->setActiveSheetIndex(0)
		            ->setCellValue('A1', 'NOMBRE')
		            ->setCellValue('B1', 'APELLIDO')
		            ->setCellValue('C1', 'MAIL')
		            ->setCellValue('D1', 'TELEFONO')
		            ->setCellValue('E1', 'LOCALIDAD')
		            ->setCellValue('F1', 'MODELO')
		            ->setCellValue('G1', 'TRANSFORMACION')
		            ->setCellValue('H1', 'MENSAJE')
		            ->setCellValue('I1', 'FECHA');
		            // ->setCellValue('G1', 'DIRECCION');

				//Se agregan los datos de los alumnos
				$i = 2;
				// $url = 'http://ofertas-disco.com.ar/concurso-navidad/uploads/';
				// . basename($fila["imagen"])
				while ($fila = $resultado->fetch_array()) {

// "http://ofertas-disco.com.ar/concurso-navidad/uploads/". basename($fila['imagen'])
				
					
					$objPHPExcel->setActiveSheetIndex(0)
		        		    ->setCellValue('A'.$i,  $fila['nombre'] )
		        		    ->setCellValue('B'.$i,  $fila['apellido'])
		        		    ->setCellValue('C'.$i,  $fila['mail'])
		        		    ->setCellValue('D'.$i,  $fila['telefono'])
		        		    ->setCellValue('E'.$i, $fila['localidad'])		            		
		            		->setCellValue('F'.$i, $fila['modelo'])
		            		->setCellValue('G'.$i, $fila['transformacion'])
		            		->setCellValue('H'.$i, $fila['mensaje'])		            		
		            		->setCellValue('I'.$i, $fila['date']);
		         
		            		// ->setCellValue('H'.$i, utf8_encode($fila['Concesionario']))
		            		// ->setCellValue('I'.$i, utf8_encode($fila['Horario']));
							
		            // $gdImage = imagecreatefromjpeg($fila['imagen']);
		            // $objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
		            // $objDrawing->setName('Sample image');
		            // $objDrawing->setDescription('Sample image');
		            // $objDrawing->setImageResource($gdImage);
		            // $objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
		            // $objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
		            // $objDrawing->setHeight(0.44);
		            // $objDrawing->setwidth(186);
		            // $objDrawing->setCoordinates('G'.$i);
		            // $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

							$i++;
				}


		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle('Participantes');


		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);

				// Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment;filename="reporte.xlsx"');
				header('Cache-Control: max-age=0');

				// Save Excel 2007 file

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
				// $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
				$objWriter->save('php://output');
				// $objWriter->save();
				exit;

				echo 'Files have been created in ' , getcwd() , EOL;

			
			}else{
				header("Refresh:0; url=participantes.php");
			}

	

	}

	public function downloadReport(){

		
			
			$this->loadExcel(); 


		


	}



}

	$reporte = new Reporte;
	$reporte->downloadReport();


