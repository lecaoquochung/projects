<?php
App::uses('AppController', 'Controller');
/**
 * RecruitsFixes Controller
 *
 * @property RecruitsFix $RecruitsFix
 * @property PaginatorComponent $Paginator
 */
class RecruitsFixesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->RecruitsFix->recursive = 0;
        $this->paginate = array('limit' => 1000, 'order' => array('id' => 'desc'),);
		$this->set('recruitsFixes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->RecruitsFix->exists($id)) {
			throw new NotFoundException(__('Invalid recruits fix'));
		}
		$options = array('conditions' => array('RecruitsFix.' . $this->RecruitsFix->primaryKey => $id));
		$this->set('recruitsFix', $this->RecruitsFix->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->RecruitsFix->create();
			if ($this->RecruitsFix->save($this->request->data)) {
				$this->Session->setFlash(__('The recruits fix has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The recruits fix could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit ajax method
 *
 * @return void
 */
	public function edit_ajax() {
		$this->autoRender = false;
		Configure::write('debug', 0);
		$this->RecruitsFix->id = intval($this->request->data['id']);
		$this->RecruitsFix->saveField($this->request->data['field'], $this->request->data['value']);
	}	
	
/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->RecruitsFix->exists($id)) {
			throw new NotFoundException(__('Invalid recruits fix'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->RecruitsFix->save($this->request->data)) {
				$this->Session->setFlash(__('The recruits fix has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The recruits fix could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('RecruitsFix.' . $this->RecruitsFix->primaryKey => $id));
			$this->request->data = $this->RecruitsFix->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->RecruitsFix->id = $id;
		if (!$this->RecruitsFix->exists()) {
			throw new NotFoundException(__('Invalid recruits fix'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->RecruitsFix->delete()) {
			$this->Session->setFlash(__('The recruits fix has been deleted.'));
		} else {
			$this->Session->setFlash(__('The recruits fix could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function download_csv($full = false){
		$this->RecruitsFix->recursive = 0;
		if($full==false){
			$this->export(array(
				//'fields' => array(),
				//'conditions'=>array(),
				'fields' => array('RecruitsFix.id', 'RecruitsFix.name', 'RecruitsFix.title', 'RecruitsFix.description', 'RecruitsFix.office_name'),
				'order' => array('RecruitsFix.id' => 'desc'),
				'mapHeader' => 'HEADER_CSV_DOWNLOAD_RECUITSFIX',
				'filename' => 'RecruitsFix_'.date('Y-m-d-H-i-s')
			));
		}else{
			$this->export(array(
				'order' => array('RecruitsFix.id' => 'desc'),
				'filename' => 'RecruitsFix_'.date('Y-m-d-H-i-s')
			));			
		}		
	}
	
	public function csv($id = NULL, $full = false) {
		set_time_limit(0);
		$this->loadModel('Csv');
        if ($this->request->is('post')) {			
			// create the folder if it does not exist
			if(!is_dir(WWW_ROOT.'uploads')) {
				mkdir(WWW_ROOT.'uploads');
			}		
            $csv = $this->Upload->uploadFile('uploads/csv',$this->request->data['RecruitsFix']['csv']);
            if(!empty($csv['urls'])){
                try {
					//save csv to db
					$tb_csv['Csv']['filename'] = $csv['name'];					
					$this->Csv->create();
					$this->Csv->save($tb_csv);
					
                    $recruits_fix = array();
					
                    if($this->RecruitsFix->importCSV($csv['urls'],$recruits_fix,false,array(
						'delimiter'  => ',', //serevr is comment out
						'hasHeader'=>false,					
					))){
						$this->Session->setFlash( __('Import File CSV') . ' ' . $this->request->data['RecruitsFix']['csv']['name'].' ' . __('successfull.')  );
                    }
                    $import_errors = $this->RecruitsFix->getImportErrors();
					$import_errors = Hash::extract($import_errors,"{n}.validation.url.{n}");
                    $this->set( 'import_errors', $import_errors);					
                } catch (Exception $e) {
                    $import_errors = $this->RecruitsFix->getImportErrors();
					$import_errors = Hash::extract($import_errors,"{n}.validation.url.{n}");
                    $this->set( 'import_errors', $import_errors );
                    $this->Session->setFlash( __('Error Importing') . ' ' . $this->request->data['RecruitsFix']['csv']['name'] . ', ' . __('column name mismatch.')  );
                    //$this->redirect( array('action'=>'import') );
                }                 
            }
        }
		
        #list file csv
		$files = $this->Csv->find('all');
        $this->set(compact('files'));
    }
	
/**
* delete csv method
*
* @return void
*/
    public function delete_csv($id = null) {
        if(!empty($id)){
			$this->loadModel('Csv');
			$csv = $this->Csv->findById($id);			
			if($this->Csv->delete($id)){
				$this->Upload->deleteFile('uploads/csv',$csv['Csv']['filename']);
				$this->Session->setFlash( __('Delete File CSV') . ' ' . $csv['Csv']['filename'].'.csv ' . __('successfull.')  );			
			}
        }        
        $this->redirect($this->referer());
    }	
	
}
