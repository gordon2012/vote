<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Entries Controller
 *
 * @property \App\Model\Table\EntriesTable $Entries
 */
class EntriesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Polls']
        ];
        $entries = $this->paginate($this->Entries);

        $this->set(compact('entries'));
        $this->set('_serialize', ['entries']);
    }

    /**
     * View method
     *
     * @param string|null $id Entry id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $entry = $this->Entries->get($id, [
            'contain' => ['Polls', 'Votes']
        ]);

        $this->set('entry', $entry);
        $this->set('_serialize', ['entry']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $entry = $this->Entries->newEntity();
        if ($this->request->is('post')) {
            $entry = $this->Entries->patchEntity($entry, $this->request->getData());
            if ($this->Entries->save($entry)) {
                $this->Flash->success(__('The entry has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The entry could not be saved. Please, try again.'));
        }
        $polls = $this->Entries->Polls->find('list', ['limit' => 200]);
        $this->set(compact('entry', 'polls'));
        $this->set('_serialize', ['entry']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Entry id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $entry = $this->Entries->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $entry = $this->Entries->patchEntity($entry, $this->request->getData());
            if ($this->Entries->save($entry)) {
                $this->Flash->success(__('The entry has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The entry could not be saved. Please, try again.'));
        }
        $polls = $this->Entries->Polls->find('list', ['limit' => 200]);
        $this->set(compact('entry', 'polls'));
        $this->set('_serialize', ['entry']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Entry id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $entry = $this->Entries->get($id);
        if ($this->Entries->delete($entry)) {
            $this->Flash->success(__('The entry has been deleted.'));
        } else {
            $this->Flash->error(__('The entry could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
