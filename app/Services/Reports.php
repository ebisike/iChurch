<?php

class Reports
{
    public $monthsArray;
    public $currentYear;

    public function __construct() {
        //$this->monthsArray = array(1,2,3,4,5,6,7,8,9,10,11,12);
        $this->monthsArray = array(
            1=>"Jan",
            2=>"Feb",
            3=>"Mar",
            4=>"Apr",
            5=>"May",
            6=>"Jun",
            7=>"Jul",
            8=>"Aug",
            9=>"Sept",
            10=>"Oct",
            11=>"Nov",
            12=>"Dec");

        $this->currentYear = date('Y');
    }

    public function getAnnualCreditReport()
    {
        $data = array();        
        foreach ($this->monthsArray as $key => $value)
        {
            # code...
            $sql = "SELECT SUM(amount) AS totalCredit FROM transactions
                WHERE MONTH(systemdate) = '{$key}'
                AND YEAR(systemdate) = '{$this->currentYear}'
                AND transactiontype = 1
                AND orgId = '{$_SESSION['orgId']}'";

            $stmt = DB::DBInstance()->query($sql);
            $temp = array("month"=>"","total"=>0);

            while ($r = $stmt->getResults())
            {
                # code...
                $temp['month'] = $value;
                $temp['total'] = $r['totalCredit'];
            }
            //var_dump($temp); die();
            array_push($data, $temp);
        }
        return $data;
    }

    public function getAnnualCreditReportForSpecificYear($year)
    {
        $data = array();
        foreach ($this->monthsArray as $key => $value) {
            # code...
            $sql = "SELECT SUM(amount) AS totalCredit FROM transactions
                WHERE MONTH(systemdate) = '{$key}'
                AND YEAR(systemdate) = '{$year}'
                AND transactiontype = 1
                AND orgId = '{$_SESSION['orgId']}'";

            $stmt = DB::DBInstance()->query($sql);
            $temp = array("month"=>"","total"=>0);

            while ($r = $stmt->getResults())
            {
                # code...
                $temp['month'] = $value;
                $temp['total'] = $r['totalCredit'];
            }
            //var_dump($temp); die();
            array_push($data, $temp);
        }
        return $data;
    }

    public function getAnnualDebitReport()
    {
        $data = array();
        foreach ($this->monthsArray as $key => $value)
        {
            # code...
            $sql = "SELECT SUM(amount) as totalDebit
                    FROM transactions
                    WHERE MONTH(systemdate) = '{$key}'
                    AND YEAR(systemdate) = '{$this->currentYear}'
                    AND transactiontype = 0
                    AND orgId = '{$_SESSION['orgId']}'";

            $stmt = DB::DBInstance()->query($sql);
            $temp = array("month"=>"", "total"=>0);

            while ($r = $stmt->getResults())
            {
                # code...
                $temp['month'] = $value;
                $temp['total'] = $r['totalDebit'];
            }

            array_push($data, $temp);
        }

        return $data;
    }

    public function getAnnualDebitReportForSpecificYear($year)
    {
        $data = array();
        foreach ($this->monthsArray as $key => $value)
        {
            # code...
            $sql = "SELECT SUM(amount) as totalDebit
                    FROM transactions
                    WHERE MONTH(systemdate) = '{$key}'
                    AND YEAR(systemdate) = '{$year}'
                    AND transactiontype = 0
                    AND orgId = '{$_SESSION['orgId']}'";

            $stmt = DB::DBInstance()->query($sql);
            $temp = array("month"=>"", "total"=>0);

            while ($r = $stmt->getResults())
            {
                # code...
                $temp['month'] = $value;
                $temp['total'] = $r['totalDebit'];
            }

            array_push($data, $temp);
        }

        return $data;
    }

    private function getSourceList()
    {
        #THOUGHT
        # GET ALL DISTINCT TRANSACTION SOURCE IN AN ARRAY
        #ITRATE THROUGH THE ARRAY AND GET SUM OF EACH AMOUNT FOR EACH PARTICULAR SOURCE
        $sourceList = array();
        $sql = "SELECT DISTINCT source FROM transactions
                WHERE orgId = '".$_SESSION['orgId']."'";
        $stmt = DB::DBInstance()->query($sql);
        if($stmt)
        {
            while($source = $stmt->getResults())
            {
                $sourceList[] = $source;
            }
            return $sourceList;
            //json_encode($sourceList, JSON_PRETTY_PRINT);
            //var_dump(json_encode($sourceList, JSON_PRETTY_PRINT));
        }
    }

    public function getIncomeSourceSummary()
    {
        $SOURCELIST = $this->getSourceList();
        $data = array();        
        
        for ($i=0; $i < count($SOURCELIST); $i++) { 
            # code...
            $sql = "SELECT source, amount FROM transactions
                WHERE orgId = '{$_SESSION['orgId']}'
                AND transactiontype = 1
                AND YEAR(systemdate) = '{$this->currentYear}'
                AND source = '{$SOURCELIST[$i]['source']}'";

            $stmt = DB::DBInstance()->query($sql);


            $temp = array('source'=>'', 'sum'=>0);
            while ($r = $stmt->getResults()) {
                # code...
                // if($r['source'] == $SOURCELIST[$i]['source']){
                //     $temp['sum'] += $r['amount'];
                // }
                $temp['sum'] = $r['amount']  ? $temp['sum'] += $r['amount'] : $temp['sum'] += 0;
                //$temp['sum'] += $r['amount'];                
            }
            $temp['source'] = $SOURCELIST[$i]['source'];

            //push to array
            array_push($data, $temp);
        }

        //var_dump($data); die();
        return $data;
    }

    public function getExpenditureSourceSummary()
    {
        $data = array();
        $SOURCELIST = $this->getSourceList(); //get distinct sources for transactions
        //var_dump($sourceList);
        for ($i=0; $i < count($SOURCELIST); $i++)
        { 
            $sql = "SELECT source, amount FROM transactions
                WHERE orgId = '{$_SESSION['orgId']}'
                AND transactiontype = 0
                AND YEAR(systemdate) = '{$this->currentYear}'
                AND source = '{$SOURCELIST[$i]['source']}'";

            $run = DB::DBInstance()->query($sql);
            $temp = array("source"=>"","sum"=>0);
            while ($r = $run->getResults())
            {
                //echo $r['amount'].' = '.$sourceList[$i]['source'].'<br>';
                $temp['sum'] = $r['amount']  ? $temp['sum'] += $r['amount'] : $temp['sum'] += 0;
            }
            $temp['source'] = $SOURCELIST[$i]['source'];
            //$temp['source'] = $r['source'];


            array_push($data, $temp);
        }
        //var_dump($data); die();
        return $data;
    }
}