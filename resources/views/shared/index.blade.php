@extends('template.template')
@section('content')

    @include('shared.create')
    <div class="table-responsive text-center">
        <table class="table table-borderless" id="table">
            <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Descrição</th>
                <th class="text-center">Ações</th>
            </tr>
            </thead>
            @foreach($data as $item)
                <tr class="item{{$item->id}}">
                    <td>{{$item->id}}</td>
                    <td>{{$item->descricao}}</td>
                    <td>
                        <button class="edit-modal btn btn-info" data-id="{{$item->id}}"
                                data-name="{{$item->descricao}}">
                            <span class=""></span> Edit
                        </button>
                        <button class="delete-modal btn btn-danger" data-id="{{$item->id}}"
                                data-name="{{$item->descricao}}">
                            <span class=""></span> Delete
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    {{ csrf_field() }}
    @include('shared.modal')

@endsection('content')

@push('scripts')
  <script>
      $("#add").click(function () {
          $.ajax({
              type: 'post',
              url: '/addItem',
              data: {
                  '_token': $('input[name=_token]').val(),
                  'descricao': $('input[name=descricao]').val()
              },
              success: function (data) {
                  if ((data.errors)) {
                      $('.error').removeClass('hidden');
                      $('.error').text(data.errors.name);
                  } else {
                      $('.error').remove();
                      $('#table').append("<tr class='item" + data.id + "'>" +
                          "<td>" + data.id + "</td" +
                          "><td>" + data.descricao + "</td>" +
                          "<td>" +
                          "<button class='edit-modal btn btn-info' data-id='" + data.id + "' data-name='" + data.descricao + "'>" +
                          "<span class='pe-7s-note'>" +
                          "</span> Edit</button>" +
                          "<button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-name='" + data.descricao + "'>" +
                          "<span class='pe-7s-note'>" +
                          "</span> Delete</button>" +
                          "</td>" +
                          "</tr>");
                  }
              },
          });
          $('#name').val('');
      });

      $(document).on('click', '.delete-modal', function() {
          $('#footer_action_delete').text("Excluir");
          $('#footer_action_delete').addClass('btn btn-danger');
          $('.actionBtn').addClass('delete');
          $('.modal-title').text('Exclusão de Centros de Custo');
          $('.did').val($(this).data('id'));
          $('.deleteContent').show();
          $('.form-horizontal').hide();
          $('.dname').html($(this).data('name'));
          $('#myModalDelete').modal('show');

      });
      $('.modal-footer').on('click', '.delete', function() {
          $.ajax({
              type: 'post',
              url: '/deleteItem',
              data: {
                  '_token': $('input[name=_token]').val(),
                  'id': $('.did').val()
              },
              success: function(data) {
                  $('.item' + $('.did').val()).remove();
              }
          });
      });

      $(document).on('click', '.edit-modal', function () {
          $('#footer_action_edit').text("Editar");
          $('#footer_action_edit').addClass('btn btn-info');
          $('.actionBtn').addClass('edit');
          $('.modal-title').text('Edição de Centros de Custos');
          $('.deleteContent').hide();
          $('.form-horizontal').show();
          $('#fid').val($(this).data('id'));
          $('#n').val($(this).data('name'));
          $('#myModalEdit').modal('show');
      });

      $('.modal-footer').on('click', '.edit', function () {

          $.ajax({
              type: 'post',
              url: '/editItem',
              data: {
                  '_token': $('input[name=_token]').val(),
                  'id': $("#fid").val(),
                  'descricao': $('#n').val()
              },
              success: function (data) {
                  $('.item' + data.id).
                  replaceWith("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.descricao + "</td>" +
                      "<td><button class='edit-modal btn btn-info' data-id='" + data.id + "' data-name='" + data.descricao + "'>" +
                      "<span class='pe-7s-note'></span> Edit</button>" +
                      " <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-name='" + data.descricao + "' >" +
                      "<span class='pe-7s-note'></span> Delete</button></td></tr>");
              }
          });
      });
  </script>
@endpush