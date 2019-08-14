<?php namespace App\Projeto;

use App\Support\Convert;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entity extends Model
{
    use Searchable, SoftDeletes;

    protected $convert = [];

    protected $appends = ['present'];

    public function getPresentAttribute()
    {
        if (!empty($this->attributes['cpf'])) {
            return $this->attributes['nome'];

        } elseif (!empty($this->attributes['cnpj'])) {
            return $this->attributes['razao_social'];
        }
    }

    public function setPresentAttribute($value)
    {
        $this->attributes['present'] = $value;
    }


    public function setAttribute($key, $value)
    {
        if (isset($this->convert[$key]) && $this->convert[$key]) {
            $type = $this->convert[$key];

            if ($type == 'date') {
                $this->attributes[$key] = Convert::dateToDBFormat($value);
            }

            if ($type == 'datetime') {
                $this->attributes[$key] = Convert::dateTimeToDBFormat($value);
            }

            if ($type == 'money') {
                $this->attributes[$key] = Convert::moneyToDecimal($value);
            }

            if ($type == 'cpf') {
                $this->attributes[$key] = Convert::removeMascara($value);
            }

            if ($type == 'cep') {
                $this->attributes[$key] = Convert::removeMascara($value);
            }

            if ($type == 'cnpj') {
                $this->attributes[$key] = Convert::removeMascara($value);
            }

            if ($type == 'fone') {
                $this->attributes[$key] = Convert::removeMascara($value);
            }

            return $this;
        }

        return parent::setAttribute($key, $value);
    }

    public function decimalMoney($valor)
    {
        return Convert::decimalToMoney($valor);
    }

//    public function getAttribute($key)
//    {
//        if (isset($this->convert[$key]) && $this->convert[$key]) {
//            $type = $this->convert[$key];
//
//            if ($type == 'date') {
//                return Convert::DBToCarbonFormat($this->attributes[$key]);
//            }
//
//            if ($type == 'money') {
//                return Convert::decimalToMoney($this->attributes[$key]);
//            }

////            if ($type == 'cpf') {
////                return Convert::removeMascara($this->attributes[$key]);
////            }
////
////            if ($type == 'cep') {
////                return Convert::removeMascara($this->attributes[$key]);
////            }
////
////            if ($type == 'cnpj') {
////                return Convert::removeMascara($this->attributes[$key]);
////            }
////
////            if ($type == 'fone') {
////                return Convert::removeMascara($this->attributes[$key]);
////            }
//        }

//        return parent::getAttribute($key);
//    }

    public function scopeApplyRequest($query, array $data)
    {
        if (isset($data['with'])) {
            if (strstr($data['with'], ",")) {
                $data['with'] = explode(",", $data['with']);
            }

            $query->with($data['with']);
        }

        if (isset($data['search']) || isset($data['fields'])) {
            $query->search($data['search'] ?? null, $data);
        }

        $query->limit(200);

        return $query;
    }

}

