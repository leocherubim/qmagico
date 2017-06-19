<div class="modal fade" id="postModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="exampleModalLabel">Nova Pergunta</h4>
        </div>
        <div class="modal-body">
          <form enctype="multipart/form-data">
            <div class="form-group">
              <label for="message-text" class="form-control-label">Pergunta:</label>
              <textarea class="form-control" ng-model="question.title" id="message-text"></textarea>
            </div>
           
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" ng-click="store(question, {{$forum->id}}, {{Auth::user()->id}}, '{{Auth::user()->name}}')" data-dismiss="modal" class="btn btn-primary">Criar Postagem</button>
        </div>
      </div>
    </div>
  </div>