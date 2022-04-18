<?php

class Order
{
    protected $connection;

    protected $ID;
    protected $date;
    protected $user; // customer
    protected $good;
    protected $price;
    protected $qty;
    protected $cost;
    protected $paymentMethod;
    protected $installmentCard;
    protected $deliveryOption;

    //constructor
    public function __construct($connection)
    {
        $this->setConnection($connection);

        $a = func_get_args();
        $i = func_num_args();
        if (method_exists($this, $f = '__construct' . $i)) {
            call_user_func_array(array($this, $f), $a);
        }
    }

    public function __construct1($connection)
    {
    }

    public function __construct2($connection, $ID)
    {
        $this->read($ID);
    }

    public function __toString()
    {
        $vars = get_object_vars($this);
        $fixed = [];
        foreach ($vars as $key => $value) {
            $fixedKey = ucfirst($key);
            $fixedKey = $key === "qty" ? "QTY" : $fixedKey;

            $fixed[$fixedKey] = $value;
        }
        return json_encode($fixed, true);
    }

    public function getFixedObj()
    {
        $vars = get_object_vars($this);
        $fixed = [];
        foreach ($vars as $key => $value) {
            if ($key == "connection" || $key == "feedback") {
                continue;
            }
            $fixedKey = ucfirst($key);
            $fixed[$fixedKey] = $value;
        }
        return $fixed;
    }

    public function expose()
    {
        return get_object_vars($this);
    }

    // CRUD OPERATIONS
    public function create(array $data)
    {
        $delim1 = "";
        $delim2 = "";
        $fields = "";
        $values = "";

        $data["Date"] = date("Y-m-d");

        foreach ($data as $key => $value) {
            $fields .= $delim1 . "`$key`";
            $delim1 = ",";

            $values .= $delim2 . "'$value'";
            $delim2 = ",";
        }

        $query = "INSERT INTO __document15 ($fields) VALUES ($values)";

        $result = mysqli_query($this->connection, $query)
            or die(mysqli_error($this->connection));

        $this->ID = mysqli_insert_id($this->connection);
        return $this->ID;
    }

    public function read(int $ID)
    {
        $query = "SELECT * FROM __document15 WHERE ID=$ID";

        $result = mysqli_query($this->connection, $query)
            or die(mysqli_error($this->connection));

        if ($row = mysqli_fetch_assoc($result)) {

            foreach ($row as $key => $value) {

                try {
                    $fixedKey = $key == "ID" ? $key : lcfirst($key);
                    $fixedKey = $key == "QTY" ? "qty" : $key;
                    $this->{$fixedKey} = $value;
                } catch (Throwable $t) {
                }
            }
        }

        return $this;
    }

    /**
     * Get the value of connection
     */ 
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * Set the value of connection
     *
     * @return  self
     */ 
    public function setConnection($connection)
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
     *
     * @return  self
     */ 
    public function setID($ID)
    {
        $this->ID = $ID;

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
     *
     * @return  self
     */ 
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of good
     */ 
    public function getGood()
    {
        return $this->good;
    }

    /**
     * Set the value of good
     *
     * @return  self
     */ 
    public function setGood($good)
    {
        $this->good = $good;

        return $this;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = $price;

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
     *
     * @return  self
     */ 
    public function setQty($qty)
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
     *
     * @return  self
     */ 
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Get the value of paymentMethod
     */ 
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    /**
     * Set the value of paymentMethod
     *
     * @return  self
     */ 
    public function setPaymentMethod($paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    /**
     * Get the value of installmentCard
     */ 
    public function getInstallmentCard()
    {
        return $this->installmentCard;
    }

    /**
     * Set the value of installmentCard
     *
     * @return  self
     */ 
    public function setInstallmentCard($installmentCard)
    {
        $this->installmentCard = $installmentCard;

        return $this;
    }

    /**
     * Get the value of deliveryOption
     */ 
    public function getDeliveryOption()
    {
        return $this->deliveryOption;
    }

    /**
     * Set the value of deliveryOption
     *
     * @return  self
     */ 
    public function setDeliveryOption($deliveryOption)
    {
        $this->deliveryOption = $deliveryOption;

        return $this;
    }
}
