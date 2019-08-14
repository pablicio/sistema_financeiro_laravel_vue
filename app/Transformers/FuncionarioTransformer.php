<?php namespace App\Transformers;



use App\Projeto\Funcionarios\Funcionario;

class FuncionarioTransformer extends Transformer
{
    /**
     * @return  array
     */
    public function transform(Funcionario $funcionario)
    {
        return [
            'nome' => $funcionario->getPresentAttribute(),
            'email' => $funcionario->email,
            'rg' => $funcionario->rg,
            'data_nascimento' => $this->format2($funcionario->data_nascimento),
            'cpf' => $funcionario->cpf,
            'endereco' => $funcionario->endereco,
            'bairro' => $funcionario->bairro,
            'cep' => $funcionario->cep,
            'cidade' => $funcionario->cidade,
            'descricao' => $funcionario->descricao,
            'action' => $this->setAction($funcionario->id),
        ];
    }

    public function setAction($id = null)
    {
        return '<td class="text-center">
                            <ul class="icons-list">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                               
                                        <li>
                                            <a href="/admin/funcionarios/' . $id . '/edit"><i
                                                        class="icon-pencil5"></i> Editar Funcionario</a>
                                        </li>
                                        <li>
                                            <a href="/admin/deleteFuncionario/' . $id . '"><i
                                                        class="icon-close2"></i> Excluir Funcionario</a>
                                        </li>
                    
                                    </ul>
                                </li>
                            </ul>
                        </td>';
    }
}
