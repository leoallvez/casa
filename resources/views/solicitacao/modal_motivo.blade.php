<div class="modal fade" id="myModalHorizontal" tabindex="-1" role="dialog" 
    aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <button type="button" class="close" 
          data-dismiss="modal">
          <span aria-hidden="true">&times;</span>
          <span class="sr-only">Fechar</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">
          Informar o Motivo da Reprovação da Solicitação
        </h4>
      </div>
        {!! 
          Form::model($instituicao, 
            [
              'method' => 'DELETE', 
              'action' => ['SolicitaCadastroController@reprovar', $instituicao->id]
            ]) 
        !!}
          <div class="modal-body">
            <div class="form-group">
              <row>
                <div class="col-dm-12">
                  {{ Form::textarea(
                    'motivo_reprovacao', 
                    null,
                    [
                      'placeholder' => 'Por favor informe o motivo da Instituição ser reprovada.',
                      'class'       => 'form-control'
                    ]) 
                  }}
                </div>
              </row>
            </div>
        </div>
          <!-- Modal Footer -->
          <div class="modal-footer">
            
            <button type="button" class="btn btn-primary" data-dismiss="modal">
              Fechar
            </button>
            {!! Form::submit(
                'Reprovar', 
                ['class' =>  'btn btn btn-danger']
              ) 
            !!}
          </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>