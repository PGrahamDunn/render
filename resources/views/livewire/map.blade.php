    <div class="p-4 m-4 bg-gray-100 border border-gray-300 rounded-md">
        {{--
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
        --}}
        
        <div id="searchButtonContainer" class="flex space-x-2 mb-2">
        <button id="searchToggleButton" class="inline-flex items-center px-3 py-2 h-8 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 active:bg-gray-800  disabled:bg-gray-400 focus:outline-none transition ease-in-out duration-150">+</button>
            <div id="searchBox" style="display: none;" class="space-x-2">
                <input type="text" id="searchInput" placeholder="Zoom, Latitude, Longitude" class="h-8 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <button id="searchCityButton" class="inline-flex items-center px-3 py-2 h-8 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 active:bg-gray-800  disabled:bg-gray-400 focus:outline-none transition ease-in-out duration-150">Go</button>
            </div>
        </div>
        
        <div class="space-y-4">
            <div class="flex justify-center  space-x-8">
                <div class="space-y-8">

                    <div id="instructionsContent" class="border border-gray-300 rounded-md p-3">
                        <div class="text-2xl mb-2">Instructions</div>
                        <p>1. Search for Location</p>
                        <p>2. Zoom In/Out as Desired</p>
                        <p>3. Click Button to Copy Coordinates</p>
                        <p>4. Return to Order & Paste Coordinates</p>
                    </div>
                    <div class="flex flex-col">
                        <div class="flex justify-center">
                            <div id="citySearchContainer" class="flex items-center space-x-3">
                                <input type="text" id="citySearch" placeholder="Enter a Location" onkeydown="if (event.key === 'Enter') searchCity()" class="h-8 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <button id="searchButton" class="inline-flex items-center px-4 py-2 h-8 bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 focus:bg-gray-600 active:bg-gray-800 disabled:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Search</button>
                                {{-- <button id="showInstructionsButton">Show Instructions</button> --}}
                            </div>
                        </div>

                        <div class="flex justify-center mt-4">
                            <div id="zoomButtons" class="flex items-center space-x-3">
                                <button id="zoomInButton" class="inline-flex items-center px-4 py-2 h-8 bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 focus:bg-gray-600 active:bg-gray-800  disabled:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Zoom In</button>
                                <button id="zoomOutButton" class="inline-flex items-center px-4 py-2 h-8 bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 focus:bg-gray-600 active:bg-gray-800  disabled:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Zoom Out</button>
                            </div>
                        </div>

                        <div class="flex justify-center mt-72">
                            <div id="coordinatesContainer" class="flex items-center space-x-3">
                                <input type="text" id="coordinatesField" readonly class="h-8 w-40 border-gray-300 rounded-md shadow-sm">
                                <button id="getCoordinatesButton" onclick="copyCoordinates()" class="inline-flex items-center px-4 py-2  h-8 bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 focus:bg-gray-600 active:bg-gray-800  disabled:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Copy Coordinates</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="mapContainer">
                    <div id="map"></div>
                    <!-- Add mapInfo to display coordinates and zoom level -->
                    <div id="mapInfo">
                        <span id="currentCoordinates"></span>
                        <span id="currentZoomLevel"></span>
                    </div>

                </div>

            </div>
        </div>



        <script src="https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.js"></script>
        <script src="/static/script_new.js"></script>
        <script>
            // const instructionsModal = document.getElementById('instructionsModal');
            const showInstructionsButton = document.getElementById('showInstructionsButton');
            const closeInstructionsButton = document.getElementById('closeInstructionsButton');
            /*
                        showInstructionsButton.addEventListener('click', () => {
                            instructionsModal.style.display = 'flex';
                        });

                        closeInstructionsButton.addEventListener('click', () => {
                            instructionsModal.style.display = 'none';
                        });
            */
            1

            function updateCoordinatesZoom(latitude, longitude, zoom) {
                var coordinatesField = document.getElementById('coordinatesField');
                var formattedCoordinates = `${zoom.toFixed(2)},${latitude.toFixed(6)},${longitude.toFixed(6)}`;
                coordinatesField.value = formattedCoordinates;

                var currentZoomLevel = document.getElementById('currentZoomLevel');

            }

            map.on('move', function() {
                var mapCenter = map.getCenter();
                var zoom = map.getZoom() + 1;
                updateCoordinatesZoom(mapCenter.lat, mapCenter.lng, zoom);
            });

            function copyCoordinates() {
                var coordinatesField = document.getElementById('coordinatesField');
                coordinatesField.select();
                document.execCommand('copy');
                alert('Coordinates copied to clipboard!');
            }
        </script>
    </div>