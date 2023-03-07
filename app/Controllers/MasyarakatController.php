<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Masyarakat;
class MasyarakatController extends BaseController{
    protected $masyarakats;

    function __construct(){
        $this->masyarakats = new Masyarakat();
    }
    public function index(){
        $data['Masyarakat'] = $this->masyarakats->findAll();
        return view('Masyarakat_view',$data);
    }
    public function save(){
        $data = array(
            'nik'=>$this->request->getPost('nik'),
            'nama'=>$this->request->getPost('nama'),
            'username'=>$this->request->getPost('username'),
            'password'=> password_hash($this->request->getPost('password')."",PASSWORD_DEFAULT),
            'telp'=>$this->request->getPost('telp'),
        );
        $this->masyarakats->insert($data);
        session()->setFlashdata("message","Data berhasil Disimpan");
        return $this->response->redirect('/Masyarakat');
    }
    public function edit($id){
        if ($this->request->getPost('ubahpassword')){
            $data = array('nik'=>$this->request->getPost('nik'),
            'nama'=>$this->request->getPost('nama'),
            'username'=>$this->request->getPost('telp'),
            'password'=>password_hash($this->request->getPost('password')."",PASSWORD_DEFAULT),
            'telp'=>$this->request->getPost('telp'),
        );
        }else{
            $data = array('nik'=>$this->request->getPost('nik'),
            'nama'=>$this->request->getPost('nama'),
            'username'=>$this->request->getPost('username'),
            'password'=>password_hash($this->request->getPost('password')."",PASSWORD_DEFAULT),
            'telp'=>$this->request->getPost('telp'),
        );
        }
        $this->masyarakats->update($id, $data);
        session()->setFlashdata('message','Data petugas berhasil di edit');
        return redirect('Masyarakat')->with('Sukses nih!!!','update berhasil');
    }
    public function delete($id){
        $this->masyarakats->delete($id);
        session()->setFlashdata("message","Data Berhasil Dihapus");
        return $this->response->redirect('/masyarakat');
    }

}
