@extends('panel::general.utils.base')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Resultado de Comando</h3>
                </div>
                <div class="box-body">
                    <div class="box-actions">
                        <a href="{{ URL::previous() }}" class="btn btn-default btn-xs"><i class="fa fa-arrow-left"></i> Voltar</a>
                    </div>
                    <div class="ui error small message"></div>

                    <div>
                        <h4>{{ $command }}</h4>
                        <pre class="hierarchy bring-up"><code class="language-bash" data-lang="bash">{{ !empty($result) ? $result : '' }}</code></pre>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection