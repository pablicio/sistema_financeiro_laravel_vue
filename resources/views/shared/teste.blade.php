@extends('template.template')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel invoice-grid">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <h6 class="text-semibold no-margin-top">Leonardo Fellini</h6>
                            <ul class="list list-unstyled">
                                <li>Invoice #: &nbsp;0028</li>
                                <li>Issued on: <span class="text-semibold">2015/01/25</span></li>
                            </ul>
                        </div>

                        <div class="col-sm-6">
                            <h6 class="text-semibold text-right no-margin-top">$8,750</h6>
                            <ul class="list list-unstyled text-right">
                                <li>Method: <span class="text-semibold">SWIFT</span></li>
                                <li class="dropdown">
                                    Status: &nbsp;
                                    <a href="#" class="label bg-danger-400 dropdown-toggle" data-toggle="dropdown">Overdue
                                        <span class="caret"></span></a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li class="active"><a href="#"><i class="icon-alert"></i> Overdue</a></li>
                                        <li><a href="#"><i class="icon-alarm"></i> Pending</a></li>
                                        <li><a href="#"><i class="icon-checkmark3"></i> Paid</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#"><i class="icon-spinner2 spinner"></i> On hold</a></li>
                                        <li><a href="#"><i class="icon-cross2"></i> Canceled</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="panel-footer panel-footer-condensed">
                    <div class="heading-elements">
												<span class="heading-text">
													<span class="status-mark border-danger position-left"></span> Due: <span
                                                            class="text-semibold">2015/02/25</span>
												</span>

                        <ul class="list-inline list-inline-condensed heading-text pull-right">
                            <li><a href="#" class="text-default" data-toggle="modal" data-target="#invoice"><i
                                            class="icon-eye8"></i></a></li>
                            <li class="dropdown">
                                <a href="#" class="text-default dropdown-toggle" data-toggle="dropdown"><i
                                            class="icon-menu7"></i> <span class="caret"></span></a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="#"><i class="icon-printer"></i> Print invoice</a></li>
                                    <li><a href="#"><i class="icon-file-download"></i> Download invoice</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#"><i class="icon-file-plus"></i> Edit invoice</a></li>
                                    <li><a href="#"><i class="icon-cross2"></i> Remove invoice</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="accordion">
        <h2><a href="#">Detalhes</a></h2>
        <div class="inner">
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="endereco" class="control-label">Endereço</label>
                        {!! Form::input('text','endereco',null,
                        ['id' => 'endereco','class'=>'form-control form-control-danger','placeholder'=>'Endereço',
                        'required','data-error' => 'Informe o endereço.']) !!}
                        <small class="form-text text-muted">
                            <div class="help-block with-errors form-control-feedback"></div>
                        </small>
                    </div>
                </div>
                <div class="col-lg-1"></div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="bairro" class="control-label">Bairro</label>
                        {!! Form::input('text','bairro',null,
                        ['id' => 'bairro','class'=>'form-control bairro form-control-danger','placeholder'=>'Bairro',
                        'required','data-error' => 'Informe o bairro.']) !!}
                        <small class="form-text text-muted">
                            <div class="help-block with-errors form-control-feedback"></div>
                        </small>
                    </div>
                </div>
                <div class="col-lg-1"></div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="cep" class="control-label">CEP</label>
                        {!! Form::input('text','cep',null,
                        ['id' => 'cep','class'=>'form-control cep form-control-danger','placeholder'=>'CEP',
                        'required','data-error' => 'Informe o cep.']) !!}
                        <small class="form-text text-muted">
                            <div class="help-block with-errors form-control-feedback"></div>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection('content')

