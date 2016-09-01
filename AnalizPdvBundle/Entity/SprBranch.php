<?php

namespace LoadFileBundle\Entity;

/**
 * SprBranch
 */
class SprBranch
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $NumBranch;

    /**
     * @var string
     */
    private $NameBranch;

    /**
     * @var string
     */
    private $BranchAdr;

    /**
     * @var string
     */
    private $NameMainBranch;

    /**
     * @var string
     */
    private $NumMainBranch;


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
     * Set numBranch
     *
     * @param string $numBranch
     *
     * @return SprBranch
     */
    public function setNumBranch($numBranch)
    {
        $this->NumBranch = $numBranch;

        return $this;
    }

    /**
     * Get numBranch
     *
     * @return string
     */
    public function getNumBranch()
    {
        return $this->NumBranch;
    }

    /**
     * Set nameBranch
     *
     * @param string $nameBranch
     *
     * @return SprBranch
     */
    public function setNameBranch($nameBranch)
    {
        $this->NameBranch = $nameBranch;

        return $this;
    }

    /**
     * Get nameBranch
     *
     * @return string
     */
    public function getNameBranch()
    {
        return $this->NameBranch;
    }

    /**
     * Set branchAdr
     *
     * @param string $branchAdr
     *
     * @return SprBranch
     */
    public function setBranchAdr($branchAdr)
    {
        $this->BranchAdr = $branchAdr;

        return $this;
    }

    /**
     * Get branchAdr
     *
     * @return string
     */
    public function getBranchAdr()
    {
        return $this->BranchAdr;
    }

    /**
     * Set nameMainBranch
     *
     * @param string $nameMainBranch
     *
     * @return SprBranch
     */
    public function setNameMainBranch($nameMainBranch)
    {
        $this->NameMainBranch = $nameMainBranch;

        return $this;
    }

    /**
     * Get nameMainBranch
     *
     * @return string
     */
    public function getNameMainBranch()
    {
        return $this->NameMainBranch;
    }

    /**
     * Set numMainBranch
     *
     * @param string $numMainBranch
     *
     * @return SprBranch
     */
    public function setNumMainBranch($numMainBranch)
    {
        $this->NumMainBranch = $numMainBranch;

        return $this;
    }

    /**
     * Get numMainBranch
     *
     * @return string
     */
    public function getNumMainBranch()
    {
        return $this->NumMainBranch;
    }
}
