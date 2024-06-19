mapboxgl.accessToken = 'pk.eyJ1IjoidG9ueWNtZiIsImEiOiJjbGdvMnAwNDkwbGxvM3RsdTFlajJkbWN2In0.P2934jiPU233bNahCAeS_w';

const mapStyle = 'mapbox://styles/tonycmf/clkgw9bd500fc01qked97gn5b';

const map = new mapboxgl.Map({
    container: 'map',
    style: mapStyle,
    center: [-74.0060, 40.7128],
    zoom: 12
});

const citySearchInput = document.getElementById('citySearch');
const urlField = document.getElementById('urlField');
const getUrlButton = document.getElementById('getUrlButton');
const coordinatesField = document.getElementById('coordinatesField');
const getCoordinatesButton = document.getElementById('getCoordinatesButton');

const zoomInButton = document.getElementById('zoomInButton');
const zoomOutButton = document.getElementById('zoomOutButton');

function centerMap(longitude, latitude) {
    map.setCenter([longitude, latitude]);
}

function searchCity() {
    const city = citySearchInput.value;
    fetch(`https://api.mapbox.com/geocoding/v5/mapbox.places/${encodeURIComponent(city)}.json?access_token=${mapboxgl.accessToken}`)
        .then(response => response.json())
        .then(data => {
            const features = data.features;
            if (features.length > 0) {
                const longitude = features[0].center[0];
                const latitude = features[0].center[1];
                centerMap(longitude, latitude);
            } else {
                alert('City not found.');
            }
        })
        .catch(error => {
            console.error('Error fetching city:', error);
        });
}

document.getElementById('searchButton').addEventListener('click', searchCity);

map.on('load', function() {
    function updateURL() {
        const mapCenter = map.getCenter();
        const zoom = map.getZoom();
        const mapUrl = `https://api.mapbox.com/styles/v1/tonycmf/clkgw9bd500fc01qked97gn5b/static/${mapCenter.lng},${mapCenter.lat},${zoom},0,0/640x640?access_token=${mapboxgl.accessToken}`;
        urlField.value = mapUrl;
        coordinatesField.value = `${mapCenter.lng.toFixed(3)},${mapCenter.lat.toFixed(3)},${zoom.toFixed(1)}`;
    }

    updateURL();

    getUrlButton.addEventListener('click', function() {
        updateURL();
        copyToClipboard(urlField.value);
        alert('URL copied to clipboard!');
    });

    getCoordinatesButton.addEventListener('click', function() {
        copyToClipboard(coordinatesField.value);
        alert('Coordinates copied to clipboard!');
    });

    map.on('move', function() {
        updateURL();
    });
});

function copyToClipboard(text) {
    const textarea = document.createElement('textarea');
    textarea.value = text;
    document.body.appendChild(textarea);
    textarea.select();
    document.execCommand('copy');
    document.body.removeChild(textarea);
}

// Add event listeners for the zoom in and zoom out buttons
zoomInButton.addEventListener('click', function() {
    const currentZoom = map.getZoom();
    map.setZoom(currentZoom + 0.25);
});

zoomOutButton.addEventListener('click', function() {
    const currentZoom = map.getZoom();
    map.setZoom(currentZoom - 0.25);
});

const searchToggleButton = document.getElementById('searchToggleButton');
const searchBox = document.getElementById('searchBox');
const searchCityButton = document.getElementById('searchCityButton');

searchToggleButton.addEventListener('click', () => {
    alert('here 1');
    if (searchBox.style.display === 'none' || searchBox.style.display === '') {
        searchBox.style.display = 'flex';
    } else {
        searchBox.style.display = 'none';
    }
    alert('here 2');
});

searchCityButton.addEventListener('click', function() {
    const input = searchInput.value.trim();
    const parts = input.split(',');

    if (parts.length === 3) {
        const zoom = parseFloat(parts[0]);
        const latitude = parseFloat(parts[1]);
        const longitude = parseFloat(parts[2]);

        if (!isNaN(zoom) && !isNaN(latitude) && !isNaN(longitude)) {
            map.setZoom(zoom - 1);
            centerMap(longitude, latitude);
        } else {
            alert('Invalid input. Please use the format: Zoom, Latitude, Longitude');
        }
    } else {
        alert('Invalid input. Please use the format: Zoom, Latitude, Longitude');
    }
});
