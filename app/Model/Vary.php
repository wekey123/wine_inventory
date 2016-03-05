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
		)
	);
}
