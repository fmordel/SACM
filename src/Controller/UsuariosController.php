<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
/**
 * Usuarios Controller
 *
 * @property \App\Model\Table\UsuariosTable $Usuarios
 */
class UsuariosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $usuarios = $this->paginate($this->Usuarios);

        $this->set(compact('usuarios'));
        $this->set('_serialize', ['usuarios']);
    }

    /**
     * View method
     *
     * @param string|null $id Usuario id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    /* POR EL MOMENTO NO SE USARA ESTE METODO
    public function view($id = null)
    {
        $usuario = $this->Usuarios->get($id, [
            'contain' => []
        ]);

        $this->set('usuario', $usuario);
        $this->set('_serialize', ['usuario']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $usuario = $this->Usuarios->newEntity();
        if ($this->request->is('post')) {
            $usuario = $this->Usuarios->patchEntity($usuario, $this->request->data);
            if ($this->Usuarios->save($usuario)) {
                $this->Flash->success(__('El usuario se guardo.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El usuario no pudo ser guardado. Intentalo de nuevo.'));
            }
        }
        $this->set(compact('usuario'));
        $this->set('_serialize', ['usuario']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Usuario id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $usuario = $this->Usuarios->get($id, [
            'contain' => []
        ]);
        /*
        $time = $usuario->creado;
        $time->setToStringFormat('yyyy-MM-dd HH:mm:ss');

        return debug($time); 
        */
        if ($this->request->is(['patch', 'post', 'put'])) {
            $usuario = $this->Usuarios->patchEntity($usuario, $this->request->data);

            if ($this->Usuarios->save($usuario)) {
                $this->Flash->success(__('El usuario fue Actualizado.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El usuario no pudo ser Actualizado. Intentalo de nuevo.'));
            }
        }
        $this->set(compact('usuario'));
        $this->set('_serialize', ['usuario']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Usuario id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $usuario = $this->Usuarios->get($id);
        if ($this->Usuarios->delete($usuario)) {
            $this->Flash->success(__('El usuario fue borrado.'));
        } else {
            $this->Flash->error(__('El usuario no pudo ser borrado. Intentalo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    
    //LOGIN
    public function login(){
        if($this->request->is('post')){
            $usuario=$this->Auth->identify();
            //print_r(debug($user));
            if($usuario){
                print_r($usuario);
                $this->Auth->setUser($usuario);
                return $this->redirect(['controller'=>'usuarios/index']);
            }
            $this->Flash->error("Error en el usuario o contraseña");            
        }
    }
    
    //VALIDAR CORREO
    public function validar(){
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user= $this->request->data['Correo'];
            $opciones=array('conditions' => array('usuarios.correo' => $user));
        
            $query = $this->Usuarios->find('all',$opciones);
            $this->Set('Colocar',$query);
            
        }
    }

    //RECUPERAR PASSWORD
    public function recuperar($Correo=null){
        $user = $this->Usuarios->get($Correo, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Usuarios->patchEntity($user, $this->request->data);
            if ($this->Usuarios->save($user)) {
                $this->Flash->success(__('La contraseña ha sido cambiada con Exito.'));

                return $this->redirect(['action' => 'login']);
            } else {
                $this->Flash->error(__('La contraseña no pudo ser restaurada.Intente de nuevo.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }
        
    //LOGOUT
    public function logout(){
        return $this->redirect($this->Auth->logout());
    }
    
    //FILTRAR USUARIO
    public function beforeFilter(Event $event){
        $this->Auth->allow(['validar']);
        $this->Auth->allow(['recuperar']);
    }
    
}
