function buildLineChartData(obj) {
    if (!obj) return
    let max = getMax(obj);
    let min = getMin(obj)
    let arr = [];

    obj.forEach(i => {
        if (!i.total) {
            arr.push({ y: 0, label: i.month })
        } else {
            if (i.total == max) {
                arr.push({ y: parseInt(i.total, 10), label: i.month, indexLabel: "\u2191 highest", markerColor: "red", markerType: "triangle" })
            } else if (i.total == min) {
                arr.push({ y: parseInt(i.total, 10), label: i.month, indexLabel: "\u2193 lowest", markerColor: "DarkSlateGrey", markerType: "cross" })
            } else {
                arr.push({ y: parseInt(i.total, 10), label: i.month })
            }
        }
    })
    return JSON.stringify(arr)
}

function getMax(arrOfObj) {
    let tempArr = [];
    arrOfObj.forEach(i => {
        if (i.sum) tempArr.push(i.sum)
        else if (i.total) tempArr.push(i.total)
    })

    //let max = Math.max(tempArr)
    var max = tempArr.reduce(function(a, b) {
        return Math.max(a, b);
    });
    console.log("Max is: ", max);
    return max;
}

function getMin(arrOfObj) {
    let tempArr = []
    arrOfObj.forEach(i => {
        if (i.sum) tempArr.push(i.sum)
        else if (i.total) tempArr.push(i.total)
    })

    //let min = Math.min(tempArr)
    var min = tempArr.reduce(function(a, b) {
        return Math.min(a, b);
    });
    //console.log("Min is: ", min)
    return min
}

function buildPieData(obj) {
    let max = getMax(obj) //get the max value in the object
        //console.log("your maxx", max)
    let arr = []
        //console.log("udi",obj)

    obj.forEach(i => {
        if (!i.sum) {
            arr.push({ y: 0, name: i.source })
        } else {
            if (i.sum == max) {
                arr.push({ y: parseInt(i.sum, 10), name: i.source, exploded: true })
            } else {
                arr.push({ y: parseInt(i.sum, 10), name: i.source })
            }
        }
    })
    return JSON.stringify(arr)
}