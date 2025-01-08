@extends('layout')

@section('content')
    
    <section class="section">
        <div class="container">
            <h1 class="title">Panel de Administración</h1>
            <p>Bienvenido, administrador. Aquí puedes gestionar los recursos del sistema.</p>

            <table class="table">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Acción</th>
                        <th>Archivo</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($actions as $action)
                        <tr>
                            <td>{{ $action->user->name }}</td>
                            <td>{{ $action->action }}</td>
                            <td>{{ $action->file ? $action->file->name : 'NA'}}</td>
                            <td>{{ $action->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    
@endsection
