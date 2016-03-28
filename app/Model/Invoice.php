<?php
App::uses('AppModel', 'Model');
/**
 * Invoice Model
 *
 * @property Order $Order
 * @property Vary $Vary
 * @property Payment $Payment
 */
class Invoice extends AppModel {
	
	
	public $validate = array(
        'po_no' => array(
           'rule' => 'notBlank',
        ),
		'invoice_no' => array(
            'rule' => 'notBlank',
        ),
		'invoice_date' => array(
           'rule' => 'notBlank',
        ),
		'shipping_method' => array(
           'rule' => 'notBlank',
        ),
		'estimated_shipping_date' => array(
           'rule' => 'notBlank',
        ),
    );
	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Order' => array(
			'className' => 'Order',
			'foreignKey' => 'po_no',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Vary' => array(
			'className' => 'Vary',
			'foreignKey' => 'product_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'InvoiceColumn' => array(
			'className' => 'InvoiceColumn',
			'foreignKey' => 'invoice_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Payment' => array(
			'className' => 'Payment',
			'foreignKey' => 'invoice_no',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
