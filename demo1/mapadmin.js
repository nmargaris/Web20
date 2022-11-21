let mymap = L.map('mapid');
let osmUrl='https://tile.openstreetmap.org/{z}/{x}/{y}.png';
let osmAttrib='Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors';
let osm = new L.TileLayer(osmUrl, {attribution: osmAttrib});
mymap.addLayer(osm);

//sintetagmenes kai zoom
mymap.setView([38.246242, 21.7350847], 12);

$("#switch").click(function () {
    mymap.invalidateSize();
});
// $(document).ready(function () {
//     $("#heatmapadmin").submit(function (e) {
//         // let myArray = [];
//         e.preventDefault();
//         $.ajax({
//             type: "POST",
//             url: "getlocationsadmin.php",
//             data: $("#heatmapadmin").serialize(),
//             success: function (data) {
//                 drawheatmap(data[0]);
//             }
//
//         })
//     })
// })

function submitform() {
    var data = $("#heatmapadmin").serialize();

    $.ajax({
        type: 'POST',
        url: 'getlocationsadmin.php',
        dataType: 'JSON',
        data: data,
        success: function (data) {
            console.log('geiaa');
            drawheatmap(data);

        }
    });

}

function submitexport(){
    const data = $("#heatmapadmin").serialize();
    // $.ajax({
    //     type: 'POST',
    //     url: 'export.php',
    //     data: data,
    //     success: function (data) {
    //         console.log(data);
    //         confirm("Your data has been exported");
    //
    //     }
    // });
    $.ajax({
        type: "POST",
        url: 'export.php',
        data: data,
        success: function(response, status, xhr) {
            // check for a filename
            var filename = "";
            var disposition = xhr.getResponseHeader('Content-Disposition');
            if (disposition && disposition.indexOf('attachment') !== -1) {
                var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                var matches = filenameRegex.exec(disposition);
                if (matches != null && matches[1]) filename = matches[1].replace(/['"]/g, '');
            }

            var type = xhr.getResponseHeader('Content-Type');
            var blob = new Blob([response], { type: type });

            if (typeof window.navigator.msSaveBlob !== 'undefined') {
                // IE workaround for "HTML7007: One or more blob URLs were revoked by closing the blob for which they were created. These URLs will no longer resolve as the data backing the URL has been freed."
                window.navigator.msSaveBlob(blob, filename);
            } else {
                var URL = window.URL || window.webkitURL;
                var downloadUrl = URL.createObjectURL(blob);

                if (filename) {
                    // use HTML5 a[download] attribute to specify filename
                    var a = document.createElement("a");
                    // safari doesn't support this yet
                    if (typeof a.download === 'undefined') {
                        window.location = downloadUrl;
                    } else {
                        a.href = downloadUrl;
                        a.download = filename;
                        document.body.appendChild(a);
                        a.click();
                    }
                } else {
                    window.location = downloadUrl;
                }

                setTimeout(function () { URL.revokeObjectURL(downloadUrl); }, 100); // cleanup
            }
        }
    });
}
// $.ajax({
//     type: "POST",
//     url: url,
//     data: params,
//     success: function(response, status, xhr) {
//         // check for a filename
//         var filename = "";
//         var disposition = xhr.getResponseHeader('Content-Disposition');
//         if (disposition && disposition.indexOf('attachment') !== -1) {
//             var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
//             var matches = filenameRegex.exec(disposition);
//             if (matches != null && matches[1]) filename = matches[1].replace(/['"]/g, '');
//         }
//
//         var type = xhr.getResponseHeader('Content-Type');
//         var blob = new Blob([response], { type: type });
//
//         if (typeof window.navigator.msSaveBlob !== 'undefined') {
//             // IE workaround for "HTML7007: One or more blob URLs were revoked by closing the blob for which they were created. These URLs will no longer resolve as the data backing the URL has been freed."
//             window.navigator.msSaveBlob(blob, filename);
//         } else {
//             var URL = window.URL || window.webkitURL;
//             var downloadUrl = URL.createObjectURL(blob);
//
//             if (filename) {
//                 // use HTML5 a[download] attribute to specify filename
//                 var a = document.createElement("a");
//                 // safari doesn't support this yet
//                 if (typeof a.download === 'undefined') {
//                     window.location = downloadUrl;
//                 } else {
//                     a.href = downloadUrl;
//                     a.download = filename;
//                     document.body.appendChild(a);
//                     a.click();
//                 }
//             } else {
//                 window.location = downloadUrl;
//             }
//
//             setTimeout(function () { URL.revokeObjectURL(downloadUrl); }, 100); // cleanup
//         }
//     }
// });

function drawheatmap(data) {
    let layercount = 0;
    mymap.eachLayer(function (layer) {
        layercount++;
        if(layercount > 1 ){
            mymap.removeLayer(layer)
        }
    });
    let myArray = [];
    let cfg = {
        // radius should be small ONLY if scaleRadius is true (or small radius is intended)
        // if scaleRadius is false it will be the constant radius used in pixels
        "radius": 40,
        "maxOpacity": 0.8,
        // scales the radius based on map zoom
        "scaleRadius": false,
        // if set to false the heatmap uses the global maximum for colorization
        // if activated: uses the data maximum within the current map boundaries
        //   (there will always be a red spot with useLocalExtrema true)
        "useLocalExtrema": false,
        // which field name in your data represents the latitude - default "lat"
        latField: 'lat',
        // which field name in your data represents the longitude - default "lng"
        lngField: 'lng',
        // which field name in your data represents the data value - default "value"
    };

    $.each(data, function (i, object) {
        myArray.push({"lat": object.lat, "lng": object.lng, "count": object.count})
    });
    let testData = {
        max: 12,
        data: myArray
    };
    let heatmapLayer = new HeatmapOverlay(cfg);
    mymap.addLayer(heatmapLayer);
    heatmapLayer.setData(testData);
}