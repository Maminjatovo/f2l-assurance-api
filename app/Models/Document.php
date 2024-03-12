<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'titre',
        'path',
        'type',
        'contrat_id'
    ];

    public function contrats()
    {
        return $this->belongsTo(Contrat::class);
    }

    public function createDocument($data)
    {
        return $this->create($data);
    }

    public function deleteDocument($id)
    {
        $document = $this->findOrFail($id);
        $document->delete();
        return $document;
    }



}


