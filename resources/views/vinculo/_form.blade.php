<div class="row">
    <div class="col-md-12 form-group">
        {!! Form::label('adotante', 'Adotante') !!}
        {!! Form::text('adotante', $adotantes->nome, 
            [
                'class' => 'form-control myclass ', 
                'disabled'
            ]) 
        !!}
    </div>
</div>
@if($adotantes->hasConjuge())
    <div class="row">
        <div class="col-md-12 form-group">
            {!! Form::label('conjuge', 'Conjuge') !!}
            {!! Form::text('conjuge', $adotantes->conjuge_nome, 
                [
                    'class' => 'form-control myclass ', 
                    'disabled'
                ]) 
            !!}
        </div>
    </div>
@endif

<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            {!! Form::label('input-inicio', 'Data Inicial')!!}
            {!! Form::text('input-inicio', 
                date('d/m/Y',strtotime( $adotantes->pivot->created_at )) , 
                [   
                    'class'       => 'form-control', 
                    'data-mask'   => '99/99/9999',
                    'placeholder' => '00/00/0000',
                    'id'          => 'input-inicio',
                    'disabled'
                ]) 
            !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            {!! Form::label('input-final', 'Data Final')!!}
            {!! Form::text('input-final', 
                date('d/m/Y',strtotime( $adotantes->pivot->deleted_at )), 
                [   
                    'class'       => 'form-control', 
                    'data-mask'   => '99/99/9999',
                    'placeholder' => '00/00/0000',
                    'id'          => 'input-final',
                    'disabled'
                ]) 
            !!}
        </div>
    </div>
</div>
<div class="row"> 
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('input-observacao', 'Observação')!!}
            {!! Form::textarea('input-observacao', 
                $adotantes->observacoes(), 
                [   
                    'class' => 'form-control', 
                    "style" => 'background-color: #90CAF9; font-weight: bold; border: 1px solid #1976D2;',
                    'disabled'
                ]) 
            !!}
        </div>
    </div>
</div>

<div class="form-group">
    <a href="{{ route('listar', $adotivo->id) }}" class='btn btn-primary'>Voltar</a>
</div>