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
 echo  $this->CSV->render($filename);
?>