<?php
include_once '../../Services/init.php';
$report = new Reports();

//get annual report for graphs
if(isset($_GET['lineChart'])){
    $generated = $report->getAnnualCreditReport();
    echo json_encode($generated);
}

//get annual report for graphs
if(isset($_GET['pieChart'])){
    $pie = $report->getIncomeSourceSummary();
    echo json_encode($pie);
}


if(isset($_GET['expenseGraph'])){
    $expenseData = $report->getAnnualDebitReport();
    echo json_encode($expenseData);
}

if(isset($_GET['expensePieGraph'])){
    $expensePieData = $report->getExpenditureSourceSummary();
    echo json_encode($expensePieData);
}