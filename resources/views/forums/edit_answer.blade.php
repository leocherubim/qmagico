<div class="modal fade" id="editModal-@{{answer.id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="exampleModalLabel">Editar Resposta</h4>
        </div>
        <div class="modal-body">
          <form enctype="multipart/form-data">
            <div class="form-group">
              <label for="message-text" class="form-control-label">Resposta:</label>
              <textarea class="form-control" ng-model="answer.title" id="message-text"></textarea>
            </div>
           
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" ng-click="update(answer)" data-dismiss="modal" class="btn btn-primary">Editar Resposta</button>
        </div>
      </div>
    </div>
  </div>