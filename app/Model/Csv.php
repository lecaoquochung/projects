<?php
App::uses('AppModel', 'Model');
/**
 * Csv Model
 *
 * @property Company $Company
 */
class Csv extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'csv';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';


	//The Associations below have been created with all possible keys, those that are not needed can be removed
}
