<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
class PengaduanController extends BaseController{
    protected $pengaduans , $tanggapans;
    function __construct()
    {
        $this->pengaduans = new Pengaduan();
        $this->tanggapans = new Tanggapan();
    }
    public function index()
    {
        if(session()->get('level')== 'masyarakat'){
            $data['pengaduan'] = $this->pengaduans->where(['nik'=>session()
            ->get('nik')])->findAll();
        }else{
            $data['pengaduan'] = $this->pengaduans->findAll();
        }

        return view('pengaduan_view',$data);
    }
    public function create()
    {
        return view('fpengaduan_view');
    }
    public function Simpan(){
        // if(!$this->validate([
        //     'foto'=> [
        //         'rules'=>'uploaded[foto]|mime_in[foto, image/jpeg,image/jpg]|max_size[foto,2048]',
        //         'errors' =>[
        //             'uploaded' =>'Harus ada file yang diupload',
        //             'mime_in'=> 'File extension harus ada jpg jpeg',
        //             'max_size'=>'Ukuran file maxsimal 2mb',
        //         ]
        //     ]
        // ]))
        // {
        //     return redirect()->back()->withInput();
        // }
    $dataFile = $this->request->getFile('foto');
    $filename= $dataFile->getRandomName();

        $this->pengaduans->insert([
            'tgl_pengaduan' =>date('Y-m-d'),
            'nik' =>session()->get('nik'),
            'isi_laporan' =>$this->request->getPost('isi_laporan'),
            'foto' =>$filename,
            'status' =>"0",
        ]);
        $dataFile->move('uploads/berkas/',$filename);
        return redirect('pengaduan');
    }
    public function edit($id)
    {
       
            $data= array(
                'tgl_pengaduan' =>$this->request->getPost('tgl_pengaduan'),
                'nik' =>$this->request->getPost('nik'),
                'isi_laporan' =>$this->request->getPost('isi_laporan'),
                'foto' =>$this->request->getPost('foto'),
                'status' =>$this->request->getPost('status'),
            );
        
        $this->pengaduans->update($id, $data);
        session()->setFlashdata('message','Data berhasil di edit');
        return redirect('pengaduan')->with('Sukses nihh!!!','update berhasil');
        
    }
    public function delete($id)
    {
        $this->pengaduans->delete($id);
        session()->setFlashdata("message","Data Berhasil Dihapus");
        return $this->response->redirect('/pengaduan');
    }
}
