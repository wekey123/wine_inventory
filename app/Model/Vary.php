<?php
App::uses('AppModel', 'Model');
/**
 * Vary Model
 *
 * @property Product $Product
 */
class Vary extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'product_id';
	public $validate = array(
        
		'variant' => array(
            'rule' => 'notBlank',
        ),
		'metric' => array(
            'notEmpty' => array(
            'rule' => array('notBlank'),
            'message' => 'Please Select the size',
            'allowEmpty' => false
        	),
        ),
		'qty_type' => array(
            'notEmpty' => array(
            'rule' => array('notBlank'),
            'message' => 'Please Select the size',
            'allowEmpty' => false
        	),
        ),
		'qty' => array(
           'rule' => 'notBlank',
        ),
		'sku' => array(
           'rule' => 'notBlank',
        ),
		'barcode' => array(
           'rule' => 'notBlank',
        ),
		'price' => array(
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
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'product_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Order' => array(
			'className' => 'Order',
			'foreignKey' => 'product_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
