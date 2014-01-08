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
	}}
