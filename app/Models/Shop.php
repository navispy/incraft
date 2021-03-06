<?php
//namespace App\Models;

require_once "./setup.php";
require_once "Good.php";

class Shop
{
    protected $connection;

    protected $ID;
    protected $userID; //owner
    protected $name;
    protected $category;
    protected $paymentMethod_01;
    protected $paymentMethod_02;
    protected $paymentMethod_03;
    protected $paymentMethod_04;
    protected $paymentMethod_05;
    protected $paymentMethod_06;
    protected $paymentMethod_07;
    protected $installmentCard_01;
    protected $installmentCard_02;
    protected $installmentCard_03;
    protected $installmentCard_04;
    protected $installmentCard_05;
    protected $installmentCard_06;
    protected $installmentCard_07;
    protected $installmentCard_08;
    protected $deliveryOption_01;
    protected $deliveryOption_02;
    protected $deliveryOption_03;
    protected $deliveryOption_04;
    protected $deliveryOption_04_address;
    protected $deliveryOption_05;
    protected $deliveryOption_06;
    protected $deliveryOption_07;
    protected $deliveryOption_08;
    protected $isPublished;

    protected $region;
    protected $district;
    protected $address;
    protected $phone;
    protected $photo;

    protected $goods = [];

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

    public static function doesExist($ID, $connection)
    {
        $query = "SELECT * FROM __catalog45 WHERE ID=$ID";

        $result = mysqli_query($connection, $query)
        or die(mysqli_error($connection));

        return $row = mysqli_fetch_array($result);
    }

    public static function hasDupShopName($connection, $shopID, $shopName)
    {
        $query = "SELECT * FROM __catalog45 WHERE Name = '$shopName' AND ID <> $shopID";

        $result = mysqli_query($connection, $query)
        or die(mysqli_error($connection));

        $hasDupShopName = false;
        if ($row = mysqli_fetch_array($result)) {
            $hasDupShopName = true;
        }

        return $hasDupShopName;
    }

    public static function hasUserDupShopName($connection, $userID, $shopName)
    {
        $query = "SELECT * FROM __catalog45 WHERE Name = '$shopName' AND UserID = $userID";

        $result = mysqli_query($connection, $query)
        or die(mysqli_error($connection));

        $hasDupShopName = false;
        if ($row = mysqli_fetch_array($result)) {
            $hasDupShopName = true;
        }

        return $hasDupShopName;
    }

    public static function getShopName($connection, $shopID)
    {
        $query = "SELECT Name FROM __catalog45 WHERE ID = $shopID";

        $result = mysqli_query($connection, $query)
        or die(mysqli_error($connection));

        $name = "";
        if ($row = mysqli_fetch_array($result)) {
            $name = $row["Name"];
        }

        return $name;
    }

    public static function getShopPhone($connection, $shopID)
    {
        $query = "SELECT Phone FROM __catalog45 WHERE ID = $shopID";

        $result = mysqli_query($connection, $query)
        or die(mysqli_error($connection));

        $phone = "";
        if ($row = mysqli_fetch_array($result)) {
            $phone = $row["Phone"];
        }

        return $phone;
    }


    public function __toString()
    {
        $vars = get_object_vars($this);
        $fixed = [];
        foreach($vars as $key => $value) {
            if($key === "connection") {
                continue;
            } 
            $fixedKey = ucfirst($key);
            $fixed[$fixedKey] = $value;
        }

        $fixedGoods = [];
        foreach ($this->goods as $good) {
            $fixedGood = [];
            foreach($good as $key => $value) {
                if($key == "connection") {
                    continue;
                }
                $fixedKey = ucfirst($key);
                $fixedGood[$fixedKey] = $value;
            }
            $fixedGoods[] = $fixedGood;
        };

        $fixed["Goods"] = $fixedGoods; //$this->shops;

        return json_encode($fixed, true);
    }

    public function expose() {
        return get_object_vars($this);
    }

    // CRUD OPERATIONS
    public function create(array $data)
    {
        $delim1 = "";
        $delim2 = "";
        $fields = "";
        $values = "";

        foreach ($data as $key => $value) {
            $fields .= $delim1 . "`$key`";
            $delim1 = ",";

            $values .= $delim2 . "'$value'";
            $delim2 = ",";
        }

        $query = "INSERT INTO __catalog45 ($fields) VALUES ($values)";

        $result = mysqli_query($this->connection, $query)
        or die(mysqli_error($this->connection));

        $this->ID = mysqli_insert_id($this->connection);
        return $this->ID;
    }

