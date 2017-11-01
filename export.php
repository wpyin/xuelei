<?php
	$dir=dirname(__FILE__);//查找当前脚本所在路径
	require $dir."/PHPExcel/PHPExcel.php";//引入PHPExcel
	require $dir."/db.php";//引入mysql操作类文件
	
	$db = new db($phpexcel);//实例化db类
	$objPHPExcel=new PHPExcel();//实例化phpexcel类   等同于创建一个excel
	for ($i=1; $i <7 ; $i++) { 
		if($i>1){
			$objPHPExcel->createSheet();
		}
		$objPHPExcel->setActiveSheetIndex($i-1);
		$objSheet=$objPHPExcel->getActiveSheet();//获取当前活动sheet
		$objSheet->setTitle($i);
		$data=$db->getDataByWeek("周".$i);
		$objSheet->setCellValue("A1","编号")->setCellValue("B1","姓名")->setCellValue("C1","教室")->setCellValue("D1","节次");//填充数据
		$j=2;
			foreach ($data as $key => $val) {
				$objSheet->setCellValue("A".$j,$val['ID'])->setCellValue("B".$j,$val['XINGMING'])->setCellValue("C".$j,$val['ROOM'])->setCellValue("D".$j,$val['CLASS']);
				$j++;
			}


	}
	
	$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');//生成excel文件
	$objWriter->save($dir."/export_1.xls");//保存文件

?>