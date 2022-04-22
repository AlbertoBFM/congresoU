<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <style>
        *{
            font-family: Helvetica, sans-serif;
        }
        h1{
            font-size: 3rem;
            width: 100%;
            text-align: center;
        }
        h3{
            font-size: 2rem;
            width: 100%;
            text-align: left;
        }
        #emp{
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            text-align: center;
            width: 100%;
        }
        #emp td, #emp th{
            border:1px solid #ddd;
            padding: 8px;
        }
        #emp th{
            padding-top: 12px;
            padding-bottom: 12px;
            background-color: #233876;
            color:#fff;
        }
    </style>
</head>
<body>
<h1>{{ __("Delegados por Comisión") }}</h1>
@forelse($commissions as $commission)
    <h3>{{ $commission->name }}</h3>
    <!-- LISTA -->
    <table class="table">
        <thead>
            <tr>
                <th> {{ __("A. PATERNO") }} </th>
                <th> {{ __("A. MATERNO") }} </th>
                <th> {{ __("NOMBRES") }} </th>
                <th> {{ __("CI") }} </th>
                <th> {{ __("FECHA DE NACIMIENTO") }} </th>
            </tr>
        </thead>
        <tbody>
            @forelse($delegates as $delegate)
                @if( $delegate->commission_id == $commission->id )
                <tr>
                    <td> {{ $delegate->p_lastname }} </td>
                    <td> {{ $delegate->m_lastname }} </td>
                    <td> {{ $delegate->names }} </td>
                    <td> {{ $delegate->ci }} </td>
                    <td> {{ $delegate->d_birth }} </td>
                </tr>
                @endif
            @empty
                <tr>
                    <td>
                        {{ __("Ningun Delegado coincide") }}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
@empty 
    <h2>Ninguna Comisión Registrada</h2>
@endforelse           
</body>
</html>
