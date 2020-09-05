var today = new Date();
var day = today.getDate();
var month = today.getMonth() + 1; //January is 0!
var year = today.getFullYear();
if (day < 10)
    day = '0' + day
if (month < 10)
    month = '0' + month

today = year + '-' + month + '-' + day;

let dates = document.querySelectorAll('.datefield')
let arr = Array.from(dates)
for (let index = 0; index < arr.length; index++) {
    dates[index].setAttribute("max", today)
}
//set min date for end date picker when generating reports
let startDate = document.getElementById('startDate')
startDate.addEventListener('change', (e) => {
    document.getElementById('endDate').disabled = false
    document.getElementById('endDate').setAttribute("min", startDate.value)
})