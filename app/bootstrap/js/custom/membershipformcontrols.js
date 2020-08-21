$(document).ready(function() {
    document.getElementById('spouse-div').style.display = 'none'
    document.getElementById('marriage-nature-div').style.display = 'none'
    document.getElementById('marriage-date-div').style.display = 'none'
    document.getElementById('child-div').style.display = 'none'

    let maritalStatus = document.getElementById('marital-status');

    maritalStatus.addEventListener('change', maritalTab)

    function maritalTab(e) {
        //console.log(e.target.value)
        if (e.target.value != "single") {
            document.getElementById('spouse-div').style.display = 'block'
            document.getElementById('marriage-nature-div').style.display = 'block'
            document.getElementById('marriage-date-div').style.display = 'block'
            document.getElementById('child-div').style.display = 'block'
        } else {
            document.getElementById('spouse-div').style.display = 'none'
            document.getElementById('marriage-nature-div').style.display = 'none'
            document.getElementById('marriage-date-div').style.display = 'none'
            document.getElementById('child-div').style.display = 'none'
        }
    }

    let baptisedNo = document.getElementById('isBaptisedNo');
    baptisedNo.addEventListener('click', function(e) {
        document.getElementById('baptised').style.display = 'none'
    })

    let baptisedYes = document.getElementById('isBaptisedYes');
    baptisedYes.addEventListener('click', function(e) {
        document.getElementById('baptised').style.display = 'block'
    })

    let confirmedNo = document.getElementById('isConfirmedNo')
    confirmedNo.addEventListener('click', function(e) {
        document.getElementById('confirmed').style.display = 'none'
    })

    let confirmedYes = document.getElementById('isConfirmedYes')
    confirmedYes.addEventListener('click', function(e) {
        document.getElementById('confirmed').style.display = 'block'
    })

    function churchTab(e) {
        console.log(e.target.value);
    }
})