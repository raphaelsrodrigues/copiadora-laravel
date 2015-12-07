@extends('layouts.master')
@section('content')

<form action="/editar" method="post" enctype="multipart/form-data">
            
            <input type="text" name="newuser" placeholder="Novo Acesso" required>
            <input type="text" name="newpass" placeholder="Senha" required>
            <input type="submit" name="login" class="login login-submit" value="Adicionar">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            
        </form>
        
@endsection