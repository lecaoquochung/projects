<?php
App::uses('AppModel', 'Model');
/**
 * RecruitsFix Model
 *
 */
class RecruitsFix extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'Recruits_fix';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * CSV export
 *
 * @var array
 */    
    public $actsAs = array(
        'CsvImport' => array(
            // 'delimiter'  => ',', //serevr is comment out
            'hasHeader'=>true,
            'mapHeader'=> 'HEADER_CSV_UPLOAD_RECRUITS_FIX',
			'max_execution_time'=>0,
			'post_max_size'=>'64M',
			'upload_max_filesize'=>'64M'
        ),
	    'CsvExport' => array(
	        'delimiter' => ',', //The delimiter for the values, default is ;
	        'enclosure' => '"', //The enclosure, default is "
	        'max_execution_time' => 360, //Increase for Models with lots of data, has no effect is php safemode is enabled.
	        'encoding' => 'utf8' //Prefixes the return file with a BOM and attempts to utf_encode() data
	    )		
	);	

    public function beforeImport($data){
		$null = true;
		if(count($data[$this->alias])>0){
			foreach($data[$this->alias] as $field=>$value){
				if(!empty($value)){
					$null = false;
					break;
				}
			}
		}
		if($null==false){
			if(!isset($data[$this->alias]['id'])){
				if(!isset($data[$this->alias]['plan_code'])){
					$data[$this->alias]['plan_code'] = 0;
				}      
				
				if(!isset($data[$this->alias]['plan_group_code'])){
					$data[$this->alias]['plan_group_code'] = 0;
				}   

				if(!isset($data[$this->alias]['company_id'])){
					$data[$this->alias]['company_id'] = 0;
				}   

				if(!isset($data[$this->alias]['jobcodes'])){
					$data[$this->alias]['jobcodes'] = 0;
				}

				if(!isset($data[$this->alias]['workstatus'])){
					$data[$this->alias]['workstatus'] = '';
				}

				if(!isset($data[$this->alias]['name'])){
					$data[$this->alias]['name'] = '';
				}

				if(!isset($data[$this->alias]['status'])){
					$data[$this->alias]['status'] = 1;
				}   		
			}		
			
			return $data;		
		}else{
			return array();
		}
    }
	
}
