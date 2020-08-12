<?php

include ('INotifications.php');

class Notifications implements INotifications
{
    private function day()
    {
        return date('d');
    }

    private function month()
    {
        return date('m');
    }

    private function year()
    {
        return date('Y');
    }

    private function addDays($num)
    {
        $day = $this->day();
        return $day + ($num);
    }

    private function startAndEndDate($datestring, $num)
    {
        $customDate = strtotime($datestring);
        $daypart = date('d', $customDate);
        $monthpart = date('M', $customDate);
        $yearpart = date('Y', $customDate);

        $addDays = $daypart + $num;
        $startday = $daypart;
        $endDay = '';

        //check for feb
        if($monthpart == 2 && $addDays > 29)
        {
            $diff = $addDays - $daypart;
            $endDay = $diff;
            $monthpart++;
        }
        elseif($monthpart != 2 && $addDays > 31)
        {
            $diff = $addDays - $daypart;
            $endDay = $diff;
            $monthpart++;
        }
        else
        {
            $endDay = $addDays;
            $monthpart = $monthpart;
        }
        $enddate = $yearpart.'-'.$monthpart.'-'.$endDay;
        $datee = array($datestring, $enddate);
        return $datee;
    }

    private function isSunday()
    {
        $Day = date('D');
        switch ($Day) {
            case 'Sun':
                $startDay = $this->addDays(0);
                break;
            case 'Mon':
                $startDay = $this->addDays(-1);
                break;
            case 'Tue':
                $startDay = $this->addDays(-2);
                break;
            case 'Wed':
                $startDay = $this->addDays(-3);
                break;
            case 'Thu':
                $startDay = $this->addDays(-4);
                break;
            case 'Fri':
                $startDay = $this->addDays(-5);
                break;
            case 'Sat':
                $startDay = $this->addDays(-6);
                break;
            
            default:
                # code...
                break;
        }

        switch ($Day) {
            case 'Sun':
                $endDay = $this->addDays(6);
                break;
            case 'Mon':
                $endDay = $this->addDays(5);
                break;
            case 'Tue':
                $endDay = $this->addDays(4);
                break;
            case 'Wed':
                $endDay = $this->addDays(3);
                break;
            case 'Thu':
                $endDay = $this->addDays(2);
                break;
            case 'Fri':
                $endDay = $this->addDays(1);
                break;
            case 'Sat':
                $endDay = $this->addDays(0);
                break;
            
            default:
                # code...
                break;
        }

        return $days = array($startDay, $endDay);
    }

    public function countChildrenDailyBirthDay($orgId)
    {
        $sql = "SELECT COUNT(Id)
                FROM children
                WHERE DAY(dateOfBirth) = '".$this->day()."' AND MONTH(dateOfBirth) = '".$this->month()."' AND orgId = '$orgId'";
        $stmt = DB::DBInstance()->query($sql);
        if($stmt)
        {
            $result = $stmt->getResults();
            return $result['COUNT(Id)'];
        }
    }

    public function countChildrenWeeklyBirthday($orgId)
    {
        $days = $this->isSunday();
        //$datee = $this->startAndEndDate();

        $sql = "SELECT COUNT(Id)
                FROM children
                WHERE DAY(dateOfBirth) BETWEEN $days[0] AND $days[1] AND MONTH(dateOfBirth) = '".$this->month()."' AND orgId = '$orgId'";
        $stmt = DB::DBInstance()->query($sql);
        if($stmt)
        {
            $result = $stmt->getResults();
            return $result['COUNT(Id)'];
        }
    }

    public function countMemberDailyBirthday($orgId)
    {
        $days = $this->isSunday();

        $sql = "SELECT COUNT(Id)
                FROM members
                WHERE DAY(dateOfBirth) = '".$this->day()."' AND MONTH(dateOfBirth) = '".$this->month()."' AND orgId = '$orgId'";
        $stmt = DB::DBInstance()->query($sql);
        if ($stmt) {
            $result = $stmt->getResults();
            return $result['COUNT(Id)'];
        }
    }

    public function countMemberWeekilyBirthday($orgId)
    {
        $days = $this->isSunday();

        $sql = "SELECT COUNT(Id)
                FROM members
                WHERE DAY(dateOfBirth) BETWEEN $days[0] AND $days[1] AND MONTH(dateOfBirth) = '".$this->month()."' AND orgId = '$orgId'";
        $stmt = DB::DBInstance()->query($sql);
        if($stmt)
        {
            $result = $stmt->getResults();
            return $result['COUNT(Id)'];
        }
    }

