@extends('layouts.master')

@section('content')

<script type="text/javascript">
  function initialize() {
    var mapCanvas = document.getElementById('map-canvas');
    var mapOptions = {
      center: new google.maps.LatLng(-16.7224000,-43.8656600),
      zoom: 18,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    var map = new google.maps.Map(mapCanvas, mapOptions);
    
    
    // Creating a marker and positioning it on the map  
    var marker = new google.maps.Marker({  
      position: new google.maps.LatLng(-16.7223000,-43.8656600),  
      map: map  
    });
    
  }
  google.maps.event.addDomListener(window, 'load', initialize);
</script>



<body onload="initialize()">



	<div class="login_main">
	<div class="effect">
		
	<table width="100%">
		
	<tr>
		<td width= "70%"><div style="padding: 0px; display: block; margin-left: auto; margin-right: auto" id="map-canvas"></div></td>
		
		<td width= "30%"><h2>Copiadora Montes Claros</h2>
<p>Rua Coronel Altino de Freitas, 399<br>
Montes Claros - MG, 39400-023, Brazil<br>
(38) 3221-0798</p></td>
	
	</tr>

</table>
	
 </div>
   </div>

@endsection