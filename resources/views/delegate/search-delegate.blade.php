@extends("layouts.app")
@section('content')

<div class="container">
        <form>
            <div class="mb-3">
                <label for="names" class="form-label">Nombres de Delegados</label>
                <input 
                    class="form-control" 
                    id="names" 
                    type="text"
                    placeholder="JORGE CAMPOS"
                    wire:model="searchTerm"
                >
                {{-- <div id="namesHelp" class="form-text">Error en nombre</div> --}}
            </div>
        </form>

        <table class="table table-dark table-hover">
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
                @foreach($delegates as $delegate)
                    <tr>
                        <td> {{ $delegate->p_lastname }} </td>
                        <td> {{ $delegate->m_lastname }} </td>
                        <td> {{ $delegate->names }} </td>
                        <td> {{ $delegate->ci }} </td>
                        <td> {{ $delegate->d_birth }} </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-4">
            {{ $delegates->links() }}
        </div>
    </div>
@endsection
