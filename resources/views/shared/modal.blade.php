<div id="myModalEdit" class="modal fade" data-backdrop="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Titulo</h5>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>ID</label>
                                <input type="text" id="fid" placeholder="ID" class="form-control">
                            </div>

                            <div class="col-sm-6">
                                <label>Descrição</label>
                                <input type="text" id="n" placeholder="Descrição" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>

                <div class="actionBtn" data-dismiss="modal" id="footer_action_edit"></div>
            </div>
        </div>
    </div>
</div>


<div id="myModalDelete" class="modal fade" data-backdrop="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Titulo</h5>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <h3>Você está prestes a excluir</h3>
                                <h2 class="dname"></h2>
                                <h2>Deseja continuar?</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>

                <div class="actionBtn did" data-dismiss="modal" id="footer_action_delete"></div>
            </div>
        </div>
    </div>
</div>
