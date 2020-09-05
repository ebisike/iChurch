<?php
class SeedPaymentPackages
{
    public $freeSubscription;
    public $monthlySubscription;
    public $quaterlySubscription;
    public $semiAnnuallySubscription;
    public $annualSubscription;

    public $package;

    public function __construct()
    {
        $this->freeSubscription = 
        [
            "packagename" => "free Activation",
            "packageduration" => 0, //two weeks (14days)
            "packagecost" => 0
        ];

        $this->monthlySubscription = 
        [
            "packagename" => "starter pack",
            "packageduration" => 1, //one month (30days)
            "packagecost" => 10000
        ];

        $this->quaterlySubscription = 
        [
            "packagename" => "basic pack",
            "packageduration" => 4, //3months (120 days)
            "packagecost" => 35000
        ];

        $this->semiAnnuallySubscription = 
        [
            "packagename" => "pro pack",
            "packageduration" => 6, //6months (180 days)
            "packagecost" => 50000
        ];

        $this->annualSubscription =
        [
            "packagename" => "lengend pack",
            "packageduration" => 12, //12months (365 days)
            "packagecost" => 100000
        ];

        $this->package = new PaymentPackages();        
    }

    public function seedFreePackage()
    {
        $this->package->addPackage($this->freeSubscription);
    }

    public function seedMonthlyPackage()
    {
        $this->package->addPackage($this->monthlySubscription);
    }

    public function seedQuaterlyPackage()
    {
        $this->package->addPackage($this->quaterlySubscription);
    }

    public function seedSemiAnnualPackage()
    {
        $this->package->addPackage($this->semiAnnuallySubscription);
    }

    public function seedAnnualPackage()
    {
        $this->package->addPackage($this->annualSubscription);
    }
}