<?php
App::uses('AppModel', 'Model');
/**
 * Payment Model
 *
 * @property Invoice $Invoice
 */
class Payment extends AppModel {


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
        'payment_no' => array(
            'rule' => array('minLength', '6'),
            'message' => 'Minimum 6 characters long'
        ),
		'payment_amount' => array(
           'rule' => 'numeric',
        ),
		'payment_method' => array(
           'rule' => 'notBlank',
        ),
		'payment_date' => array(
           'rule' => 'date',
        )

    );
	public $belongsTo = array(
		'Invoice' => array(
			'className' => 'Invoice',
			'foreignKey' => 'invoice_no',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
