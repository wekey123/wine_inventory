<?php
App::uses('AppModel', 'Model');
/**
 * Product Model
 *
 * @property Order $Order
 * @property Vary $Vary
 */
class Product extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';
	public $validate = array(
        'title' => array(
            'rule' => array('minLength', '8'),
            'message' => 'Minimum 8 characters long'
        ),
		'vendor_id' => array(
            'notEmpty' => array(
            'rule' => array('notBlank'),
            'message' => 'Please Select the Vendor',
            'allowEmpty' => false
        	),
        ),
		'vendor_type' => array(
           'notEmpty' => array(
            'rule' => array('notBlank'),
            'message' => 'Please Select the Vendor',
            'allowEmpty' => false
        	),
        ),
		'image' => array(
			'rule' => array(
				'extension',
				array('gif', 'jpeg', 'png', 'jpg')
			),
			'message' => 'Please supply a valid image.'
		)
    );
	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
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
	  ),'Category' => array(
	   'className' => 'Category',
	   'foreignKey' => 'vendor_type',
	   'conditions' => '',
	   'fields' => '',
	   'order' => ''
	  ),'Vendor' => array(
	   'className' => 'Vendor',
	   'foreignKey' => 'vendor_id',
	   'conditions' => '',
	   'fields' => '',
	   'order' => ''
	  )
	 );
	
	public $hasMany = array(
		'Order' => array(
			'className' => 'Order',
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
		'Vary' => array(
			'className' => 'Vary',
			'foreignKey' => 'product_id',
			'dependent' => false,
			'conditions' => array('Vary.type'=>'product'),
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
