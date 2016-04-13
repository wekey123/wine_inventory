<?php 
		$this->PhpExcel->createWorksheet()->setDefaultFont('Calibri', 12);
		// define table cells
		$table = array(
			array('label' => __('SNO')),
			array('label' => __('VENDOR NAME')),
			array('label' => __('INVOICE NUMBER')),
			array('label' => __('PO NUMBER')),
			array('label' => __('PRODUCT NAME')),
			//array('label' => __('CATEGORY NAME'),'wrap' => true),
			array('label' => __('SIZE')),
			array('label' => __('SKU')),
			array('label' => __('BARCODE')),
			array('label' => __('QTY')),
			array('label' => __('PRICE')),
			array('label' => __('EXTENDED PRICE'))
		);
		
		// add heading with different font and bold text
		$this->PhpExcel->addTableHeader($table, array('name' => 'Cambria', 'bold' => true));
		
		// add data
		foreach ($data as $res) {
			 foreach ($res as $d)
			{
			$this->PhpExcel->addTableRow(array($d['SNO'],$d['VENDOR NAME'],$d['INVOICE NUMBER'],$d['PO NUMBER'],$d['PRODUCT NAME'],$d['SIZE'],$d['SKU'],$d['BARCODE'],$d['QTY'],$d['PRICE'],$d['EXTENDED PRICE']));
			}
		}
		$this->PhpExcel->addTableRow();
		$this->PhpExcel->addTableRow($totals);
		//echo $orderId;exit;
		$filename = 'Invoice Entry_'.$invoiceId.'.xlsx';
		// close table and output
		//$this->PhpExcel->addTableFooter()->output($filename);
		 if($frompage == null){
			 echo $this->PhpExcel->addTableFooter()->output($filename);
		 }else{
			 $this->PhpExcel->save('mailpo/'.$filename);
			 //$xls = $this->PhpExcel->addTableFooter()->output($filename);
			 //$writefile = 'mailpo/'.$filename.'.xls';
			 //$xls_handler = fopen ($writefile,'w');
			 //fwrite ($xls_handler,$xls);
			 //fclose ($xls_handler);
			 if($_SERVER['HTTP_HOST'] == '52.4.188.247'){
				header('Location: /inventory/orders/emailCheck/'.$invoiceId); 
				exit;
			 }else{
				header('Location: /orders/emailCheck/'.$invoiceId); 
				exit;
			 }
 		}
?>