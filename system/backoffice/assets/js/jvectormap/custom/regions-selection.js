$(function(){var a,b=[{latLng:[52.5,13.39],name:"Berlin"},{latLng:[53.56,10],name:"Hamburg"},{latLng:[48.13,11.56],name:"Munich"},{latLng:[50.95,6.96],name:"Cologne"},{latLng:[50.11,8.68],name:"Frankfurt am Main"},{latLng:[48.77,9.17],name:"Stuttgart"},{latLng:[51.23,6.78],name:"Düsseldorf"},{latLng:[51.51,7.46],name:"Dortmund"},{latLng:[51.45,7.01],name:"Essen"},{latLng:[53.07,8.8],name:"Bremen"}],c=[887.7,755.16,310.69,405.17,248.31,207.35,217.22,280.71,210.32,325.42];a=new jvm.Map({container:$("#regionSelection"),map:"de_merc",zoomOnScroll:!1,zoomMin:1,regionsSelectable:!0,markersSelectable:!0,markers:b,markerStyle:{initial:{fill:"#fa9255"},selected:{fill:"#f0b518"}},regionStyle:{initial:{fill:"#ab7967"},selected:{fill:"#E02F2F"}},series:{markers:[{attribute:"r",scale:[5,15],values:c}]},backgroundColor:"#FFFFFF",onRegionSelected:function(){window.localStorage&&window.localStorage.setItem("jvectormap-selected-regions",JSON.stringify(a.getSelectedRegions()))},onMarkerSelected:function(){window.localStorage&&window.localStorage.setItem("jvectormap-selected-markers",JSON.stringify(a.getSelectedMarkers()))}}),a.setSelectedRegions(JSON.parse(window.localStorage.getItem("jvectormap-selected-regions")||"[]")),a.setSelectedMarkers(JSON.parse(window.localStorage.getItem("jvectormap-selected-markers")||"[]"))});