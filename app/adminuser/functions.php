<?php
function toLongDateStringx($dateParameter)
{
    $currentYear = date('Y');
    $currentMonth = date('M');
    $currentDay = date('D');

    $date = strtotime($dateParameter);        
    $day = date('d', $date);
    $Day = date('D', $date);
    $month = date('M', $date);
    $year = date('Y', $date);

    switch ($month) {
        case 'Jan':
            $month = 'January';
            break;
        case 'Feb':
            $month = 'Febuary';
            break;
        case 'Mar':
            $month = 'March';
            break;
        case 'Apr':
            $month = 'April';
            break;
        case 'May':
            $month = 'May';
            break;
        case 'Jun':
            $month = 'June';
            break;
        case 'Jul':
            $month = 'July';
            break;
        case 'Aug':
            $month = 'August';
            break;
        case 'Sep':
            $month = 'September';
            break;
        case 'Oct':
            $month = 'October';
            break;
        case 'Nov':
            $month = 'November';
            break;
        case 'Dec':
            $month = 'December';
            break;
        
        default:
            # code...
            break;
    }

    switch ($Day) {
        case 'Sun':
            $Day = 'Sunday';
            break;
        case 'Mon':
            $Day = 'Monday';
            break;
        case 'Tue':
            $Day = 'Tuesday';
            break;
        case 'Wed':
            $Day = 'Wednesday';
            break;
        case 'Thu':
            $Day = 'Thursday';
            break;
        case 'Fri':
            $Day = 'Friday';
            break;
        case 'Sat':
            $Day = 'Saturday';
            break;
        
        default:
            # code...
            break;
    }

    return  $Day.', '.$day.' '.$month.', '.$year;
}

function setPackageDurationDisplayName($value)
{
    $duration = "";
    switch($value)
    {
        case '0':
            # code...
            $duration = "Two Weeks";
            break;
        case '1':
            # code...
            $duration = "Monthly";
            break;
        case '4':
            # code...
            $duration = "Quarterly";
            break;
        case '6':
            # code...
            $duration = "Semi Annunally";
            break;
        case '12':
            # code...
            $duration = "Annually";
            break;
    }
    return $duration;
}