    public function read(int $ID)
    {
        $query = "SELECT * FROM __catalog45 WHERE ID=$ID";

        $result = mysqli_query($this->connection, $query)
        or die(mysqli_error($this->connection));

        if ($row = mysqli_fetch_assoc($result)) {
            
            foreach ($row as $key => $value) {

                try {
                    $fixedKey = $key == "ID" ? $key : lcfirst($key);
                    $this->{$fixedKey} = $value;
                } catch (Throwable $t) {

                }
            }
        }

        $this->goods = $this->readGoods();

        return $this;
    }

    public function update(array $data)
    {
        $shopID = $this->getID();

        $query = "UPDATE __catalog45
        SET";

        $delim = "";
        foreach ($data as $field => $value) {
            if ($field === "ID" || $field === "Connection" || $field === "Goods") {
                continue;
            }
            $query .= "$delim `$field`='$value'";
            $delim = " ,";
        }

        $query .= " WHERE ID=$shopID";

        $result = mysqli_query($this->connection, $query)
        or die(mysqli_error($this->connection));
    }

    public static function delete($connection, int $ID)
    {
        $query = "DELETE FROM `__catalog45`
        WHERE ID=$ID";

        $result = mysqli_query($connection, $query)
        or die(mysqli_error($connection));
    }

    //setters / getters
    public function getConnection()
    {
        return $this->connection;
    }

    public function setConnection($connection)
    {
        $this->connection = $connection;

        return $this;
    }

    public function getID()
    {
        return $this->ID;
    }

    public function setID($ID)
    {
        $this->ID = $ID;
    }

    public function getUserID()
    {
        return $this->userID;
    }

