@extends('template.template')

@section('content')
    <h3>Envios disponíveis</h3>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Transportadora</th>
                <th scope="col">Modalidade</th>
                <th scope="col">Prazo</th>
                <th scope="col">Economia</th>
                <th scope="col">Preço</th>
            </tr>
        </thead>
        <tbody>
            @foreach($response as $item)
                @if( !isset($item->error))
                    <tr>
                        <th scope="row"><img src="{{ $item->company->picture }}" alt="{{ $item->company->name }}" style="width: 120px;"></th>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->delivery_range->min or '' }} - {{ $item->delivery_range->max or '' }} dias úteis</td>
                        <td>{{ $item->currency }}{{ number_format($item->discount, 2, ',', '.') }}</td>
                        <td>{{ $item->currency }}{{ number_format($item->price, 2, ',', '.') }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('calculator') }}" class="btn btn-primary" >Calcular outro</a>
@endsection