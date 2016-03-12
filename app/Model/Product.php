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
		'category_name' => array(
            'rule' => 'notBlank',
        ),
		'brand' => array(
           'rule' => 'notBlank',
        ),
		'vendor' => array(
            'rule' => 'notBlank',
        ),
		'country' => array(
           'rule' => 'notBlank',
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
