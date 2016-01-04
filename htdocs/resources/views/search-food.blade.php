@extends('layout.index')
<title>Ăn gì bây giờ</title>
@section('grid-layout')
    <script type="text/javascript">
    var map;
    var markers = [];
    var infoWindow;
    var locationSelect;

    function load() {
      map = new google.maps.Map(document.getElementById("search-map"), {
        center: new google.maps.LatLng(21.0287592,105.8501718),
        zoom: 14,
        mapTypeId: 'roadmap',
        mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU}
      });
      infoWindow = new google.maps.InfoWindow();
     
      locationSelect = document.getElementById("locationSelect");
      locationSelect.onchange = function() {
        var markerNum = locationSelect.options[locationSelect.selectedIndex].value;
        if (markerNum != "none"){
          google.maps.event.trigger(markers[markerNum], 'click');
        }
      };
   }

   function searchLocations() {
     navigator.geolocation.getCurrentPosition(searchLocationsNear);
   }

   function clearLocations() {
     infoWindow.close();
     for (var i = 0; i < markers.length; i++) {
       markers[i].setMap(null);
     }
     markers.length = 0;

     locationSelect.innerHTML = "";
     var option = document.createElement("option");
     option.value = "none";
     option.innerHTML = "See all results:";
     locationSelect.appendChild(option);
   }

   function searchLocationsNear(pos) {
     clearLocations();
     var mylatlng = new google.maps.LatLng(
      pos.coords.latitude, pos.coords.longitude);

     var pinColor = "2F76EE";
    var image = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + pinColor,
            new google.maps.Size(30, 42),
            new google.maps.Point(0,0),
            new google.maps.Point(10, 42));
  var infowindow = new google.maps.InfoWindow({
    content: "Vị trí của tôi"
  });
    // var image = {
    //   path: google.maps.SymbolPath.CIRCLE,
    //   scale: 10
    // }
      var marker = new google.maps.Marker({
        map: map,
        position: mylatlng,
        // title:"Vị trí của tôi",
        icon: image
      });
      infowindow.open(map, marker);

     // console.log("Lat " +pos.coords.longitude);
     // console.log("Long: " + pos.coords.latitude);
     var radius = document.getElementById('radiusSelect').value;
     var searchUrl = 'api/genxml?lat=' + pos.coords.latitude + '&lng=' + pos.coords.longitude + '&radius=' + radius;
     downloadUrl(searchUrl, function(data) {
       var xml = parseXml(data);
       var markerNodes = xml.documentElement.getElementsByTagName("marker");
       var bounds = new google.maps.LatLngBounds();
       for (var i = 0; i < markerNodes.length; i++) {
         var name = markerNodes[i].getAttribute("name");
         var address = markerNodes[i].getAttribute("address");
         var place_id = markerNodes[i].getAttribute("place_id");
         var distance = parseFloat(markerNodes[i].getAttribute("distance"));
         var latlng = new google.maps.LatLng(
              parseFloat(markerNodes[i].getAttribute("lat")),
              parseFloat(markerNodes[i].getAttribute("lng")));

         createOption(name, distance, i);
         createMarker(latlng, name, address,place_id);
         bounds.extend(latlng);
       }
       map.fitBounds(bounds);
       locationSelect.style.visibility = "visible";
       locationSelect.onchange = function() {
         var markerNum = locationSelect.options[locationSelect.selectedIndex].value;
         google.maps.event.trigger(markers[markerNum], 'click');
       };
      });
    }

    function createMarker(latlng, name, address, place_id) {
      var html = "<b>" + name + "</b> <br/>" + address;
      //var image = 'images/icon.png';
      var marker = new google.maps.Marker({
        map: map,
        position: latlng,
        id: place_id
      });
      google.maps.event.addListener(marker, 'mouseover', function() {
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
      });
      google.maps.event.addListener(marker, 'click', function() {
        console.log(marker.id);

        $.ajax({
          type: "POST",
          url: "{{url('/get-post')}}",
          cache:false,
          data: {place_id : marker.id},
          success: function(data){
            console.log(data);
            $(".grid-ajbh").empty();
            for (var i = 0; i < data.length; i++) {
              var photo_link ="{{URL::to('/api/photo/')}}"+"/"+data[i].photo_link;
              var avatar_link ="{{URL::to('/api/photo/')}}"+"/"+data[i].avatar_link;
              text = "<div class='wf-box' style='float: left;width: 30%;'><img src='"+photo_link+"' class='box-img' data-id='"+data[i]['post_id']+"'><div class='content'><h3 class='box-img-des'>"+data[i]['description']+"</h3><div class='box-img-card'><img src='"+avatar_link+"' width='30' height='30' class='logo-profile'><div><p class='card-owner'>"+data[i]['owner']+"</p><h4 class='card-title'>"+data[i]['board_title']+"</h4></div></div></div></div>";
              $(".grid-ajbh").append(text);
            }
          }
        });
      });
      markers.push(marker);
    }

    function createOption(name, distance, num) {
      var option = document.createElement("option");
      option.value = num;
      option.innerHTML = name + "(" + distance.toFixed(1) + ")";
      locationSelect.appendChild(option);
    }

    function downloadUrl(url, callback) {
      var request = window.ActiveXObject ?
          new ActiveXObject('Microsoft.XMLHTTP') :
          new XMLHttpRequest;

      request.onreadystatechange = function() {
        if (request.readyState == 4) {
          request.onreadystatechange = doNothing;
          callback(request.responseText, request.status);
        }
      };

      request.open('GET', url, true);
      request.send(null);
    }

    function parseXml(str) {
      if (window.ActiveXObject) {
        var doc = new ActiveXObject('Microsoft.XMLDOM');
        doc.loadXML(str);
        return doc;
      } else if (window.DOMParser) {
        return (new DOMParser).parseFromString(str, 'text/xml');
      }
    }

    function doNothing() {}

    $(document).ready(function(){
            load();
        });
    </script>
    
    <div class="search_post">
        <select id="radiusSelect">
          <option value="3" selected>3 Km</option>
          <option value="5">5 Km</option>
          <option value="7">7 Km</option>
        </select>

        <input type="button" onclick="searchLocations()" value="Search"/>
    </div>
    <div style="display:none;">
        <select id="locationSelect" style="width:100%;visibility:hidden"></select>
    </div>
    <div style="margin-top:23px; width: 100%; height: 350px" id="search-map">
    </div>
    <div class="container" style="width:100%;">
        <div class="col-xs-9 wf-container grid-ajbh" style="margin-top:40px;width:70%;background-color: #E9E9E9;">
 
        </div> 
        <div class="col-xs-3" style="margin-top:40px;width:30%;background-color: #E9E9E9;">
            <div class="ajbh-chude">Chủ đề</div>
            <ul class="list-group ajbh-list-chude">
                <li class="list-group-item chd1">Ăn với gia đình</li>
                <li class="list-group-item chd2">Ăn với nhóm</li>
                <li class="list-group-item chd3">Ăn vặt</li>
                <li class="list-group-item chd4">Hẹn hò</li>
                <li class="list-group-item chd5">Đồ nướng</li>
            </ul>
        </div>
    </div>
    <script type="text/javascript">
      $(document).ready(function(){
        var waterfall = new Waterfall({
          minBoxWidth: 250
        });
      });

      $('.chd1').on('click', function(){

      });
    </script>
@stop

