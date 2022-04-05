<?php

class Good
{
    protected $connection;

    protected $ID;

    protected $name;
    protected $material;
    protected $price;
    protected $photoJSON;
    protected $shop;
    protected $photo1;
    protected $photo2;
    protected $photo3;
    protected $photo4;
    protected $description;
    protected $isAvailable;

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
        foreach($vars as $key => $value) {
            $fixedKey = ucfirst($key);
            $fixed[$fixedKey] = $value;
        }
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
 
         $query = "INSERT INTO __catalog46 ($fields) VALUES ($values)";

         logMessage("log/debug-good.txt", $data["Shop"]);
         logMessage("log/debug-good.txt", $query);
 
         $result = mysqli_query($this->connection, $query)
         or die(mysqli_error($this->connection));
 
         $this->ID = mysqli_insert_id($this->connection);
         return $this->ID;
     }
 
     public function read(int $ID)
     {
         $query = "SELECT * FROM __catalog46 WHERE ID=$ID";
 
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
  
         return $this;
     }
 
     public function update(array $data)
     {
         $shopID = $this->getID();
 
         $query = "UPDATE __catalog45
         SET";
 
         $delim = "";
         foreach ($data as $field => $value) {
             if ($field === "ID") {
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
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of material
     */ 
    public function getMaterial()
    {
        return $this->material;
    }

    /**
     * Set the value of material
     *
     * @return  self
     */ 
    public function setMaterial($material)
    {
        $this->material = $material;

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
     * Get the value of photoJSON
     */ 
    public function getPhotoJSON()
    {
        return $this->photoJSON;
    }

    /**
     * Set the value of photoJSON
     *
     * @return  self
     */ 
    public function setPhotoJSON($photoJSON)
    {
        $this->photoJSON = $photoJSON;

        return $this;
    }

    /**
     * Get the value of shop
     */ 
    public function getShop()
    {
        return $this->shop;
    }

    /**
     * Set the value of shop
     *
     * @return  self
     */ 
    public function setShop($shop)
    {
        $this->shop = $shop;

        return $this;
    }

    /**
     * Get the value of photo1
     */ 
    public function getPhoto1()
    {
        return $this->photo1;
    }

    /**
     * Set the value of photo1
     *
     * @return  self
     */ 
    public function setPhoto1($photo1)
    {
        $this->photo1 = $photo1;

        return $this;
    }

    /**
     * Get the value of photo2
     */ 
    public function getPhoto2()
    {
        return $this->photo2;
    }

    /**
     * Set the value of photo2
     *
     * @return  self
     */ 
    public function setPhoto2($photo2)
    {
        $this->photo2 = $photo2;

        return $this;
    }

    /**
     * Get the value of photo3
     */ 
    public function getPhoto3()
    {
        return $this->photo3;
    }

    /**
     * Set the value of photo3
     *
     * @return  self
     */ 
    public function setPhoto3($photo3)
    {
        $this->photo3 = $photo3;

        return $this;
    }

    /**
     * Get the value of photo4
     */ 
    public function getPhoto4()
    {
        return $this->photo4;
    }

    /**
     * Set the value of photo4
     *
     * @return  self
     */ 
    public function setPhoto4($photo4)
    {
        $this->photo4 = $photo4;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of isAvailable
     */ 
    public function getIsAvailable()
    {
        return $this->isAvailable;
    }

    /**
     * Set the value of isAvailable
     *
     * @return  self
     */ 
    public function setIsAvailable($isAvailable)
    {
        $this->isAvailable = $isAvailable;

        return $this;
    }
}
