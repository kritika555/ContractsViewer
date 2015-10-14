<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Contracts Viewer</title>
	 <script type="text/javascript" src="<?php echo base_url()?>/assets/js/jquery-easyui-1.4.3/jquery.min.js"></script>
	 <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/assets/css/style.css">
</head>
<body>

<div id="container">
	<h1>Contracts viewer</h1>	
		<div id="bbb">
		<?php		
		$file = fopen(APPPATH.'contracts.csv', 'r');
		while (($line = fgetcsv($file)) !== FALSE) { 
			$a = "'".$line[0]."'";
			$b = "'".$line[12]."'";
			?>	  		
	  		<a href ="javascript:jsclick(<?php echo $a;?>,<?php echo $b; ?>)" > <?php print_r($line[0]); ?></a>
	  		<?php echo '</br>'; 
		}
			fclose($file);
		?>
		</div>		
	<div id ='aaa'>
	</div>
	<div id = 'mapdiv'>
	</div>
</div>
</body>
</html>
<script>
     base_url = "<?php echo base_url();?>";
     //console.log(base_url);
	function jsclick(name,latlon) {		
		showPosition(latlon);
		$.post(base_url+'contract/give_info',{name:name},function(result) {           	
        	var arr = result.values;
        	var out =  "<table><tr><td>name:</td><td>"+ arr[0]+"</td></tr>"; 
        	out+=   "<tr><td>status:</td><td>"+ arr[1]+"</td></tr>" ; 
        	out+=   "<tr><td>bidPuchaseDeadline:</td><td>"+ arr[2]+"</td></tr>" ;
        	out+=   "<tr><td>bid submission deadline:</td><td>"+ arr[3]+"</td></tr>" ;    	
        	out+=   "<tr><td>bid Opening date:</td><td>"+ arr[4]+"</td></tr>" ;  	
        	out+=   "<tr><td>tender id:</td><td>"+ arr[5]+"</td></tr>" ;  	
        	
        	out+=   "<tr><td>publication Date:</td><td>"+ arr[6]+"</td></tr>" ;  	
        	out+=   "<tr><td>publishedIn:</td><td>"+ arr[7]+"</td></tr>" ;  	
        	out+=   "<tr><td>contract Date:</td><td>"+ arr[8]+"</td></tr>" ;  	
        	out+=   "<tr><td>completiondate:</td><td>"+ arr[9]+"</td></tr>" ;  	
        	out+=   "<tr><td>awardee:</td><td>"+ arr[10]+"</td></tr>" ;  	
        		
        	out+=   "<tr><td>awardee location:</td><td>"+ arr[11]+"</td></tr>" ;  	
        	out+=   "<tr><td>latlon:</td><td>"+ arr[12]+"</td></tr>" ; 
        	out+=   "<tr><td>amount:</td><td>"+ arr[13]+"</td></tr>" ;   		

        	out+="</table>"
        	document.getElementById("aaa").innerHTML = "";
			var div = document.getElementById('aaa');
			div.innerHTML = div.innerHTML + out;                  
            },'json');
	}	

	function showPosition(position) {		    
		    var array = position.split(',');
		    var lat = array[0];
		    var lon = array[1];
    		var googlePos = new google.maps.LatLng(lat,lon);
            var center =new google.maps.LatLng(27.700769, 85.300140);
    		var mapOptions = {
    			zoom : 6,
    			center : center,
    			mapTypeId : google.maps.MapTypeId.ROADMAP
    		};
    		var mapObj = document.getElementById('mapdiv');
    		var googleMap = new google.maps.Map(mapObj, mapOptions);
    		var markerOpt = {
    			map : googleMap,
    			position : googlePos,
    			title : 'Hi , I am here',
    			animation : google.maps.Animation.DROP
    		};
    		var googleMarker = new google.maps.Marker(markerOpt);
    		var geocoder = new google.maps.Geocoder();
    		geocoder.geocode({
    			'latLng' : googlePos
    			}, function(results, status) {
    				if (status == google.maps.GeocoderStatus.OK) {
    				if (results[1]) {
    					var popOpts = {
    						content : results[1].formatted_address,
    						position : googlePos
    					};
    				var popup = new google.maps.InfoWindow(popOpts);
    				google.maps.event.addListener(googleMarker, 'click', function() {
    				popup.open(googleMap);
    			});
    				} else {
    					alert('No results found');
    				}
    				} else {
    					//alert('Geocoder failed due to: ' + status);
    				}
    			});
    	}

	
</script>