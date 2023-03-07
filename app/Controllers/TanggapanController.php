<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Tanggapan;
class TanggapanController extends BaseController{
    protected $tanggapans;

    function __construct()
    {
        $this->tanggapans = new Tanggapan();
    }
    public function index()
    {
        $data['tanggapan']=$this->tanggapans->findAll();
        return view('tanggapan_view',$data);
    }
    public function create()
    {
        return view('ftanggapan_view');
    }
    public function simpan()
    {
        $data= array(
            'id_penggaduan' =>$this->request->getPost('id_penggaduan'),
            'tgl_tanggapan' =>$this->request->getPost('tgl_tanggapan'),
            'tanggapan' =>$this->request->getPost('tanggapan'),
            'id_petugas' =>$this->request->getPost('id_petugas'),
        );
        $this->tanggapans->insert($data);
        session()->setFlashdata("message","Data Berhasil Disimpan");
        return $this->response->redirect('/tanggapan');
    }
    public function edit($id)
    {
         
            $data= array(
                'id_penggaduan' =>$this->request->getPost('id_penggaduan'),
                'tgl_tanggapan' =>$this->request->getPost('tgl_tanggapan'),
                'tanggapan' =>$this->request->getPost('tanggapan'),
                'id_petugas' =>$this->request->getPost('id_petugas'),
            );
        $this->tanggapans->update($id, $data);
        session()->setFlashdata('message','Data berhasil di edit');
        return redirect('tanggapan');

    }
    public function delete($id)
    {
        $this->tanggapans->delete($id);
        session()->setFlashdata("message","Data Berhasil Dihapus");
        return $this->response->redirect('/tanggapan');
    }
}
