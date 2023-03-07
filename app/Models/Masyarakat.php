<?php 
namespace App\Models;

use CodeIgniter\Model;

class Masyarakat extends Model{
    protected $table      = 'tbmasyarakat';
    // Uncomment below if you want add primary key
     protected $primaryKey = 'id_masyarakat';
     protected $useAutoIncrement=true;
     protected $allowedFields=['nik','nama','username','password','telp'];
}