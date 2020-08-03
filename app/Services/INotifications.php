<?php

interface INotifications
{
    public function countChildrenDailyBirthDay($orgId);

    public function countChildrenWeeklyBirthday($orgId);

    public function countMemberDailyBirthday($orgId);

    public function countMemberWeekilyBirthday($orgId);

    public function countMemberDailyWeddingAnniversary($orgId);

    public function countMemberWeeklyWeddingAnniversary($orgId);

    public function getChildrenDailyBirthday($orgId);

    public function getChildrenWeeklyBirthday($orgId);

    public function getMemberDailyBirthday($orgId);

    public function getMemberWeeklyBirthday($orgId);

    public function getMemberDailyWeddingAnniversary($orgId);

    public function getMemberWeeklyWeddingAnniversary($orgId);

    public function countFamilies($orgId);
}