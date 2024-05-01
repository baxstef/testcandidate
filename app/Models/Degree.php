<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Exceptions\ProtectedDegreeException;


class Degree extends Model
{

    use HasFactory, SoftDeletes;

    protected $fillable = ['degreeTitle'];

    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }

    public function preventDeleteIfUsed()
    {
        if ($this->candidates()->exists()) {
            throw new ProtectedDegreeException('This degree is in use by a candidate and cannot be deleted.');
        }
    }

    // Sovrascrivi il metodo delete per eseguire la logica di verifica
    public function delete()
    {
        // Esegui la verifica prima di eliminare il grado
        $this->preventDeleteIfUsed();

        // Se non ci sono candidati associati, procedi con l'eliminazione
        return parent::delete();
    }
}
