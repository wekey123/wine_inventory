<?php
App::uses('AppModel', 'Model');
/**
 * Shipping Model
 *
 * @property Invoice $Invoice
 */
class Shipping extends AppModel {


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
 	public $validate = array(
		'invoice_no' => array(
            'rule' => 'notBlank',
        ),
		'shipping_no' => array(
            'rule' => 'notBlank',
        ),
		'shipping_quantity' => array(
           'rule' => 'notBlank',
        ),
		'received_date' => array(
			'rule' => 'notBlank',
		)
    );
	public $belongsTo = array(
		'Invoice' => array(
			'className' => 'Invoice',
			'foreignKey' => 'invoice_no',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
