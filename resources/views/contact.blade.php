@extends('layouts.master')

@section('content')
	
	<div class="login_main">
		
	<div class="effect">
		
	<table width="100%">
		
	<tr>
		<td width= "100%">
	<p><strong>Telefones:</strong> (38) 3221-0798 / (38) 3213-5080</p>
	<p><strong>Fax:</strong> (38) 3213-5080</p>
		</td>
		</tr>
		
		<tr>	
		<td>
		<div style="padding: 0px; display: block; margin-left: auto; margin-right: auto">
		<h4><strong>Prezado cliente, caso possua algum arquivo que deseja: </strong></h4>
		
		 <?php
        $things = array("Imprimir", "Plastificar", "Encadernar");
        foreach ($things as $thing) {
            echo "<li>$thing</li>";}
		?>
		<br>
	<strong>Nos envie por e-mail e entre em contato por telefone.</p></strong>
	<br>
	<br>
	
	<p><strong>E-mail:</strong> copiadoramoc@hotmail.com</p>
		
		</div>
		</td>
		
		</tr>
		</table>
		</div>
		</div>

@endsection