    public function countMemberDailyWeddingAnniversary($orgId)
    {
        $sql = "SELECT COUNT(Id)
                FROM members
                WHERE DAY(dateofmarriage) = '".$this->day()."' AND MONTH(dateofmarriage) = '".$this->month()."' AND orgId = '$orgId'";
        $stmt = DB::DBInstance()->query($sql);
        if ($stmt)
        {
            $result = $stmt->getResults();
            return $result['COUNT(Id)'];
        }
    }

    public function countMemberWeeklyWeddingAnniversary($orgId)
    {
        $days = $this->isSunday();

        $sql = "SELECT COUNT(Id)
                FROM members
                WHERE DAY(dateofmarriage) BETWEEN $days[0] AND $days[1] AND MONTH(dateofmarriage) = '".$this->month()."' AND orgId = '$orgId'";
        $stmt = DB::DBInstance()->query($sql);
        if($stmt)
        {
            $result = $stmt->getResults();
            return $result['COUNT(Id)'];
        }
    }

    public function getChildrenDailyBirthday($orgId)
    {
        $sql = "SELECT *
                FROM children
                WHERE DAY(dateOfBirth) = '".$this->day()."' AND MONTH(dateOfBirth) = '".$this->month()."' AND orgId = '$orgId'";
        $stmt = DB::DBInstance()->query($sql);
        if($stmt)
        {
            return $stmt;
        }
    }

    public function getChildrenWeeklyBirthday($orgId)
    {
        $days = $this->isSunday();

        $sql = "SELECT *
                FROM children
                WHERE DAY(dateOfBirth) BETWEEN $days[0] AND $days[1] AND MONTH(dateOfBirth) = '".$this->month()."' AND orgId = '$orgId'";
        $stmt = DB::DBInstance()->query($sql);
        if($stmt)
        {
            return $stmt;
        }
    }

    public function getMemberDailyBirthday($orgId)
    {
        $sql = "SELECT *
                FROM members
                WHERE DAY(dateOfBirth) = '".$this->day()."' AND MONTH(dateOfBirth) = '".$this->month()."' AND orgId = '$orgId'";
        $stmt = DB::DBInstance()->query($sql);
        if($stmt)
        {
            return $stmt;
        }
    }

    public function getMemberWeeklyBirthday($orgId)
    {
        $days = $this->isSunday();

        $sql = "SELECT *
                FROM members
                WHERE DAY(dateOfBirth) BETWEEN $days[0] AND $days[1] AND MONTH(dateOfBirth) = '".$this->month()."' AND orgId = '$orgId'";
        $stmt = DB::DBInstance()->query($sql);
        if($stmt)
        {
            return $stmt;
        }
    }

    public function getMemberDailyWeddingAnniversary($orgId)
    {
        $sql = "SELECT *
                FROM members
                WHERE DAY(dateofmarriage) = '".$this->day()."' AND MONTH(dateofmarriage) = '".$this->month()."' AND orgId = '$orgId'";
        $stmt = DB::DBInstance()->query($sql);

        if($stmt)
        {
            return $stmt;
        }
    }

    public function getMemberWeeklyWeddingAnniversary($orgId)
    {
        $days = $this->isSunday();

        $sql = "SELECT *
                FROM members
                WHERE DAY(dateofmarriage) BETWEEN $days[0] AND $days[1] AND MONTH(dateofmarriage) = '".$this->month()."' AND orgId = '$orgId'";
        $stmt = DB::DBInstance()->query($sql);
        if($stmt)
        {
            return $stmt;
        }
    }

    public function countFamilies($orgId)
    {
        $sql = "SELECT DISTINCT COUNT(Id)
                FROM members
                WHERE orgId = '$orgId'";
        $stmt = DB::DBInstance()->query($sql);
        if ($stmt)
        {
            $result = $stmt->getResults();
            return $result['COUNT(Id)'];
        }
    }

    public function avialableBalance($orgId)
    {
        $bal = new Balance($orgId, $_SESSION['userId']);
        return $bal->getBalance();
    }

    public function countTotalMembers($orgId)
    {
        $sql = "SELECT COUNT(Id) FROM members WHERE orgId = '$orgId' AND isAlive = 1";
        $run = DB::DBInstance()->query($sql);
        $result = $run->getResults();
        return $result['COUNT(Id)'];
    }

    public function countDeaths($orgId)
    {
        $sql = "SELECT COUNT(Id) FROM members WHERE orgId = '$orgId' AND isAlive = 0";
        $run = DB::DBInstance()->query($sql);
        $result = $run->getResults();
        return $result['COUNT(Id)'];
    }
}