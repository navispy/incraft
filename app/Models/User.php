<?php
//namespace App\Models;

require_once "./setup.php";
require_once "Shop.php";

class User
{
    public const ACCOUNT_ACTIVE = 0;
    public const ACCOUNT_SUSPENDED = 1;
    public const ACCOUNT_DELETED = 2;

    protected $connection;

    protected $ID;
    protected $name;
    protected $email;
    protected $phone;
    protected $password;
    protected $dateRegistered;
    protected $photo;
    protected $visibility;
    protected $receiveMsgFromVisitors;
    protected $receiveMsgFromSystem;
    protected $receiveMsgFromFavouriteShops;
    protected $receiveNewOrderNotifications;
    protected $accountStatus;

    protected $shops = [];

    //constructor
    function __construct($connection)
    {
        $this->setConnection($connection);

        $a = func_get_args();
        $i = func_num_args();
        if (method_exists($this, $f = '__construct' . $i)) {
            call_user_func_array(array($this, $f), $a);
        }
    }

    function __construct2($connection, $ID)
    {
        $this->read($ID);
    }

    public static function getStatus($name, $password, $connection)
    {
        $status = [
            "credentials" => false,
            "account" => null
        ];

        $query = "SELECT * FROM __catalog43 WHERE Name='$name' AND Password='$password'";
        $result = mysqli_query($connection, $query)
            or die(mysqli_error($connection));

        if ($row = mysqli_fetch_array($result)) {
            $status["credentials"] = true;
            $status["account"] = $row["AccountStatus"];

            $status["photo"] = $row["Photo"];
            $status["userID"] = $row["ID"];
        }

        return $status;
    }
    public static function doesExist($ID, $connection)
    {
        $query = "SELECT * FROM __catalog43 WHERE ID=$ID";

        $result = mysqli_query($connection, $query)
            or die(mysqli_error($connection));

        return $row = mysqli_fetch_array($result);
    }

    public static function hasDupUserName($connection, $userID, $userName)
    {
        $query = "SELECT * FROM __catalog43 WHERE Name = '$userName' AND ID <> $userID";

        $result = mysqli_query($connection, $query)
            or die(mysqli_error($connection));

        $hasDupUserName = false;
        if ($row = mysqli_fetch_array($result)) {
            $hasDupUserName = true;
        }

        return $hasDupUserName;
    }

    public static function hasDupUserEmail($connection, $userID, $userEmail)
    {
        $query = "SELECT * FROM __catalog43 WHERE Email = '$userEmail' AND ID <> $userID";

        $result = mysqli_query($connection, $query)
            or die(mysqli_error($connection));

        $hasDupUserEmail = false;
        if ($row = mysqli_fetch_array($result)) {
            $hasDupUserEmail = true;
        }

        return $hasDupUserEmail;
    }


    public function __toString()
    {
        $obj = [];
        $obj["ID"] = $this->ID;
        $obj["Name"] = $this->name;
        $obj["Email"] = $this->email;
        $obj["Phone"] = $this->phone;
        $obj["Password"] = $this->password;
        $obj["DateRegistered"] = $this->dateRegistered;
        $obj["Photo"] = $this->photo;
        $obj["Visibility"] = $this->visibility;
        $obj["ReceiveMsgFromVisitors"] = $this->receiveMsgFromVisitors;
        $obj["ReceiveMsgFromSystem"] = $this->receiveMsgFromSystem;
        $obj["ReceiveMsgFromFavouriteShops"] = $this->receiveMsgFromFavouriteShops;
        $obj["ReceiveNewOrderNotifications"] = $this->receiveNewOrderNotifications;
        $obj["AccountStatus"] = $this->accountStatus;
        
        $fixedShops = [];
        foreach ($this->shops as $shop) {
            $fixedShop = [];
            foreach($shop as $key => $value) {
                if($key == "connection") {
                    continue;
                }
                $fixedKey = ucfirst($key);
                $fixedShop[$fixedKey] = $value;
            }
            $fixedShops[] = $fixedShop;
        };

        $obj["Shops"] = $fixedShops; //$this->shops;

        return json_encode($obj, true);
    }

    // GET METHODS
    public function getConnection()
    {
        return $this->connection;
    }

