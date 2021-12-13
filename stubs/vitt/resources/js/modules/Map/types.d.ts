declare namespace MapComponent {
    export interface Marker extends google.maps.Marker {
        position: google.maps.LatLngLiteral;
        categories: String[];
        infowindow: String;
        icon: string | null; 
    }

    export interface Position {
        lat: string;
        lng: string;
    }

    export interface Props {
        zoom: number,
        lat?: number,
        lng?: number,
        markers?: Array<Position>,
        mouseover?: Boolean,
    }
}