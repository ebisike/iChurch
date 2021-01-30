function revenueLineChart(dataPoint) {
    //var x = document.getElementById('fintec-report-revenue').value
    var titleTag = document.getElementById('fintec-report-title-revenue').value
    let y = JSON.parse(dataPoint);
    console.log("from chart", y)

    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        theme: "light2",
        title: {
            //text: "Simple Line Chart"
            text: titleTag
        },
        data: [{
            type: "line",
            indexLabelFontSize: 16,
            // dataPoints: [
            //     { y: 450 },
            //     { y: 414 },
            //     { y: 520, indexLabel: "\u2191 highest", markerColor: "red", markerType: "triangle" },
            //     { y: 460 },
            //     { y: 450 },
            //     { y: 500 },
            //     { y: 480 },
            //     { y: 480 },
            //     { y: 410, indexLabel: "\u2193 lowest", markerColor: "DarkSlateGrey", markerType: "cross" },
            //     { y: 500 },
            //     { y: 480 },
            //     { y: 510 }
            // ],
            dataPoints: y
        }]
    });
    chart.render();
}

function expenditureLineChart(dataPoint) {
    //var x = document.getElementById('fintec-report-expenditure').value
    var titleTag = document.getElementById('fintec-report-title-expenditure').value
    let y = JSON.parse(dataPoint);
    console.log("from chart expenditure", y)

    var chart = new CanvasJS.Chart("exchartContainer", {
        animationEnabled: true,
        theme: "light2",
        title: {
            //text: "Simple Line Chart"
            text: titleTag
        },
        data: [{
            type: "line",
            indexLabelFontSize: 16,
            // dataPoints: [
            //     { y: 450 },
            //     { y: 414 },
            //     { y: 520, indexLabel: "\u2191 highest", markerColor: "red", markerType: "triangle" },
            //     { y: 460 },
            //     { y: 450 },
            //     { y: 500 },
            //     { y: 480 },
            //     { y: 480 },
            //     { y: 410, indexLabel: "\u2193 lowest", markerColor: "DarkSlateGrey", markerType: "cross" },
            //     { y: 500 },
            //     { y: 480 },
            //     { y: 510 }
            // ],
            dataPoints: y
        }]
    });
    chart.render();
}