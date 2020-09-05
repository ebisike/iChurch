<?php
    require ('../shared/_sidebar.php');
    require ('../shared/_topbar.php');
    include '../../adminuser/functions.php';

    $packages = new PaymentPackages();
    $request = new Subscriptions();

    $history = $request->getSubscriptions($_SESSION['orgId']);
    $packagelist = $packages->readPackages();
    //include '../../Web/Controllers/first-timers-handler.php';
?>

<div class="mt-0 ml-4 mr-4">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        </div>
    </div>
</div>

<?php
    require ('../shared/_footer.php');
?>
<script>
    $(document).ready(function(){
        // $.ajax({
        //     method: "GET",
        //     url: `../ajax/verifier.php?orgId=<?php echo $_SESSION['orgId']?>`,
        //     success: function(resp){
        //         let resp1 = JSON.parse(resp)
        //         let expiryDate = resp1.expirydate
        //         //console.log('yeah'+today) // make i confess I no know where the variable today was declared ooo. but e sha dey work
        //         if(expiryDate <= today)
        //         {
        //             //modal takes over the browser
        //             $('#subscriptionCategory').modal({
        //                 backdrop: 'static',
        //                 keyboard: false,
        //             })
        //             $('#subscriptionCategory').modal('show')
        //             document.querySelector('#category').addEventListener('click', saveSubscription)
        //         }
        //         else
        //         {
        //             //user can close modal                   
        //             $('#subscriptionCategory').modal('show')
        //             document.querySelector('#category').addEventListener('click', saveSubscription)
        //         }
        //     }
        // })       

         //modal takes over the browser
         $('#subscriptionCategory').modal({
                        backdrop: 'static',
                        keyboard: false,
                    })
                    $('#subscriptionCategory').modal('show')
                    document.querySelector('#category').addEventListener('click', saveSubscription)

        function saveSubscription(e)
        {
            let pkgId;
            let orgId;
            if(e.currentTarget.classList.contains('subscribe'))
            {
                pkgId = e.currentTarget.childNodes[1].id
                orgId = e.currentTarget.childNodes[2].id
            }
            else
            {
                if(e.target.id == 'subscribe')
                {
                    let parent = e.target.parentElement //get the parent element holding the post values
                    let children = Array.from(parent.children).slice(1) //slice the array. remove the first element
                    pkgId = children[0].id
                    orgId = children[1].id

                    //ajax method
                    $.ajax({
                        method: "GET",
                        url: `save_subscription.php?pkgId=${pkgId}&orgId=${orgId}`,
                        success: function(resp){
                            //alert('Your Request has been Recieved!. Please Check back to see if it has been processed.')
                            $('#subscriptionCategory').modal('hide')
                            $('#subscriptionSuccess').modal({
                                backdrop: 'static',
                                keyboard: false,
                            })
                            $('#subscriptionSuccess').modal('show')
                            //window.location.replace('../mgt/index.php')
                        },
                        error: function(resp){
                            console.log('faild')
                        }
                    })
                }
                console.log(pkgId)
            }            
        }
    })
</script>