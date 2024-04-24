<!DOCTYPE html>
<html>
<head>
    <title>Interactive Map with Mapbox</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            background-color: #808080; /* Storm Grey background color */
            padding-top: 10px;
        }

        #mapContainer {
            position: relative;
        }

        #map {
            width: 640px;
            height: 640px;
            margin-bottom: 10px;
        }

        #zoomButtons {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        #zoomButtons button {
            width: 30px;
            height: 30px;
            margin: 5px;
            border: none;
            background-color: #007BFF; /* Set background color for zoom buttons */
            cursor: pointer;
            font-weight: bold; /* Make the plus and minus signs bold */
            font-size: 20px; /* Adjust font size for better appearance */
            color: #fff; /* Set font color for plus and minus signs */
        }

        #zoomInButton::before {
            content: "+"; /* Use a minus sign for the zoom in button */
        }

        #zoomOutButton::before {
            content: "-"; /* Use a plus sign for the zoom out button */
        }

        #citySearchContainer {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        #citySearch {
            flex: 1;
            padding: 5px;
            margin-right: 10px; /* Add margin to the right of the search box */
            font-size: 14px;
        }

        #coordinatesField {
            flex: 1;
            margin-right: 10px;
            padding: 5px;
            font-size: 14px;
            
        }

        #getCoordinatesButton {
            padding: 5px 10px;
            background-color: #007BFF;
            color: #fff;
            cursor: pointer;
            border: none;
        }

        /* Additional style for the "Copy Coordinates" button */
        #getCoordinatesButton {
            margin-right: 0; /* Remove margin to center the button */
        }

        /* Styles for the image container */
        #imageContainer {
            display: flex;
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
            width: 100%;
            margin-bottom: 10px;
        }

        #imageContainer img {
            max-width: 100%;
            max-height: 100%;
        }

        
        
        

        /* Media queries for responsive design */
        @media (max-width: 650px) {
            #map {
                width: 40vh;
                height: 40vh; /* Adjust the height as needed */
            }

            #citySearchContainer {
                flex-direction: column;
                align-items: center;
            }

            #citySearch {
                margin-right: 0;
                margin-bottom: 10px;
            }

            #zoomButtons {
                flex-direction: column;
                align-items: flex-end;
                margin-bottom: 20px;
            }

            #zoomButtons button {
                margin: 2px;
                font-size: 16px;
                width: 25px;
                height: 25px;
            }

            #imageContainer {
                margin-top: 10px;
                margin-bottom: 10px;
            }

            #imageContainer img {
                max-width: 100%;
                max-height: 100%;
            }
        }

        /* Styling for instructions modal */
        #instructionsModal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        #instructionsContent {
            background-color: #fff;
            padding: 20px;
            max-width: 400px;
            border-radius: 5px;
            text-align: center;
        }

        #showInstructionsButton {
            margin-right: 10px;
        }

        #buttonsContainer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 0px 0; /* Adjust the margin as needed */
            padding: 10px; /* Add padding to create spacing */
        }

        #searchButtonContainer {
            position: absolute;
            top: 10px;
            left: 10px;
            z-index: 999;
            display: flex;
        }
        
        #searchToggleButton {
            background-color: #007BFF;
            color: #fff;
            border: none;
            cursor: pointer;
            margin-left: 5px;
            font-size: 16px;
            padding: 5px 10px;
        }
        
        #searchBox {
            display: flex;
            align-items: center;
        }
        
        #searchInput {
            padding: 5px;
            font-size: 14px;
        }
        
        #searchCityButton {
            padding: 5px 10px;
            background-color: #007BFF;
            color: #fff;
            cursor: pointer;
            border: none;
        }
        
        
    </style>
</head>
<body>
    <div id="instructionsModal">
        <div id="instructionsContent">
            <h3>Instructions</h3>
            <p>Step #1: Search for Location</p>
            <p>Step #2: Zoom In/Out as Desired</p>
            <p>Step #3: Click Button to Copy Coordinate Link</p>
            <p>Step #4: Return to Order & Paste Coordinate Link as Directed</p>
            <button id="closeInstructionsButton">Close</button>
        </div>
    </div>

    <div id="searchButtonContainer">
        <button id="searchToggleButton">+</button>
        <div id="searchBox" style="display: none;">
            <input type="text" id="searchInput" placeholder="Zoom, Latitude, Longitude">
            <button id="searchCityButton">Go</button>
        </div>
    </div>
    
    <div id="imageContainer">
        <img src="/static/PGD%20Made%20In%20The%20USA_Gray.png" alt="Image" width="216" height="155">
    </div>
    <div id="citySearchContainer">
        <input type="text" id="citySearch" placeholder="Enter a Location" onkeydown="if (event.key === 'Enter') searchCity()">
        <button id="searchButton">Search</button>
        <button id="showInstructionsButton">Show Instructions</button>
    </div>
    <div id="mapContainer">
        <div id="map"></div>
        <!-- Add mapInfo to display coordinates and zoom level -->
        <div id="mapInfo">
            <span id="currentCoordinates"></span>
            <span id="currentZoomLevel"></span>
        </div>
    </div>
    <div id="zoomButtons">
        <button id="zoomOutButton"></button>
        <button id="zoomInButton"></button>
    </div>
    <div id="coordinatesContainer">
        <input type="text" id="coordinatesField" readonly>
        <button id="getCoordinatesButton" onclick="copyCoordinates()">Copy Coordinates</button>
    </div>
    
   
   
    
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.js"></script>
    <script src="/static/script.js"></script>
    <script>
        
        const instructionsModal = document.getElementById('instructionsModal');
    const showInstructionsButton = document.getElementById('showInstructionsButton');
    const closeInstructionsButton = document.getElementById('closeInstructionsButton');

    showInstructionsButton.addEventListener('click', () => {
        instructionsModal.style.display = 'flex';
    });

    closeInstructionsButton.addEventListener('click', () => {
        instructionsModal.style.display = 'none';
    });

    function updateCoordinatesZoom(latitude, longitude, zoom) {
        var coordinatesField = document.getElementById('coordinatesField');
        var formattedCoordinates = `${zoom.toFixed(2)},${latitude.toFixed(6)},${longitude.toFixed(6)}`;
        coordinatesField.value = formattedCoordinates;

        var currentZoomLevel = document.getElementById('currentZoomLevel');
        
    }

    map.on('move', function () {
        var mapCenter = map.getCenter();
        var zoom = map.getZoom() +1;
        updateCoordinatesZoom(mapCenter.lat, mapCenter.lng, zoom);
    });

    function copyCoordinates() {
        var coordinatesField = document.getElementById('coordinatesField');
        coordinatesField.select();
        document.execCommand('copy');
        alert('Coordinates copied to clipboard!');
    }
    </script>
        
</body>
</html>