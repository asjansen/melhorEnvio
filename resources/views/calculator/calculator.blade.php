@extends('template.template')

@section('content')

    <h2>Calculadora de fretes Melhor Envio</h2>

    @if(isset($errors) && count($errors) > 0)
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <h4>Últimas cotações</h4>

    <select name="last_quotations" id="last_quotations" onchange="fillQuotation(this)" class="form-control my-3">
        <option value="">Selecione</option>
        @foreach($last_quotations as $lc)
            <option
                    value="{{ $lc->id }}"
                    data-from-cep="{{ $lc->from_cep }}"
                    data-to-cep="{{ $lc->to_cep }}"
                    data-height="{{ $lc->height }}"
                    data-width="{{ $lc->width }}"
                    data-length="{{ $lc->length }}"
                    data-weight="{{ $lc->weight }}"
                    data-value="{{ $lc->value }}"
                    data-ar="{{ $lc->ar }}"
                    data-mp="{{ $lc->mp }}"
            >
                CEP Origem: {{ $lc->from_cep }} |
                CEP Destino: {{ $lc->to_cep }} |
                Altura: {{ $lc->height }}cm |
                Largura: {{ $lc->width }}cm |
                Comprimento: {{ $lc->length }}cm |
                Peso: {{ $lc->weight }}kg |
                Valor: R${{ number_format($lc->price, 2, ',', '.') }} |
                AR: {{ ($lc->ar == 1) ? 'Sim' : 'Não' }} |
                MP: {{ ($lc->mp == 1) ? 'Sim' : 'Não' }}
            </option>
        @endforeach
    </select>

    <h4>Nova cotação</h4>

    <form onsubmit="cleanMask()" action="{{ route('result') }}" method="post">
        @csrf
        <div class="row my-3">
            <div class="form-group col-md-4 offset-2">
                <label for="from_cep">CEP Origem</label>
                <input type="text" id="from_cep" name="from_cep" class="form-control" data-mask="00.000-000" value="{{ old('from_cep') }}">
            </div>

            <div class="form-group col-md-4">
                <label for="to_cep">CEP Destino</label>
                <input type="text" id="to_cep" name="to_cep" class="form-control" data-mask="00.000-000" value="{{ old('to_cep') }}">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="">Altura(cm)</label>
                <input type="text" class="form-control" name="height" id="height" data-mask="999" maxlength="3" value="{{ old('height') }}">
            </div>
            <div class="form-group col-md-4">
                <label for="">Largura(cm)</label>
                <input type="text" class="form-control" name="width" id="width" data-mask="999" maxlength="3" value="{{ old('width') }}">
            </div>
            <div class="form-group col-md-4">
                <label for="">Comprimento(cm)</label>
                <input type="text" class="form-control" name="length" id="length" data-mask="999" maxlength="3" value="{{ old('length') }}">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-3 offset-3">
                <label for="weight">Peso(kg)</label>
                <input type="text" id="weight" name="weight" class="form-control" value="{{ old('weight') }}">
            </div>

            <div class="form-group col-md-3">
                <label for="value">Valor Segurado</label>
                <input type="text" id="value" name="value" class="form-control" data-mask="000.000.000.000.000,00" data-mask-reverse="true" value="{{ old('value') }}">
            </div>
        </div>
        <div class="row">
            <div class="custom-control custom-checkbox col-md-3 offset-3 pl-5">
                <input type="checkbox" class="custom-control-input" id="ar" name="ar" value="1">
                <label class="custom-control-label" for="ar">Aviso de recebimento</label>
            </div>

            <div class="custom-control custom-checkbox col-md-3 pl-5">
                <input type="checkbox" class="custom-control-input" id="mp" name="mp" value="1">
                <label class="custom-control-label" for="mp">Mão própria</label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 offset-5 mt-5">
                <input class="btn btn-primary" type="submit" value="Calcular">
            </div>
        </div>

    </form>

@endsection
