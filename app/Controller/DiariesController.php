<?php
App::uses('AppController', 'Controller');
/**
 * Diaries Controller
 *
 * @property Diary $Diary
 */
class DiariesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Diary->recursive = 0;
		$this->set('diaries', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Diary->exists($id)) {
			throw new NotFoundException(__('Invalid diary'));
		}
		$options = array('conditions' => array('Diary.' . $this->Diary->primaryKey => $id));
		$this->set('diary', $this->Diary->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Diary->create();
			if ($this->Diary->save($this->request->data)) {
				$this->Session->setFlash(__('The diary has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The diary could not be saved. Please, try again.'));
			}
		}
		$users = $this->Diary->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Diary->exists($id)) {
			throw new NotFoundException(__('Invalid diary'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Diary->save($this->request->data)) {
				$this->Session->setFlash(__('The diary has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The diary could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Diary.' . $this->Diary->primaryKey => $id));
			$this->request->data = $this->Diary->find('first', $options);
		}
		$users = $this->Diary->User->find('list');
		$this->set(compact('users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Diary->id = $id;
		if (!$this->Diary->exists()) {
			throw new NotFoundException(__('Invalid diary'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Diary->delete()) {
			$this->Session->setFlash(__('Diary deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Diary was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
