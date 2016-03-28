<?php
App::uses('AppModel', 'Model');
/**
 * InvoicesColumn Model
 *
 * @property Invoice $Invoice
 */
class InvoicesColumn extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'invoices_column';


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Invoice' => array(
			'className' => 'Invoice',
			'foreignKey' => 'invoice_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
