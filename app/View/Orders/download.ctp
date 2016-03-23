<?php 
 // echo "<pre>";
 //print_r($orders); exit;
 $i = 0;
 foreach ($orders as $key => $res)
 {	
	$this->CSV->addRow(array_keys($res[$i]));
    foreach ($res as $data)
	{
  	$this->CSV->addRow($data);
	}
	$i++;
 }

 $this->CSV->addRow();
 $this->CSV->addRow($totals);
 $filename ='PO_'.$key;
 if($frompage == null){
	 echo $this->CSV->render($filename);
 }else{
	 $csv = $this->CSV->render($filename);
	 $writefile = 'mailpo/'.$filename.'.csv';
	 $csv_handler = fopen ($writefile,'w');
	 fwrite ($csv_handler,$csv);
	 fclose ($csv_handler);
	 
	 header('Location: /orders/emailCheck/'.$key); exit;
 }

?>