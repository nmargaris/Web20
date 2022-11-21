let savedsquares = [];
let correctcoord ;
$(document).ready(function () {
    $("#getsquares").click(function () {
        console.log('pressed');
        var featureGroup = L.featureGroup().addTo(mymap);
        var drawControl = new L.Control.Draw({
            edit: {
                featureGroup: featureGroup
            },
            draw: {
                polygon : false,
                polyline : false,
                circle : false,
                marker: false
            }
        }).addTo(mymap);

        mymap.on('draw:created', function(e) {
            let layer = e.layer;
            // Each time a feaute is created, it's added to the over arching feature group
            featureGroup.addLayer(e.layer);
            // savedsquares.push(e.layer.getLatLngs().map(function(point) {
            //     return [point.lat, point.lng];
            //
            // }));
           savedsquares.push ( layer.getLatLngs().map(function(square){
               return square.map(function(point){
                   return [point.lat, point.lng];
                })

            }))

        })



    });
    $("#savesquares").click(function (e) {
        // savedsquares.forEach(correctorder);
        // correctcoord.push(savedsquares.forEach(correctorder));
        // console.log(correctcoord);
        // console.log(JSON.stringify(savedsquares));
        console.log(savedsquares);

    });

    $("#deletesquares").click(function (e) {
        let layercount = 0;
        mymap.eachLayer(function (layer) {
            console.log('pressed');
            layercount++;
            if (layercount > 2) {
                mymap.removeLayer(layer);
                savedsquares.length = 0;
                console.log(savedsquares);
            }
        });
    })
})

// function correctorder(item,index,array) {
//     item.forEach(function (v,i) {
//         v.forEach(function (vv,ii) {
//             array.push(vv.lat,vv.lng);
//         })
//     })
//     return array;
// }