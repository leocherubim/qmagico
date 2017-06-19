<div class="modal fade" id="postModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="exampleModalLabel">New message</h4>
        </div>
        <div class="modal-body">
          <form enctype="multipart/form-data">
            <div class="form-group">
              <label for="recipient-name" class="form-control-label">Título:</label>
              <input type="text" ng-model="postagem.titulo" class="form-control" id="recipient-name">
            </div>
            <div class="form-group">
              <label for="message-text" class="form-control-label">Mensagem:</label>
              <textarea class="form-control" ng-model="postagem.comentario" id="message-text"></textarea>
            </div>
           
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" ng-click="insere(postagem, {{1}})" data-dismiss="modal" class="btn btn-primary">Criar Postagem</button>
        </div>
      </div>
    </div>
  </div>