import { ref, computed, onMounted, reactive, nextTick } from 'vue';
import useStyles from './useStyles';
import init from './init';
// TODO: Integrate
export default function useMap(props: MapComponent.Props) {
    const scriptLoaded = ref(false);
    const styles = useStyles();

    /**
    * get locations from props and return new array of markers that holds position object with lat nad lng
    */
     const getMarkers = (): MapComponent.Marker[] => {
        let markersArray: any[] = [];
        if (props.markers) {
            props.markers.forEach(element => {
                const position = {
                    lat: parseFloat(element.lat),
                    lng: parseFloat(element.lng),
                };
                markersArray.push({ position: position });
            });
        }
        return markersArray;
    };

    /**
         * unique map id
         */
     const mapId = computed(() => {
        return `map-${
            Math.random().toString(36).substring(2, 15) +
            Math.random().toString(36).substring(2, 15)
        }`;
    });

    var markersOnMap: google.maps.Marker[] = [];

        /**
         * if lat and lng props are set set center
         */
        let center: google.maps.LatLngLiteral;
        if (props.lat && props.lng) {
            center = {
                lat: props.lat,
                lng: props.lng,
            };
        }

        let infowindow: any;
        let markers: MapComponent.Marker[];
        let cluster: any;
        let mapElement: google.maps.Map;
        let maps: HTMLElement;

        const acceptCookies = async () => {
            try {
                await init();
                scriptLoaded.value = true;
                maps = document.querySelector(
                    `#${mapId.value.toString()}`
                ) as HTMLElement;
                scriptLoaded.value = true;
                localStorage.setItem('google-maps-lawi', 'accepted');
            } catch (error) {
                scriptLoaded.value = false;
                localStorage.removeItem('google-maps-lawi');
                console.error(error);
            } finally {
                setupMaps();
            }
        };

        const setupMaps = () => {
            initMap(maps);
        };

        /**
         * initialize map with given attributes
         */
        const initMap = (element: HTMLElement) => {
            markers = getMarkers();

            let zoom = props.zoom;

            mapElement = new google.maps.Map(element, {
                zoom,
                center: center || markers[0]?.position || { lat: 54, lng: 10 },
                styles: styles.mapStyles || null,
            });

            // map.addListener('click', () => {
            //     infowindow.close();
            // });

            if (markers.length > 1) {
                for (var i = 0; i < markers.length; i++) {
                    addMarker(markers[i]);
                }
            } else {
                new google.maps.Marker({
                    position: center,
                    map: mapElement,
                });
            }

            // if (styles.clusterStyles) {
            //     cluster = new MarkerClusterer(map, markersOnMap, {
            //         styles: styles.clusterStyles,
            //         maxZoom: 12,
            //         ignoreHidden: true,
            //     });
            // }
        };

        /**
         * take a given marker that holds a position object and create a new google marker
         */
        const addMarker = (marker: MapComponent.Marker) => {
            var newMarker = new google.maps.Marker({
                position: marker.position,
                // categories: marker.categories?.map(el => el.toString()) || [],
                map: mapElement,
                icon: marker.icon || null,
            });

            markersOnMap.push(newMarker);

            if (marker.infowindow) {
                google.maps.event.addListener(newMarker, 'click', () => {
                    infowindow.setContent(marker.infowindow);
                    infowindow.open(mapElement, newMarker);
                });
            }
            if (marker.infowindow && props.mouseover) {
                google.maps.event.addListener(newMarker, 'mouseover', () => {
                    infowindow.setContent(marker.infowindow);
                    infowindow.open(mapElement, newMarker);
                });
            }
        };

        onMounted(() => {
            nextTick(() => {
                if (localStorage.getItem('google-maps-lawi')) {
                    acceptCookies();
                }
            })
        });

        const map = reactive({
            getMarkers: getMarkers,
            acceptCookies: acceptCookies,
            scriptLoaded: scriptLoaded.value,
            mapId: mapId,
        })

        return map;
}