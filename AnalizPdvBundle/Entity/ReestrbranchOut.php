<?php

namespace AnalizPdvBundle\Entity;

/**
 * ReestrbranchOut
 */
class ReestrbranchOut
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $month = '0';

    /**
     * @var integer
     */
    private $year = '0';

    /**
     * @var string
     */
    private $numBranch;

    /**
     * @var \DateTime
     */
    private $dateCreateInvoice;

    /**
     * @var string
     */
    private $numInvoice;

    /**
     * @var string
     */
    private $typeInvoiceFull;

    /**
     * @var string
     */
    private $typeInvoice;

    /**
     * @var string
     */
    private $nameClient;

    /**
     * @var string
     */
    private $innClient;

    /**
     * @var float
     */
    private $zagSumm;

    /**
     * @var float
     */
    private $baza20;

    /**
     * @var float
     */
    private $pdv20;

    /**
     * @var float
     */
    private $baza7;

    /**
     * @var float
     */
    private $pdv7;

    /**
     * @var float
     */
    private $baza0;

    /**
     * @var float
     */
    private $bazaZvil;

    /**
     * @var float
     */
    private $bazaNeObj;

    /**
     * @var float
     */
    private $bazaZaMezhiTovar;

    /**
     * @var float
     */
    private $bazaZaMezhiPoslug;

    /**
     * @var \DateTime
     */
    private $rkeDateCreateInvoice;

    /**
     * @var string
     */
    private $rkeNumInvoice;

    /**
     * @var string
     */
    private $rkePidstava;

    /**
     * @var string
     */
    private $keyField;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set month
     *
     * @param integer $month
     *
     * @return ReestrbranchOut
     */
    public function setMonth($month)
    {
        $this->month = $month;

        return $this;
    }

    /**
     * Get month
     *
     * @return integer
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * Set year
     *
     * @param integer $year
     *
     * @return ReestrbranchOut
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return integer
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set numBranch
     *
     * @param string $numBranch
     *
     * @return ReestrbranchOut
     */
    public function setNumBranch($numBranch)
    {
        $this->numBranch = $numBranch;

        return $this;
    }

    /**
     * Get numBranch
     *
     * @return string
     */
    public function getNumBranch()
    {
        return $this->numBranch;
    }

    /**
     * Set dateCreateInvoice
     *
     * @param \DateTime $dateCreateInvoice
     *
     * @return ReestrbranchOut
     */
    public function setDateCreateInvoice($dateCreateInvoice)
    {
        $this->dateCreateInvoice = $dateCreateInvoice;

        return $this;
    }

    /**
     * Get dateCreateInvoice
     *
     * @return \DateTime
     */
    public function getDateCreateInvoice()
    {
        return $this->dateCreateInvoice;
    }

    /**
     * Set numInvoice
     *
     * @param string $numInvoice
     *
     * @return ReestrbranchOut
     */
    public function setNumInvoice($numInvoice)
    {
        $this->numInvoice = $numInvoice;

        return $this;
    }

    /**
     * Get numInvoice
     *
     * @return string
     */
    public function getNumInvoice()
    {
        return $this->numInvoice;
    }

    /**
     * Set typeInvoiceFull
     *
     * @param string $typeInvoiceFull
     *
     * @return ReestrbranchOut
     */
    public function setTypeInvoiceFull($typeInvoiceFull)
    {
        $this->typeInvoiceFull = $typeInvoiceFull;

        return $this;
    }

    /**
     * Get typeInvoiceFull
     *
     * @return string
     */
    public function getTypeInvoiceFull()
    {
        return $this->typeInvoiceFull;
    }

    /**
     * Set typeInvoice
     *
     * @param string $typeInvoice
     *
     * @return ReestrbranchOut
     */
    public function setTypeInvoice($typeInvoice)
    {
        $this->typeInvoice = $typeInvoice;

        return $this;
    }

    /**
     * Get typeInvoice
     *
     * @return string
     */
    public function getTypeInvoice()
    {
        return $this->typeInvoice;
    }

    /**
     * Set nameClient
     *
     * @param string $nameClient
     *
     * @return ReestrbranchOut
     */
    public function setNameClient($nameClient)
    {
        $this->nameClient = $nameClient;

        return $this;
    }

    /**
     * Get nameClient
     *
     * @return string
     */
    public function getNameClient()
    {
        return $this->nameClient;
    }

    /**
     * Set innClient
     *
     * @param string $innClient
     *
     * @return ReestrbranchOut
     */
    public function setInnClient($innClient)
    {
        $this->innClient = $innClient;

        return $this;
    }

    /**
     * Get innClient
     *
     * @return string
     */
    public function getInnClient()
    {
        return $this->innClient;
    }

    /**
     * Set zagSumm
     *
     * @param float $zagSumm
     *
     * @return ReestrbranchOut
     */
    public function setZagSumm($zagSumm)
    {
        $this->zagSumm = $zagSumm;

        return $this;
    }

    /**
     * Get zagSumm
     *
     * @return float
     */
    public function getZagSumm()
    {
        return $this->zagSumm;
    }

    /**
     * Set baza20
     *
     * @param float $baza20
     *
     * @return ReestrbranchOut
     */
    public function setBaza20($baza20)
    {
        $this->baza20 = $baza20;

        return $this;
    }

    /**
     * Get baza20
     *
     * @return float
     */
    public function getBaza20()
    {
        return $this->baza20;
    }

    /**
     * Set pdv20
     *
     * @param float $pdv20
     *
     * @return ReestrbranchOut
     */
    public function setPdv20($pdv20)
    {
        $this->pdv20 = $pdv20;

        return $this;
    }

    /**
     * Get pdv20
     *
     * @return float
     */
    public function getPdv20()
    {
        return $this->pdv20;
    }

    /**
     * Set baza7
     *
     * @param float $baza7
     *
     * @return ReestrbranchOut
     */
    public function setBaza7($baza7)
    {
        $this->baza7 = $baza7;

        return $this;
    }

    /**
     * Get baza7
     *
     * @return float
     */
    public function getBaza7()
    {
        return $this->baza7;
    }

    /**
     * Set pdv7
     *
     * @param float $pdv7
     *
     * @return ReestrbranchOut
     */
    public function setPdv7($pdv7)
    {
        $this->pdv7 = $pdv7;

        return $this;
    }

    /**
     * Get pdv7
     *
     * @return float
     */
    public function getPdv7()
    {
        return $this->pdv7;
    }

    /**
     * Set baza0
     *
     * @param float $baza0
     *
     * @return ReestrbranchOut
     */
    public function setBaza0($baza0)
    {
        $this->baza0 = $baza0;

        return $this;
    }

    /**
     * Get baza0
     *
     * @return float
     */
    public function getBaza0()
    {
        return $this->baza0;
    }

    /**
     * Set bazaZvil
     *
     * @param float $bazaZvil
     *
     * @return ReestrbranchOut
     */
    public function setBazaZvil($bazaZvil)
    {
        $this->bazaZvil = $bazaZvil;

        return $this;
    }

    /**
     * Get bazaZvil
     *
     * @return float
     */
    public function getBazaZvil()
    {
        return $this->bazaZvil;
    }

    /**
     * Set bazaNeObj
     *
     * @param float $bazaNeObj
     *
     * @return ReestrbranchOut
     */
    public function setBazaNeObj($bazaNeObj)
    {
        $this->bazaNeObj = $bazaNeObj;

        return $this;
    }

    /**
     * Get bazaNeObj
     *
     * @return float
     */
    public function getBazaNeObj()
    {
        return $this->bazaNeObj;
    }

    /**
     * Set bazaZaMezhiTovar
     *
     * @param float $bazaZaMezhiTovar
     *
     * @return ReestrbranchOut
     */
    public function setBazaZaMezhiTovar($bazaZaMezhiTovar)
    {
        $this->bazaZaMezhiTovar = $bazaZaMezhiTovar;

        return $this;
    }

    /**
     * Get bazaZaMezhiTovar
     *
     * @return float
     */
    public function getBazaZaMezhiTovar()
    {
        return $this->bazaZaMezhiTovar;
    }

    /**
     * Set bazaZaMezhiPoslug
     *
     * @param float $bazaZaMezhiPoslug
     *
     * @return ReestrbranchOut
     */
    public function setBazaZaMezhiPoslug($bazaZaMezhiPoslug)
    {
        $this->bazaZaMezhiPoslug = $bazaZaMezhiPoslug;

        return $this;
    }

    /**
     * Get bazaZaMezhiPoslug
     *
     * @return float
     */
    public function getBazaZaMezhiPoslug()
    {
        return $this->bazaZaMezhiPoslug;
    }

    /**
     * Set rkeDateCreateInvoice
     *
     * @param \DateTime $rkeDateCreateInvoice
     *
     * @return ReestrbranchOut
     */
    public function setRkeDateCreateInvoice($rkeDateCreateInvoice)
    {
        $this->rkeDateCreateInvoice = $rkeDateCreateInvoice;

        return $this;
    }

    /**
     * Get rkeDateCreateInvoice
     *
     * @return \DateTime
     */
    public function getRkeDateCreateInvoice()
    {
        return $this->rkeDateCreateInvoice;
    }

    /**
     * Set rkeNumInvoice
     *
     * @param string $rkeNumInvoice
     *
     * @return ReestrbranchOut
     */
    public function setRkeNumInvoice($rkeNumInvoice)
    {
        $this->rkeNumInvoice = $rkeNumInvoice;

        return $this;
    }

    /**
     * Get rkeNumInvoice
     *
     * @return string
     */
    public function getRkeNumInvoice()
    {
        return $this->rkeNumInvoice;
    }

    /**
     * Set rkePidstava
     *
     * @param string $rkePidstava
     *
     * @return ReestrbranchOut
     */
    public function setRkePidstava($rkePidstava)
    {
        $this->rkePidstava = $rkePidstava;

        return $this;
    }

    /**
     * Get rkePidstava
     *
     * @return string
     */
    public function getRkePidstava()
    {
        return $this->rkePidstava;
    }

    /**
     * Set keyField
     *
     * @param string $keyField
     *
     * @return ReestrbranchOut
     */
    public function setKeyField($keyField)
    {
        $this->keyField = $keyField;

        return $this;
    }

    /**
     * Get keyField
     *
     * @return string
     */
    public function getKeyField()
    {
        return $this->keyField;
    }
}

