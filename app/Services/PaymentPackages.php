<?php
class PaymentPackages
{
    public $packageName;
    public $packageDuration;
    public $packageCost;

    public $data;

    public function __construct()
    {
        $this->data = array();
    }
    public function addPackage($values)
    {
        $sql = "INSERT INTO paymentpackages (Id, packagename, duration, cost)
                VALUES (NULL, '".$values['packagename']."', '".$values['packageduration']."', '".$values['packagecost']."')";
        $stmt = DB::DBInstance()->query($sql);
        if($stmt)
        {
            return true;
        }
        return false;
    }

    public function deletePackage($packageId)
    {
        $sql = "DELETE FROM paymentpackages WHERE Id = '$packageId'";
        $run = DB::DBInstance()->query($sql);
        if($run)
        {
            return true;
        }
        return false;
    }

    public function readPackages()
    {
        $sql = "SELECT * FROM paymentpackages";
        $run = DB::DBInstance()->query($sql);
        if($run)
        {
            while($r = $run->getResults())
            {
                $this->data[] = $r;
            }
            return $this->data;
        }
    }

    public function getPackage($Id)
    {
        $sql = "SELECT * FROM paymentpackages WHERE Id = '$Id'";
        $run = DB::DBInstance()->query($sql);
        if($run)
        {
            return $run->getResults();
        }
    }

    public function updatePackage($values)
    {
        $sql = "UPDATE paymentpackages
                SET packagename = '".$values['packagename']."', 
                duration = '".$values['packageduration']."',
                cost = '".$values['packagecost']."'
                WHERE Id = '".$values['Id']."'";
        $stmt = DB::DBInstance()->query($sql);
        //var_dump($sql); die();

        if($stmt)
        {
            return true;
        }
        return false;
    }
}