    public function setUserID($userID)
    {
        $this->userID = $userID;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function getPaymentMethod_01()
    {
        return $this->paymentMethod_01;
    }

    public function setPaymentMethod_01($paymentMethod_01)
    {
        $this->paymentMethod_01 = $paymentMethod_01;
    }

    public function getPaymentMethod_02()
    {
        return $this->paymentMethod_02;
    }

    public function setPaymentMethod_02($paymentMethod_02)
    {
        $this->paymentMethod_02 = $paymentMethod_02;
    }

    public function getPaymentMethod_03()
    {
        return $this->paymentMethod_03;
    }

    public function setPaymentMethod_03($paymentMethod_03)
    {
        $this->paymentMethod_03 = $paymentMethod_03;

        return $this;
    }

    public function getPaymentMethod_04()
    {
        return $this->paymentMethod_04;
    }

    public function setPaymentMethod_04($paymentMethod_04)
    {
        $this->paymentMethod_04 = $paymentMethod_04;
    }

    public function getPaymentMethod_05()
    {
        return $this->paymentMethod_05;
    }

    public function setPaymentMethod_05($paymentMethod_05)
    {
        $this->paymentMethod_05 = $paymentMethod_05;
    }

    public function getPaymentMethod_06()
    {
        return $this->paymentMethod_06;
    }

    public function setPaymentMethod_06($paymentMethod_06)
    {
        $this->paymentMethod_06 = $paymentMethod_06;
    }

    public function getPaymentMethod_07()
    {
        return $this->paymentMethod_07;
    }

    public function setPaymentMethod_07($paymentMethod_07)
    {
        $this->paymentMethod_07 = $paymentMethod_07;
    }

    public function getInstallmentCard_01()
    {
        return $this->installmentCard_01;
    }

    public function setInstallmentCard_01($installmentCard_01)
    {
        $this->installmentCard_01 = $installmentCard_01;
    }

    public function getInstallmentCard_02()
    {
        return $this->installmentCard_02;
    }

    public function setInstallmentCard_02($installmentCard_02)
    {
        $this->installmentCard_02 = $installmentCard_02;
    }

    public function getInstallmentCard_03()
    {
        return $this->installmentCard_03;
    }

    public function setInstallmentCard_03($installmentCard_03)
    {
        $this->installmentCard_03 = $installmentCard_03;
    }

    public function getInstallmentCard_04()
    {
        return $this->installmentCard_04;
    }

    public function setInstallmentCard_04($installmentCard_04)
    {
        $this->installmentCard_04 = $installmentCard_04;
    }

    public function getInstallmentCard_05()
    {
        return $this->installmentCard_05;
    }

    public function setInstallmentCard_05($installmentCard_05)
    {
        $this->installmentCard_05 = $installmentCard_05;
    }

    public function getInstallmentCard_06()
    {
        return $this->installmentCard_06;
    }

    public function setInstallmentCard_06($installmentCard_06)
    {
        $this->installmentCard_06 = $installmentCard_06;
    }

    public function getInstallmentCard_07()
    {
        return $this->installmentCard_07;
    }

    public function setInstallmentCard_07($installmentCard_07)
    {
        $this->installmentCard_07 = $installmentCard_07;
    }

    public function getInstallmentCard_08()
    {
        return $this->installmentCard_08;
    }

    public function setInstallmentCard_08($installmentCard_08)
    {
        $this->installmentCard_08 = $installmentCard_08;
    }

    public function getDeliveryOption_01()
    {
        return $this->deliveryOption_01;
    }

    public function setDeliveryOption_01($deliveryOption_01)
    {
        $this->deliveryOption_01 = $deliveryOption_01;
    }

    public function getDeliveryOption_02()
    {
        return $this->deliveryOption_02;
    }

    public function setDeliveryOption_02($deliveryOption_02)
    {
        $this->deliveryOption_02 = $deliveryOption_02;
    }

    public function getDeliveryOption_03()
    {
        return $this->deliveryOption_03;
    }

    public function setDeliveryOption_03($deliveryOption_03)
    {
        $this->deliveryOption_03 = $deliveryOption_03;
    }

    public function getDeliveryOption_04()
    {
        return $this->deliveryOption_04;
    }

    public function setDeliveryOption_04($deliveryOption_04)
    {
        $this->deliveryOption_04 = $deliveryOption_04;
    }
    
    public function setRegion($region)
    {
        $this->region = $region;
    }

    public function setDistrict($district)
    {
        $this->district = $district;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }
    
    public function getPublished()
    {
        return $this->isPublished;
    }

    public function setPublished($isPublished)
    {
        $this->isPublished = $isPublished;
    }

    /////////////////////////////////////////////////////////
    public function getDeliveryOption_04_address()
    {
        return $this->deliveryOption_04_address;
    }

    public function setDeliveryOption_04_address($deliveryOption_04_address)
    {
        $this->deliveryOption_04_address = $deliveryOption_04_address;
    }

    public function getDeliveryOption_05()
    {
        return $this->deliveryOption_05;
    }

    public function setDeliveryOption_05($deliveryOption_05)
    {
        $this->deliveryOption_05 = $deliveryOption_05;
    }

    public function getDeliveryOption_06()
    {
        return $this->deliveryOption_06;
    }

    public function setDeliveryOption_06($deliveryOption_06)
    {
        $this->deliveryOption_06 = $deliveryOption_06;
    }

    public function getDeliveryOption_07()
    {
        return $this->deliveryOption_07;
    }

    public function setDeliveryOption_07($deliveryOption_07)
    {
        $this->deliveryOption_07 = $deliveryOption_07;
    }

    public function getDeliveryOption_08()
    {
        return $this->deliveryOption_08;
    }

    public function setDeliveryOption_08($deliveryOption_08)
    {
        $this->deliveryOption_08 = $deliveryOption_08;
    }

    public function getRegion()
    {
        return $this->region;
    }

    public function getDistrict()
    {
        return $this->district;
    }

    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Get the value of phone
     */ 
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     *
     * @return  self
     */ 
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get the value of photo
     */ 
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set the value of photo
     *
     * @return  self
     */ 
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get the value of goods
     */ 
    public function getGoods()
    {
        return $this->goods;
    }

    /**
     * Set the value of goods
     *
     * @return  self
     */ 
    public function setGoods($goods)
    {
        $this->goods = $goods;

        return $this;
    }

    public function readGoods()
    {
        $shopID = $this->ID;

        $goods = [];


        $query = "SELECT * FROM __catalog46 WHERE shop=$shopID";

        $result = mysqli_query($this->getConnection(), $query)
            or die(mysqli_error($this->getConnection()));

        while ($row = mysqli_fetch_array($result)) {
            $goodID = $row["ID"];
            $good = new Good($this->getConnection(), $goodID);
            $goods[] = $good->expose();
        }

        return $goods;
    }
}