    public function getID()
    {
        return $this->ID;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getDateRegistered()
    {
        return $this->dateRegistered;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function getVisibility()
    {
        return $this->visibility;
    }

    public function getReceiveMsgFromVisitors()
    {
        return $this->receiveMsgFromVisitors;
    }

    public function getReceiveMsgFromSystem()
    {
        return $this->receiveMsgFromSystem;
    }

    public function getReceiveMsgFromFavouriteShops()
    {
        return $this->receiveMsgFromFavouriteShops;
    }

    public function getReceiveNewOrderNotifications()
    {
        return $this->receiveNewOrderNotifications;
    }

    public function getAccountStatus()
    {
        return $this->accountStatus;
    }

    public function getShops()
    {
        return $this->shops;
    }

    // SET METHODS

    public function setConnection($connection)
    {
        $this->connection = $connection;
    }

    public function setID(int $ID)
    {
        $this->ID = $ID;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function setPhone(string $phone)
    {
        $this->phone = $phone;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function setDateRegistered(string $dateRegistered)
    {
        $this->dateRegistered = $dateRegistered;
    }

    public function setPhoto(string $photo)
    {
        $this->photo = $photo;
    }

    public function setVisibility(int $visibility)
    {
        $this->visibility = $visibility;
    }

    public function setReceiveMsgFromVisitors(bool $receiveMsgFromVisitors)
    {
        $this->receiveMsgFromVisitors = $receiveMsgFromVisitors;
    }

    public function setReceiveMsgFromSystem(bool $receiveMsgFromSystem)
    {
        $this->receiveMsgFromSystem = $receiveMsgFromSystem;
    }

    public function setReceiveMsgFromFavouriteShops(bool $receiveMsgFromFavouriteShops)
    {
        $this->receiveMsgFromFavouriteShops = $receiveMsgFromFavouriteShops;
    }

    public function setReceiveNewOrderNotifications(bool $receiveNewOrderNotifications)
    {
        $this->receiveNewOrderNotifications = $receiveNewOrderNotifications;
    }

    public function setAccountStatus(int $accountStatus)
    {
        $this->accountStatus = $accountStatus;
    }

    // CRUD OPERATIONS
    public function create(array $data)
    {
    }

    public function read(int $ID)
    {
        $query = "SELECT * FROM __catalog43 WHERE ID=$ID";

        $result = mysqli_query($this->connection, $query)
            or die(mysqli_error($this->connection));

        if ($row = mysqli_fetch_array($result)) {
            $ID = $row["ID"];
            $name = $row["Name"];
            $email = $row["Email"];
            $phone = $row["Phone"];
            $password = $row["Password"];
            $dateRegistered = $row["DateRegistered"];
            $photo = $row["Photo"];
            $visibility = $row["Visibility"];
            $receiveMsgFromVisitors = $row["ReceiveMsgFromVisitors"];
            $receiveMsgFromSystem = $row["ReceiveMsgFromSystem"];
            $receiveMsgFromFavouriteShops = $row["ReceiveMsgFromFavouriteShops"];
            $receiveNewOrderNotifications = $row["ReceiveNewOrderNotifications"];
            $accountStatus = $row["AccountStatus"];

            $this->setID($ID);
            $this->setName($name);
            $this->setEmail($email);
            $this->setPhone($phone);
            $this->setPassword($password);
            $this->setDateRegistered($dateRegistered);
            $this->setPhoto($photo);
            $this->setVisibility($visibility);
            $this->setReceiveMsgFromVisitors($receiveMsgFromVisitors);
            $this->setReceiveMsgFromSystem($receiveMsgFromSystem);
            $this->setReceiveMsgFromFavouriteShops($receiveMsgFromFavouriteShops);
            $this->setReceiveNewOrderNotifications($receiveNewOrderNotifications);
            $this->setAccountStatus($accountStatus);

            $this->shops = $this->readShops();
        }

        return $this;
    }

    public function update(array $data)
    {
        $userID = $this->getID();
        $query = "UPDATE __catalog43 
        SET";

        $delim = "";
        foreach ($data as $field => $value) {
            if ($field === "ID" || $field === "Shops") {
                continue;
            }
            $query .= "$delim `$field`='$value'";
            $delim = " ,";
        }

        $query .= " WHERE ID=$userID";

        $result = mysqli_query($this->connection, $query)
            or die(mysqli_error($this->connection));
    }

    public function delete(int $ID)
    {
    }

    public function readShops()
    {
        $shops = [];

        $userID = $this->getID();
        $query = "SELECT * FROM __catalog45 WHERE UserID=$userID";

        $result = mysqli_query($this->getConnection(), $query)
            or die(mysqli_error($this->getConnection()));

        while ($row = mysqli_fetch_array($result)) {
            $shopID = $row["ID"];
            $shop = new Shop($this->getConnection(), $shopID);
            $shops[] = $shop->expose();
        }

        return $shops;
    }
}
