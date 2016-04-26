  <?php 
   echo $this->Html->css('dataTables/dataTables.bootstrap.min.css');
   echo $this->Html->script('dataTables/jquery.dataTables.min');
   echo $this->Html->script('dataTables/dataTables.bootstrap.min'); ?>
   
   
   <script>
$(document).ready(function() {
    $('#example').DataTable();
	$(function() {
		$('#dateFrom').datepicker({
			format: 'yyyy/mm/dd',
			startDate: '-3d',
			onClose: function( selectedDate ) {
			$( "#dateTo" ).datepicker( "option", "minDate", selectedDate );
		  }
		});
		 $('#dateTo').datepicker({
			format: 'yyyy/mm/dd',
			startDate: '-3d',
			onClose: function( selectedDate ) {
			$( "#dateFrom" ).datepicker( "option", "maxDate", selectedDate );
		  }
		});
  });
} );
</script>
	 