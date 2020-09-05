<?php
//obsollete
class Account
{
    public function signin($values)
    {
        $sql = "SELECT * FROM users WHERE username = '".$values['username']."' AND passwords = '".$values['passwords']."'";
        $runsql = DB::DBInstance()->query($sql);

        if($runsql->isExist())
        {
            $result = $runsql->getResults();
            //verify organisation
            $org = $this->verifyOrganisation($result['orgId']);
            if($org)
            {
                return $result;
            }
            return false;
        }
    }

    private function verifyOrganisation($orgId)
    {
        $sql = "SELECT * FROM organisation WHERE id = '$orgId'";
        $run = DB::DBInstance()->query($sql);
        if($run->isExist())
        {
            return true;
        }
        return false;
    }

    public function signout($values)
    {
        $sql = '';
    }
}