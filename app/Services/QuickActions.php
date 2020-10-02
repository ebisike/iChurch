<?php

class QuickActions
{
    public function ChildrenWeeklyBirthday($startDate, $endDate, $orgId)
    {
        $startDay = date('d', strtotime($startDate));
        $endDay = date('d', strtotime($endDate));
        $startMonth = date('m', strtotime($startDate));
        $endMonth = date('m', strtotime($endDate));
        $sql = "SELECT *
            FROM children
            WHERE DAY(dateOfBirth) BETWEEN $startDay AND $endDay AND MONTH(dateOfBirth) BETWEEN $startMonth AND $endMonth AND orgId = '$orgId'";
        $stmt = DB::DBInstance()->query($sql);
        if ($stmt) {
            return $stmt;
        }
    }

    public function AdultsWeeklyBirthday($startDate, $endDate, $orgId)
    {
        $startDay = date('d', strtotime($startDate));
        $endDay = date('d', strtotime($endDate));
        $startMonth = date('m', strtotime($startDate));
        $endMonth = date('m', strtotime($endDate));
        $sql = "SELECT *
            FROM members
            WHERE DAY(dateOfBirth) BETWEEN $startDay AND $endDay
            AND MONTH(dateOfBirth) BETWEEN $startMonth AND $endMonth
            AND orgId = '$orgId'";

        $stmt = DB::DBInstance()->query($sql);
        if ($stmt) {
            return $stmt;
        }
    }

    public function WeddingAnniversary($startDate, $endDate, $orgId)
    {
        $startDay = date('d', strtotime($startDate));
        $endDay = date('d', strtotime($endDate));
        $startMonth = date('m', strtotime($startDate));
        $endMonth = date('m', strtotime($endDate));

        $sql = "SELECT *
            FROM members
            WHERE DAY(dateofmarriage) BETWEEN $startDay AND $endDay
            AND MONTH(dateofmarriage) BETWEEN $startMonth AND $endMonth
            AND orgId = '$orgId'";
            
        $stmt = DB::DBInstance()->query($sql); //var_dump($sql); die();
        if($stmt)
        {
            return $stmt;
        }
    }

    public function familyTree($familyId, $orgId)
    {
        $sql = "SELECT *
            FROM members
            WHERE familyId = '$familyId'
            AND orgId = '$orgId' limit 6";
            
        $stmt = DB::DBInstance()->query($sql); //var_dump($sql); die();
        if($stmt)
        {
            return $stmt;
        }
    }
}
