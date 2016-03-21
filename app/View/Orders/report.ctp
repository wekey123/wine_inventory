<?php 
		$this->PhpExcel->createWorksheet()->setDefaultFont('Calibri', 12);
		
		// define table cells
		$table = array(
			array('label' => __('SNO')),
			array('label' => __('PO NUMBER')),
			array('label' => __('PRODUCT NAME')),
			array('label' => __('CATEGORY NAME'),'wrap' => true),
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
			$this->PhpExcel->addTableRow(array($d['SNO'],$d['PO NUMBER'],$d['PRODUCT NAME'],$d['CATEGORY NAME'],$d['SIZE'],$d['SKU'],$d['BARCODE'],$d['QTY'],$d['PRICE'],$d['EXTENDED PRICE']));
			}
		}
		$this->PhpExcel->addTableRow();
		$this->PhpExcel->addTableRow($totals);
		$orderid = 'ORD197837';
		$filename = 'PurchaseOrder_'.$orderid.'.xlsx';
		// close table and output
		$this->PhpExcel->addTableFooter()->output($filename);
?>