<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Acessos;
use App\Models\ControleCaixa;
use App\Models\Calendar;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CopiadoraController extends Controller
{
    
      /**
     * Returns Calendar, all Users and last 5 days rows of ControleCaixa table.
     *
     * @return Response
     */
    public function administrador()
    {
        
        //The administrador view 
        
    //Get all users
    $acessos = Acessos::all();
    
    //Get last 5 rows.
    $controles = ControleCaixa::orderBy('IDda', 'desc')->take(5)->get();
    
    //Create calendar
    $calendar = new Calendar();

        return view('administrador',
        ['acessos' => $acessos,
        'controles' => $controles,
        'calendar' => $calendar]);
   
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('copiadora');
        
    }
    
     /**
     * Show contact view.
     *
     * @return Response
     */
    public function contact()
    {
       return view('contact');
    }
    
    /**
     * Show address view.
     *
     * @return Response
     */
    public function address()
    {
       return view('address');
    }
    
     /**
     * Show acesso view.
     *
     * @return Response
     */
    public function acesso() {
            
        session_start();
        
        if (isset($_POST['user']) && isset($_POST['pass'])){
                
            $myusername=$_REQUEST['user'];
            $mypassword=$_REQUEST['pass'];
            
            $users = DB::select("SELECT * FROM Acesso WHERE Nome='$myusername' and Senha='$mypassword'");
            
            if(count($users)===1){
                
                $hr = date(" H ");
                if($hr >= 12 && $hr<18) {
                $resp = "Boa tarde";}
                else if ($hr >= 0 && $hr <12 ){
                $resp = "Bom dia";}
                else {
                $resp = "Boa noite";}
                    
                    $checkdate = DB::select('SELECT * FROM ControleCaixa WHERE Data="'.$this->diadehoje().'"');
            
            if(count($checkdate)===1){
    
        return $this->status();
            
            } else {
                
                $checkdate = DB::select('INSERT INTO ControleCaixa (Data)
                VALUES ("'.$this->diadehoje().'")');
        
                return $this->status();
            }
                            
            } else {
                                    
                return view('acesso', ['situation' =>'Dados de Acesso incorretos.']);
            }
        } else {
      
            return view('acesso'); 
}
    }
    
    
    /**
     * Show day status.
     *
     * @return Response
     */
    public function status()
    {
        
         $hr = date(" H ");
         if($hr >= 12 && $hr<18) {
         $resp = "Boa tarde";
             
         } else if ($hr >= 0 && $hr <12 ) {
         $resp = "Bom dia";
         
         } else {
         $resp = "Boa noite";}
         
    
    $checkdate = DB::select('SELECT * FROM ControleCaixa WHERE Data="'.$this->diadehoje().'" AND StatusEntrada=0 AND StatusSaida=0');
            
            if(count($checkdate)===1){
        
        $status = '
        <table align="center">
        <tr>
        <td>
            <div class="abertura">
                <p><font color="#ff0000">Abertura do Caixa Pendente</font><br>
                    <a href="http://quickstart.local/inserirentrada">Executar Abertura</a></p>
            </div>
        </td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td>
            <div class="fechamento">
                <p><font color="#ff0000">Fechamento do Caixa Pendente</font><br>
                    <a href="http://quickstart.local/inserirsaida">Executar Fechamento</a></p>
            </div>
        </td>
        </tr>
        </table> ';
            
            } else {
                
     $checkdate = DB::select('SELECT * FROM ControleCaixa WHERE Data="'.$this->diadehoje().'" AND StatusEntrada=1 AND StatusSaida=0');
               
        if(count($checkdate)===1){
            
             $status = '
            
        <table align="center">
        <tr>
        <td>
            <div class="abertura">
                <p><font color="#33CC33">Abertura do Caixa Executada</font><br>Obrigado</p>
            </div>
        </td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td>
            <div class="fechamento">
                <p><font color="#ff0000">Fechamento do Caixa Pendente</font><br>
                    <a href="http://quickstart.local/inserirsaida">Executar Fechamento</a></p>
            </div>
        </td>
        </tr>
        </table> ';
        
       
} else {
        
        $checkdate = DB::select('SELECT * FROM ControleCaixa WHERE Data="'.$this->diadehoje().'" AND StatusEntrada=1 AND StatusSaida=1');
               
        if(count($checkdate)===1){
            
             $status = '
             
             <table align="center">
        <tr>
        <td>
            <div class="abertura">
                <p><font color="#33CC33">Abertura do Caixa Executada</font><br>Obrigado</p>
            </div>
        </td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td>
            <div class="fechamento">
                <p><font color="#33CC33">Fechamento do Caixa Executado</font><br>Obrigado</p>
            </div>
        </td>
        </tr>
        </table> ';
        
        

} else {
        
        $checkdate = DB::select('SELECT * FROM ControleCaixa WHERE Data="'.$this->diadehoje().'" AND StatusEntrada=0 AND StatusSaida=1');
               
        if(count($checkdate)===1){
            
             $status = '
        
        <table align="center">
        <tr>
        <td>
            <div class="abertura">
                <p><font color="#ff0000">Abertura do Caixa Bloqueada</font><br></p>
            </div>
        </td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td>
            <div class="fechamento">
                <p><font color="#33CC33">Fechamento do Caixa Executado</font><br>Obrigado</p>
            </div>
        </td>
        </tr>
        </table> ';
        
        }}}}


         if (isset($_POST['user'])){
             
              $myusername=$_REQUEST['user'];
             
             if($_POST['user'] === "Cida") {
                
            $bom = '<a href="http://quickstart.local/administrador">Clique aqui para Analisar Tabelas</a>';
            return view('status',
            
            ['situation' => $resp. ' ' .$myusername. ',',
             'bom' => $bom,
             'status' => $status]);
            
            } else {
                
        $bom = $this->diadehoje();
        return view('status',
            
            ['situation' => $resp. ' ' .$myusername. ',',
             'bom' => $bom,
             'status' => $status]);
             }
} else {
        return view('status', ['status' => $status]);  
}

}
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function inserirentrada()
    {
    
    $checkdate = DB::select('SELECT * FROM ControleCaixa WHERE Data="'.$this->diadehoje().'" AND StatusEntrada=0');
            
            if(count($checkdate)===1){

date_default_timezone_set("Brazil/East");

if (isset($_POST['user1']) && isset($_POST['pass1']) && isset($_POST['valorentrada'])){
$user1 = $_REQUEST['user1'];
$pass1 = $_REQUEST['pass1'];
$user2 = $_REQUEST['user2'];
$pass2 = $_REQUEST['pass2'];
$valorentrada = $_REQUEST['valorentrada'];
$horas = date("h:i:sa");
    
     $sql = DB::select('SELECT * FROM Acesso WHERE Nome="'.$user1.'" AND Senha="'.$pass1.'"');
            
            if(count($sql)===1){    
                
     $sql = DB::select('SELECT * FROM Acesso WHERE Nome="'.$user2.'" AND Senha="'.$pass2.'"');
    
            if(count($sql)===1){

     $sql = DB::select('UPDATE ControleCaixa SET Entrada1="'.$user1.'", Entrada2="'.$user2.'", ValorEntrada="'.$valorentrada.'", timeEntrada="'.$horas.'", StatusEntrada = "1" WHERE Data ="'.$this->diadehoje().'"');
             
                    return redirect('/status');
                
            }  else {
                    
                echo "Nome2 ou Senha2 de Acesso Incorretos.";
            return view('inserirentrada'); }

            } else {
                    
                echo "Nome1 ou Senha1 de Acesso Incorretos.";
            return view('inserirentrada'); }        
        
    } else {

return view('inserirentrada'); }
    
    } else {
    
    $mensagem = "O Caixa ja foi aberto hoje. Até a próxima!";
    
    return view('errors',
        ['mensagem' => $mensagem]);
    
    
}

    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function inserirsaida()
    {
     
    $checkdate = DB::select('SELECT * FROM ControleCaixa WHERE Data="'.$this->diadehoje().'" AND StatusSaida=0');
            
            if(count($checkdate)===1){

date_default_timezone_set("Brazil/East");

if (isset($_POST['user1']) && isset($_POST['pass1']) && isset($_POST['valorsaida'])){
$user1 = $_REQUEST['user1'];
$pass1 = $_REQUEST['pass1'];
$user2 = $_REQUEST['user2'];
$pass2 = $_REQUEST['pass2'];
$valorsaida = $_REQUEST['valorsaida'];
$horas = date("h:i:sa");
    
     $sql = DB::select('SELECT * FROM Acesso WHERE Nome="'.$user1.'" AND Senha="'.$pass1.'"');
            
            if(count($sql)===1){    
                
     $sql = DB::select('SELECT * FROM Acesso WHERE Nome="'.$user2.'" AND Senha="'.$pass2.'"');
    
            if(count($sql)===1){

     $sql = DB::select('UPDATE ControleCaixa SET Saida1="'.$user1.'", Saida2="'.$user2.'", ValorSaida="'.$valorsaida.'", timeSaida="'.$horas.'", StatusSaida = "1" WHERE Data ="'.$this->diadehoje().'"');
             
                    return redirect('/status');
                
            }  else {
                    
                echo "Nome2 ou Senha2 de Acesso Incorretos.";
            return view('inserirsaida'); }

            } else {
                    
                echo "Nome1 ou Senha1 de Acesso Incorretos.";
            return view('inserirsaida'); }        
        
    } else {

return view('inserirsaida'); }

} else {
    
    $mensagem = "O Caixa ja foi fechado hoje. Até a próxima!";
    
    return view('errors',
        ['mensagem' => $mensagem]);
    
    
}

  }
    
/**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function viewday()
    {
       if (isset($_POST['name'])){
               
           $str= $_POST['name'];
            
            //$id = "li-19-10-2015";
            
            $dia = substr($str, 3, 2);  // returns "19"
            $mes = substr($str, 6, 2);  // returns "10"
            $ano = substr($str, 9, 4);  // returns "10"
            $dataid = $dia."/".$mes."/".$ano;
            
            $sql = DB::select('SELECT * FROM ControleCaixa WHERE Data="'.$dataid.'"');
    
            if(count($sql)===1){
            
                    
                $controle = ControleCaixa::where('Data', ''.$dataid.'')->first();           
                $dateID = $controle->IDda;
                $diatras = $dateID - 1;
                $yesterday = ControleCaixa::where('IDda', ''.$diatras.'')->first();
                

      $result =
      
      "<h3 align='center'>" .$controle->Data. "</h3>
      
<table border='1' style='width:100%'>
      
      <thead align='left' style='display: table-header-group'>
      <tr>
      <th style='width:40%'>Abertura</th>
      <th style='width:30%'>Valor</th>
      <th style='width:30%'>Horário</th>
      </tr>
      </thead>
      
      <tbody>
      <td>" .$controle->Entrada1. " / ".$controle->Entrada2. "</td> 
      <td><p>R$" .$controle->ValorEntrada. ",00*</p></td>
      <td>" .$controle->timeEntrada. "</td>
      </tbody>

</table>  

<br>

<table border='1' style='width:100%'>

    <thead align='left' style='display: table-header-group'>
    <tr>
    <th style='width:40%'>Fechamento</th>
    <th style='width:30%'>Valor</th>
    <th style='width:30%'>Horário</th>
    </tr>
    </thead>
    
    <tbody>
    <td>".$controle->Saida1. " / ".$controle->Saida2. " </td> 
    <td><p>R$".$controle->ValorSaida. ",00</p></td>
    <td>".$controle->timeSaida. "</td></tr> </tbody>

</table>
<br><br>

<p>*Abertura do dia deve ser igual ao Fechamento do dia anterior </p>
<table border='1' style='width:100%'>
      
      <thead align='left' style='display: table-header-group'>
      <tr>
      <th style='width:40%'>Fechamento do dia anterior</th>
      <th style='width:30%'>Abertura do dia</th>
      <th style='width:30%'>Diferença</th>
      </tr>
      </thead>
      
      <tbody>
      
      
       <td>R$ ".$yesterday->ValorSaida.",00</td> 
      <td><p>R$ ".$controle->ValorEntrada.",00</p></td>
      <td style='color:red'>R$ ".abs($controle->ValorEntrada-$yesterday->ValorSaida).",00</td>
      </tbody>

</table>";
                 
                return $result;
                
            } else {
                
                $result = "<h3 align='center'>" .$dataid. "</h3>
                <br>
                <p>Não há dados para este dia. Sorry: (</p>";
                
                return $result;
            }
            }
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if (isset($_POST['newuser']) && isset($_POST['newpass'])){
                
            $newuser=$_REQUEST['newuser'];
            $newpass=$_REQUEST['newpass'];

        $user = new Acessos;
        
        $user->Nome = $newuser;
        
        $user->Senha = $newpass;
        
        $user->save();
        
        $resultado = "Novo acesso criado com sucesso";
        
       return redirect('/administrador');

    } else {
        
        return view('adduser');
    }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
   public function show($name)
{
    return view('hello',array('name' => $name));
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($name)
    {
       return view('edituser',array('name' => $name));
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($name)
    {
        $controles = Acessos::where('Nome', $name)->take(1)->delete();
        
        return redirect('/administrador');
     
    }
    
    public function errors($id)
    {
        return view('errors');
    }
    
    public function diadehoje()
    {
        
        $mes = date('M');
        $dia = date('d');
        $ano = date('Y');
                    
        $mes_extenso = array(
            'Jan' => '01',
            'Feb' => '02',
            'Mar' => '03',
            'Apr' => '04',
            'May' => '05',
            'Jun' => '06',
            'Jul' => '07',
            'Aug' => '08',
            'Nov' => '09',
            'Sep' => '10',
            'Oct' => '11',
            'Dec' => '12'
        );
        
        $data = $dia.'/'.$mes_extenso["$mes"].'/'.$ano;
                    
        return $data;
    }
    
}

