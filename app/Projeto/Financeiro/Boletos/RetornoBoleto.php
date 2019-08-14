<?php namespace App;

use App\Entities\Entity;
use App\Entities\Financeiro\ContasAReceber;

class RetornoBoleto extends Entity
{
    protected $table = 'retorno_boletos';

    protected $fillable = [
        'retorno_id',
        'boleto_id',
        'data_credito',
        'valor',
        'valor_tarifa',
        'juros_boleto',
    ];

    protected $convert = [
        'data_credito' => 'date',
        'valor' => 'money',
        'valor_tarifa' => 'money',
        'juros_boleto' => 'money',
    ];

    public function boletos(){
        return $this->belongsTo(ContasAReceber::class, 'boleto_id');
    }
}
