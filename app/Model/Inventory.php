<?php
App::uses('AppModel', 'Model');
/**
 * Inventory Model
 *
 * @property Payment $Payment
 * @property Shipping $Shipping
 * @property User $User
 * @property Order $Order
 * @property Vary $Vary
 * @property Invoice $Invoice
 */
class Inventory extends AppModel {


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasOne associations
 *
 * @var array
 */
	public $hasOne = array(
		'Payment' => array(
			'className' => 'Payment',
			'foreignKey' => 'po_no',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Shipping' => array(
			'className' => 'Shipping',
			'foreignKey' => 'po_no',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Order' => array(
			'className' => 'Order',
			'foreignKey' => 'po_no',
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
		'Invoice' => array(
			'className' => 'Invoice',
			'foreignKey' => 'po_no',
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
