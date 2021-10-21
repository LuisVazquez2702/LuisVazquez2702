@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Bienvenido!') ,
        'description' => __('Esta es tu página de perfil. Puede ver los datos almacenados y modificarlos.'),
        'class' => 'col-lg-7'
    ])   
    <div>
        <profile-component/>
        @include('layouts.footers.auth')
    </div>


@endsection
