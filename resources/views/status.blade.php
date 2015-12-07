@extends('layouts.master')
@section('content')

 
    <div class="statuscaixa">
        
       {!! isset($situation) ? $situation : null !!}
       <br>
       {!! isset($bom) ? $bom : null !!}
       <br>
       {!! isset($status) ? $status : null !!}    
       
        
    </div>
@endsection