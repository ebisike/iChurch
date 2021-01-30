// function expenditurePieChart(dataPoint) {

//     //var x = document.getElementById('source-list-expenditure').value

//     let y = JSON.parse(dataPoint);
//     console.log("from chart PIE", y)

//     var chart = new CanvasJS.Chart("exMyPieChart", {
//         exportEnabled: true,
//         animationEnabled: true,
//         title: {
//             text: "State Operating Funds"
//         },
//         legend: {
//             cursor: "pointer",
//             itemclick: explodePie
//         },
//         data: [{
//             type: "pie",
//             showInLegend: true,
//             toolTipContent: "{name}: <strong>{y}%</strong>",
//             indexLabel: "{name} - {y}%",
//             // dataPoints: [
//             //     { y: 26, name: "School Aid", exploded: true },
//             //     { y: 20, name: "Medical Aid" },
//             //     { y: 5, name: "Debt/Capital" },
//             //     { y: 3, name: "Elected Officials" },
//             //     { y: 7, name: "University" },
//             //     { y: 17, name: "Executive" },
//             //     { y: 22, name: "Other Local Assistance" }
//             // ],
//             dataPoints: y
//         }]
//     });
//     chart.render();
// }

// function explodePie(e) {
//     if (typeof(e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
//         e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
//     } else {
//         e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
//     }
//     e.chart.render();

// }

function revenuePieChart(dataPoint) {

    //var x = document.getElementById('source-list').value

    let y = JSON.parse(dataPoint);
    console.log("from chart PIE", y)

    var chart = new CanvasJS.Chart("myPieChart", {
        animationEnabled: true,
        title: {
            text: "Desktop Search Engine Market Share - 2016"
        },
        data: [{
            type: "pie",
            startAngle: 240,
            yValueFormatString: "##0.00\"%\"",
            indexLabel: "{label} {y}",
            // dataPoints: [
            //     { y: 79.45, label: "Google" },
            //     { y: 7.31, label: "Bing" },
            //     { y: 7.06, label: "Baidu" },
            //     { y: 4.91, label: "Yahoo" },
            //     { y: 1.26, label: "Others" }
            // ],
            dataPoints: y
        }]
    });
    chart.render();

}

function expenditurePieChart(dataPoint) {

    //var x = document.getElementById('source-list-expenditure').value

    let y = JSON.parse(dataPoint);
    console.log("from chart PIE PIEEEE", y)

    var chart = new CanvasJS.Chart("exMyPieChart", {
        animationEnabled: true,
        title: {
            text: "Desktop Search Engine Market Share - 2016"
        },
        data: [{
            type: "pie",
            startAngle: 240,
            yValueFormatString: "##0.00\"%\"",
            indexLabel: "{label} {y}",
            // dataPoints: [
            //     { y: 79.45, label: "Google" },
            //     { y: 7.31, label: "Bing" },
            //     { y: 7.06, label: "Baidu" },
            //     { y: 4.91, label: "Yahoo" },
            //     { y: 1.26, label: "Others" }
            // ],
            dataPoints: y
        }]
    });
    chart.render();

}