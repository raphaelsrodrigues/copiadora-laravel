@extends('layouts.master')
@section('content')

    <div class="container">
        
        <h2 align="center">Controle de Caixa Online</h2> <br>
        
        <div class="row">
            <div class="col-md-6">
                
                <?php $calendar->show(); ?>
                
            <br>
            <br>
            
            </div>
            
            <div class="col-md-6">
                
                <div id="yourdiv" align="center">
                    <br>
                    <h3>Clique no dia que deseja consultar.</h3>
                    <br>
                 </div>
                
                <br>
                <br>
                
                </div>
                
        </div>
    </div>
    
    <hr>
    
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                
                <h2>Dados de Acesso</h2>
                
                 <table border="1" style="width:100%">
                      <thead align="left" style="display: table-header-group">
                      <tr>
                          <th>Acesso</th>
                         <th>Senha</th>
                         <th>Excluir</th>
                      </tr>
                      </thead>
                    <tbody>
                
                <?php
                foreach ($acessos as $acesso) {
                    
                echo "<tr class='item_row'>";
                
                echo "<td> ".$acesso->Nome." </td>
                <td> ".$acesso->Senha." </td>   
                <td align='middle'><a href='http://quickstart.local/excluir/".$acesso->Nome."'>x</a>"; }
                ?>
                
                </tbody>
                </table>
                
                <br>
                <a href="http://quickstart.local/adicionar"><p>Adicionar Acesso (+)</p></a>
                
            </div>
            
            <div class="col-md-8">
                
                <h2>Últimos 5 dias</h2>
                
                <table border="1" style="width:100%">
                      <thead align="left" style="display: table-header-group">
                      <tr>
                          <th>Data</th>
                         <th><b><p style="color: green;">Abertura</p></b></th>
                         <th>Valor</th>
                         <th>Horário</th>
                         <th><b><p style="color: blue;">Fechamento</p></b></th>
                         <th>Valor</th>
                         <th>Horário</th>
                      </tr>
                      </thead>
                    <tbody>
                
                <?php

                foreach ($controles as $controle) {
                        
                        
                        echo "<tr class='item_row'>";
                        
                        echo "<td><b>" .$controle->Data. "</b></td> 
                       <td>".$controle->Entrada1. " / "
                            .$controle->Entrada2. " </td> 
                       <td><b><p style='color: green;'>R$".$controle->ValorEntrada. ",00</p></b></td>
                       <td>".$controle->timeEntrada. "</td>  
                       <td>".$controle->Saida1. "/
                           ".$controle->Saida2. " </td> 
                       <td><b><p style='color: blue;'>R$".$controle->ValorSaida. ",00</p></b></td>
                       <td>".$controle->timeSaida. "</td></tr>"; }
    
                 ?>
                 
</tbody>
</table>
                 
            </div>
            
        </div>
    </div>
    
    <hr>



        
                    
<script>
$( "li" ).click(function() {
    var date = $(this).attr("id");
    $.ajax({
        url : '{{("/administrador/check")}}',
        type: "POST",
        data: {name : date,
            '_token': '{!! csrf_token() !!}'},
        success:function (result) {
            $("#yourdiv").html(result);
            }
            });
            });
</script>            

@endsection