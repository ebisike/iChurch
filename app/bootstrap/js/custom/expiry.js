$(document).ready(function() {
    //let url = "ajax/verifier.php?orgId=<?php echo $_SESSION['orgId']?>"
    $.ajax({
        method: "GET",
        url: "../../../public/ajax/verifier.php?orgId=<?php echo $_SESSION['orgId']?>",
        success: function(resp) {
            alert('hit')

            var resp = JSON.parse(resp)
            console.log(resp)
            let expiryDate = Date.parse(obj.expirydate)
            let today = Date.now()
            if (expiryDate == today) {
                alert('account expired.')
                window.location.replace('../../../notice.html');
            }
        },
        error: function(err) {
            alert('error')
            console.log("error")
        }
    });
})