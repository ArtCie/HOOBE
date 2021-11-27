function initMap() {
    const krk = { lat: 50.071602, lng: 19.942113 };
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 17,
        center: krk,
        mapId: 'f5a8682e636f2b1d',
        fullscreenControl: false,
        zoomControl: false,
        mapTypeControl: false,
        scaleControl: false,
        streetViewControl: false
    });
    const marker = new google.maps.Marker({
        position: krk,
        map: map,
    });
}