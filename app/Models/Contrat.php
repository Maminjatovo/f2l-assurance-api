<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contrat extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'creation_date',
        'user_id'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function createContrat($data)
    {
        return $this->create($data);
    }

    public function deleteContrat($id)
    {
        $contrat = $this->findOrFail($id);
        $contrat->delete();
        return $contrat;
    }

    public function updateContrat($id, $data)
    {
        $contrat= $this->findOrFail($id);
        $contrat->update($data);
        return $contrat;
    }

}


