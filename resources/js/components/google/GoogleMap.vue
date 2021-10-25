<script>

export default {
    props: {
        items: {
            type: Object,
            required: true
        }
    },

    data() {
        return {
           map: '',           
           style: [
                {
                    "featureType": "administrative",
                    "elementType": "geometry",
                    "stylers": [
                    {
                        "visibility": "off"
                    }
                    ]
                },
                {
                    "featureType": "administrative.land_parcel",
                    "stylers": [
                    {
                        "visibility": "off"
                    }
                    ]
                },
                {
                    "featureType": "administrative.neighborhood",
                    "stylers": [
                    {
                        "visibility": "off"
                    }
                    ]
                },
                {
                    "featureType": "landscape",
                    "elementType": "geometry.fill",
                    "stylers": [
                    {
                        "color": "#f6f4f5"
                    }
                    ]
                },
                {
                    "featureType": "poi",
                    "stylers": [
                    {
                        "visibility": "off"
                    }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "labels.text",
                    "stylers": [
                    {
                        "visibility": "off"
                    }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "labels",
                    "stylers": [
                    {
                        "visibility": "off"
                    }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "labels.icon",
                    "stylers": [
                    {
                        "visibility": "off"
                    }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "labels",
                    "stylers": [
                    {
                        "visibility": "off"
                    }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "labels",
                    "stylers": [
                    {
                        "visibility": "off"
                    }
                    ]
                },
                {
                    "featureType": "road.local",
                    "stylers": [
                    {
                        "visibility": "off"
                    }
                    ]
                },
                {
                    "featureType": "transit",
                    "stylers": [
                    {
                        "visibility": "off"
                    }
                    ]
                },
                {
                    "featureType": "water",
                    "stylers": [
                    {
                        "color": "#75b8cb"
                    }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "labels.text",
                    "stylers": [
                    {
                        "visibility": "off"
                    }
                    ]
                }
                ]
        }
    },
    
    mounted() {
        this.initMap()
    },

    render() {

    },

    methods: {
       initMap() {
           this.map = new google.maps.Map(document.getElementById("map"), {
                styles: this.style
            })
            var bounds = new google.maps.LatLngBounds()
            _.forEach(this.items, (item) => {
                var icon = {
                    url: item.marker.url,
                }                
                if (_.has(item, 'marker_label')) {
                    if (item.marker_label != null) {
                        var label = {
                            text: String(item.marker_label),
                            className: 'text-center font-bold text-black'
                        }
                    }                    
                }
                const marker = new google.maps.Marker({                    
                    position: new google.maps.LatLng(item.lat, item.lng),
                    icon: icon,
                    label: label,                      
                    map: this.map,
                })

                bounds.extend(marker.getPosition())
                marker.addListener("click", () => {
                    window.location.href = item.link;
                });           
            })
            this.map.fitBounds(bounds)
            google.maps.event.addListenerOnce(this.map, 'bounds_changed', () => {
                if (this.map.getZoom() > 11) {
                    this.map.setZoom(12);
                }
            })
       }
    }
}
</script>
