<?php

    $validate = new InputValidation();
    $transaction = new Transactions();

    if(isset($_POST['postcredit']))
    {
        foreach ($_POST as $key => $value)
        {
            $_POST[$key] = $validate->validateForm($value); //striping the user input            
        }
        
        //post transaction
        $transaction->postCreditTransaction($_POST);
        header('location: financerecords.php');
    }

    if(isset($_POST['postdebit']))
    {
        foreach ($_POST as $key => $value)
        {
            $_POST[$key] = $validate->validateForm($value);
        }

        //post debit transaction
        $transaction->postDebitTransaction($_POST);
        header('location: financerecords.php');
    }

    if(isset($_POST['report']))
    {
        $startDate = $_POST['startdate'];
        $endDate = $_POST['enddate'];
        header("location: /ichurch/app/public/finance/statementofaccount.php?sd=".$startDate."&ed=".$endDate."");
    }