<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Calculadora Melhor Envio</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>

        <div class="container p-5">

            @yield('content')

        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript" src="{{ URL::asset('js/jquery.mask.js') }}"></script>
        <script type="text/javascript">

            function fillQuotation(element) {
                $("#from_cep").val($(element).find(':selected').data('from-cep')).trigger('input');
                $("#to_cep").val($(element).find(':selected').data('to-cep')).trigger('input');
                $("#height").val($(element).find(':selected').data('height'));
                $("#width").val($(element).find(':selected').data('width'));
                $("#length").val($(element).find(':selected').data('length'));
                $("#weight").val($(element).find(':selected').data('weight'));
                $("#value").val($(element).find(':selected').data('value')).trigger('input');
                $(element).find(':selected').data('ar') ? $("#ar").prop('checked',true) : $("#ar").prop('checked',false);
                $(element).find(':selected').data('mp') ? $("#mp").prop('checked',true) : $("#mp").prop('checked',false);

            }
        </script>

    </body>
</html>