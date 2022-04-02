<?php

class Order
{
    protected $connection;

    protected $ID;
    protected $ownerID; // owner
    protected $userID; // customer

    protected $goodID;
    protected $qty;
    protected $cost;

    protected $date;

    /**
     * Get the value of connection
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * Set the value of connection
     */
    public function setConnection($connection): self
    {
        $this->connection = $connection;

        return $this;
    }

    /**
     * Get the value of ID
     */
    public function getID()
    {
        return $this->ID;
    }

    /**
     * Set the value of ID
     */
    public function setID($ID): self
    {
        $this->ID = $ID;

        return $this;
    }

    /**
     * Get the value of ownerID
     */
    public function getOwnerID()
    {
        return $this->ownerID;
    }

    /**
     * Set the value of ownerID
     */
    public function setOwnerID($ownerID): self
    {
        $this->ownerID = $ownerID;

        return $this;
    }

    /**
     * Get the value of userID
     */
    public function getUserID()
    {
        return $this->userID;
    }

    /**
     * Set the value of userID
     */
    public function setUserID($userID): self
    {
        $this->userID = $userID;

        return $this;
    }

    /**
     * Get the value of goodID
     */
    public function getGoodID()
    {
        return $this->goodID;
    }

    /**
     * Set the value of goodID
     */
    public function setGoodID($goodID): self
    {
        $this->goodID = $goodID;

        return $this;
    }

    /**
     * Get the value of qty
     */
    public function getQty()
    {
        return $this->qty;
    }

    /**
     * Set the value of qty
     */
    public function setQty($qty): self
    {
        $this->qty = $qty;

        return $this;
    }

    /**
     * Get the value of cost
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Set the value of cost
     */
    public function setCost($cost): self
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Get the value of date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     */
    public function setDate($date): self
    {
        $this->date = $date;

        return $this;
    }
    
}
