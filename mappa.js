mapboxgl.accessToken = 'pk.eyJ1IjoiY2hyaXMwMjIyIiwiYSI6ImNsd2pkbjcwejB4MjIycW93ODI3OHpycm0ifQ.qMcavQiS8FCyErL2qQ66YA';
const map = new mapboxgl.Map({
  container: 'map',
  style: 'mapbox://styles/chris0222/clwjid54800tg01qs20rq0t9b',
  center: [12.4964, 42.9028], // Coordinate approssimative di Roma, Italia
  zoom: 5, // Puoi regolare lo zoom a tuo piacimento
});

map.on('click', (event) => {
  const features = map.queryRenderedFeatures(event.point, {
    layers: ['italia']
  });
  if (!features.length) {
    return;
  }
  const feature = features[0];

  const popup = new mapboxgl.Popup({ offset: [0, -15] })
    .setLngLat(feature.geometry.coordinates)
    .setHTML(
      `<h3>${feature.properties.title}</h3><p>${feature.properties.description}</p>`
    )
    .addTo(map);
});


map.on('load', () => {  
    const mapContainerEl = document.getElementById('map');  
    mapContainerEl.style.visibility = 'visible';  
});
