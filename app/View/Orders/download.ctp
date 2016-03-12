<?php
 $line= $orders[0]['Order'];
 //$this->CSV->addRow(array_keys($line));
 foreach ($orders as $order)
 {

		$a[$order['Order']['po_no']]['Order'] = $order['Order'];
		debug($order['Order']['po_no']);
		 foreach($order['Vary'] as $vary){
			 if($order['Order']['po_no'] == $vary['po_no']){
				$a[$order['Order']['po_no']]['Vary'][] = $vary;
		 	 }
		 }

      
 }
 	debug($a);
 exit;
 $filename='orders';
 echo  $this->CSV->render($filename);
?>