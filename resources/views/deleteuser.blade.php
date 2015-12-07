@extends('layouts.master')
@section('content')


 <p>
     Are you sure that you want to delete {{$name}}
 </p>
 
 <form action="/excluir" method="post">
 <div>
     <input type="hidden" name="id" value="<?php echo "This"; ?>" />
     <input type="submit" name="del" value="Yes" />
     <input type="submit" name="del" value="No" />
     <input type="hidden" name="_token" value="{{ csrf_token() }}">
 </div>
 </form>

        
        
@endsection