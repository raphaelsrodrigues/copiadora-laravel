@extends('layouts.master2')
@section('content')
<br>
<div class="text-center">
 
    <div class="statuscaixa">
        
        <h4>{!! isset($data) ? $data : null !!}</h4>
       <h4>{!! isset($situation) ? $situation : null !!}</h4>
       {!! isset($greeting) ? $greeting : null !!}
       <br>
       <br>
       
   <div style="font-size: 25px;">    {!! isset($status) ? $status : null !!}    </div>
       
        
    </div>
    
    <br><br>
        </div>
            
               <div class="container">
        <div class="row">
            <div class="col-md-8">
            
                  <h3>Despesas do dia</h3>
                
                 <table border="1" style="width:100%">
                      <thead align="left" style="display: table-header-group">
                      <tr>
                          <th>Descrição</th>
                         <th>Valor</th>
                      </tr>
                      </thead>
                    <tbody>
                        
                <?php
                foreach ($custos as $custo) {
                    
                echo "<tr class='item_row'>";
                
                echo "<td> ".$custo->Description." </td>
                <td><p>R$ ".$custo->Value." </p></td>"; }
                ?>
                
                </tbody>
                </table>
                
                <br>
                
                        
        <h4>Incluir Despesa</h4>
            
            <input type="text" name="newcost" id="newcost" placeholder="Novo Custo" required>
            <input type="text" name="newvalue" id="newvalue" placeholder="Valor" required>
            <input type="submit" name="add" class="add" id="add" value="Adicionar">
            
            <br><br>
            
             {!! isset($resultado) ? $resultado : null !!}
            
                </div>
            
            <div class="col-md-4">

       
  </div>
            
        </div>
    </div>
    
    
    <script>
$( 'input#add' ).click(function() {
    var custo = $('input#newcost').val();
    var value = $('input#newvalue').val();
    $.ajax({
        url : '{{("/custos")}}',
        type: "POST",
        data: {custo : custo,
                value : value,
            '_token': '{!! csrf_token() !!}'},
        success:function (result) {
            window.location.reload(true);
            }
            });
            });
</script>       
  

@endsection
