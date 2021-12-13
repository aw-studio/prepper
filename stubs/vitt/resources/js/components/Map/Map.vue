<template>
    <div class="w-full h-full">
        <div
            v-if="!scriptLoaded"
            class="flex flex-col items-center justify-center text-red-500"
        >
            <div class="pb-2 text-gray-500">
                I agree to the use of Google Maps.
            </div>
            <Button outline @click="acceptCookies">Show Map</Button>
        </div>
        <div v-if="mapId" class="h-full -mx-5 md:mx-0" :id="mapId"></div>
    </div>
</template>

<script lang="ts" setup>
import { computed, defineComponent, onMounted, PropType, ref } from 'vue';
import { Button } from '@/components';
import { useStyles, init } from '@/modules/Map';

interface Marker extends google.maps.Marker {
    position: google.maps.LatLngLiteral;
    categories: String[];
    infowindow: String;
    icon: string | null;
}

interface Position {
    lat: string;
    lng: string;
}

let infowindow: any = null;
let markers: Marker[] = [];
let cluster: any = null;
let map: google.maps.Map | null = null;
let maps: HTMLElement | null = null;
let center: google.maps.LatLngLiteral | null = null;

const props = defineProps({
    zoom: {
        type: Number,
        default: 8,
    },
    lat: {
        type: Number,
    },
    lng: {
        type: Number,
    },
    markers: {
        type: Array as PropType<Position[]>,
    },
    mouseover: {
        type: Boolean,
        default: false,
    },
});

const styles = useStyles();
const scriptLoaded = ref(false);

/**
 * get locations from props and return new array of markers that holds position object with lat nad lng
 */
const getMarkers = (): Marker[] => {
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
if (props.lat && props.lng) {
    center = {
        lat: props.lat,
        lng: props.lng,
    };
}

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

onMounted(() => {
    if (localStorage.getItem('google-maps-lawi')) {
        acceptCookies();
    }
});

const setupMaps = () => {
    initMap(maps as HTMLElement);
};

/**
 * initialize map with given attributes
 */
const initMap = (element: HTMLElement) => {
    markers = getMarkers();

    let zoom = props.zoom;

    map = new google.maps.Map(element, {
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
            map: map,
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
const addMarker = (marker: Marker) => {
    var newMarker = new google.maps.Marker({
        position: marker.position,
        // categories: marker.categories?.map(el => el.toString()) || [],
        map: map,
        icon: marker.icon || styles.marker || null,
    });

    markersOnMap.push(newMarker);

    if (marker.infowindow) {
        google.maps.event.addListener(newMarker, 'click', () => {
            infowindow.setContent(marker.infowindow);
            infowindow.open(map, newMarker);
        });
    }
    if (marker.infowindow && props.mouseover) {
        google.maps.event.addListener(newMarker, 'mouseover', () => {
            infowindow.setContent(marker.infowindow);
            infowindow.open(map, newMarker);
        });
    }
};
</script>

<style>
.gm-style-iw,
.gm-style-iw-c,
.gm-style {
    background-color: transparent !important;
    box-shadow: none !important;
    border-radius: 0 !important;
    padding: 0 !important;
    max-height: unset !important;
    overflow: visible !important;
}
.gm-ui-hover-effect {
    display: none !important;
}
.gm-style .gm-style-iw-d {
    overflow: visible !important;
}
</style>
