function initialize() {
	var latlng = new google.maps.LatLng(34.705776,135.460684);
	var opts = {
		zoom: 16,
		center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	var map = new google.maps.Map(document.getElementById("map_canvas"), opts);
	var m_latlng1 = new google.maps.LatLng(34.706905,135.462926);
	var marker1 = new google.maps.Marker({
	position: m_latlng1,
	map: map
	});
}