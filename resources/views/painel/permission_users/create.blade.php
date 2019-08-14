@extends('template.template')
@section('content')
@section('page_title')
    <h2>
        Permissões do usuário
    </h2>
@endsection

@section('footer_scripts')
    <script type="text/javascript">
        $(function(){
            $(".permissao_check").on('change', function(e){
                var permissao = e.target.value;
                var checado = e.target.checked;

                $.ajax({
                    type: 'PUT',
                    data: { permission: permissao, can: checado },
                    success: function (response) {
                        console.log(response);
                    }
                });
            })
        })
    </script>
@endsection
@section('content')
        {{ Html::ul($errors->all()) }}

        {{ Form::open(array('method' => 'PUT')) }}

            @forelse($allPermissions as $label => $permissions)
                {{ $label }}

                @foreach($permissions as $permission)
                    <label style="display: block;">
                        <input type="checkbox" name="permissions[{{ $permission->name }}]" class="permissao_check"
                               @if($permissionsUser->contains($permission->name)) checked @endif value="{{ $permission->name }}"> {{ $permission->label }}
                    </label>
                @endforeach
            @empty
                Nenhuma permissão encontrada
            @endforelse

        {{ Form::close() }}
@endsection
