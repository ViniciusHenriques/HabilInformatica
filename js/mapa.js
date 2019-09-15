function myMap() {
            var mapCanvas = document.getElementById("map");
            var myCenter= new google.maps.LatLng(-29.904246,-51.16669);


            var mapOptions = {center: myCenter, zoom: 15};
            var map = new google.maps.Map(mapCanvas, mapOptions);

            habil(map, myCenter); 

          }

          function habil(map, location) {
            var marker = new google.maps.Marker({
              position: location,
              map: map,
              icon:'img/marcador-obra.png'
            });
            var infowindow = new google.maps.InfoWindow({
              content: 'Hábil' 
            });
            
          }
          
            
  


        
      