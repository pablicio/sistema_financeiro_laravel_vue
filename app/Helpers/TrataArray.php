<?php namespace App\Helpers;

class TrataArray
{
    public static function array_filter_recursive(array $array)
    {
        foreach ($array as $key => &$value) {
            if (empty($value)) {
                unset($array[$key]);
            } else {
                if (is_array($value)) {
                    $value = self::array_filter_recursive($value);
                    if (empty($value)) {
                        unset($array[$key]);
                    }
                }
            }
        }
        return $array;
    }

    public static function formasPagamento()
    {
        return [
            'cartao_credito0',
            'cartao_credito1',
            'cartao_credito2',
            'cartao_credito3',
            'cartao_credito4',
            'cartao_credito5',
            'cartao_credito6',
            'cartao_credito7',
            'cartao_credito8',
            'cartao_credito9',
            'cartao_credito10',
            'cartao_credito11',
            'cartao_credito12',
            'cartao_credito13',
            'cartao_credito14',
            'cartao_credito15',
            'cartao_debito0',
            'cartao_debito1',
            'cartao_debito2',
            'cartao_debito3',
            'cartao_debito4',
            'cartao_debito5',
            'cartao_debito6',
            'cartao_debito7',
            'cartao_debito8',
            'cartao_debito9',
            'cartao_debito10',
            'cartao_debito11',
            'cartao_debito12',
            'cartao_debito13',
            'cartao_debito14',
            'cartao_debito15',
            'dinheiro',
            'boleto',
            'cheque',
            'outra'
        ];
    }

}