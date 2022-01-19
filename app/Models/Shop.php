<?php 
//namespace App\Models;

require_once "./setup.php";

class Shop
{
    public const ACCOUNT_ACTIVE = 0;
    public const ACCOUNT_SUSPENDED = 1;
    public const ACCOUNT_DELETED = 2;

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

        $hasDupUserName = false;
        if ($row = mysqli_fetch_array($result)) 
        {
            $hasDupShopName = true;
        }
    
        return $hasDupShopName;
    }

    public function __toString()
    {
        $obj = [];
        $obj["ID"] = $this->ID;
        $obj["UserID"] = $this->userID;
        $obj["Name"] = $this->name;
        $obj["Category"] = $this->category;

        $obj["PaymentMethod_01"] = $this->paymentMethod_01;
        $obj["PaymentMethod_02"] = $this->paymentMethod_02;
        $obj["PaymentMethod_03"] = $this->paymentMethod_03;
        $obj["PaymentMethod_04"] = $this->paymentMethod_04;
        $obj["PaymentMethod_05"] = $this->paymentMethod_05;
        $obj["PaymentMethod_06"] = $this->paymentMethod_06;
        $obj["PaymentMethod_07"] = $this->paymentMethod_07;

        $obj["InstallmentCard_01"] = $this->installmentCard_01;
        $obj["InstallmentCard_02"] = $this->installmentCard_02;
        $obj["InstallmentCard_03"] = $this->installmentCard_03;
        $obj["InstallmentCard_04"] = $this->installmentCard_04;
        $obj["InstallmentCard_05"] = $this->installmentCard_05;
        $obj["InstallmentCard_06"] = $this->installmentCard_06;
        $obj["InstallmentCard_07"] = $this->installmentCard_07;
        $obj["InstallmentCard_08"] = $this->installmentCard_08;

        $obj["DeliveryOption_01"] = $this->deliveryOption_01;
        $obj["DeliveryOption_02"] = $this->deliveryOption_02;
        $obj["DeliveryOption_03"] = $this->deliveryOption_03;
        $obj["DeliveryOption_04"] = $this->deliveryOption_04;
        $obj["DeliveryOption_04_Address"] = $this->deliveryOption_04_address;
        $obj["DeliveryOption_05"] = $this->deliveryOption_05;
        $obj["DeliveryOption_06"] = $this->deliveryOption_06;
        $obj["DeliveryOption_07"] = $this->deliveryOption_07;
        $obj["DeliveryOption_08"] = $this->deliveryOption_08;


        return json_encode($obj, true);
    }

    // GET METHODS
    public function getConnection() {
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

    // SET METHODS

    public function setConnection($connection) {
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
            $accountStatus= $row["AccountStatus"];

            
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
        }
        
        return $this;
    }

    public function update(array $data)
    {
        $userID = $this->getID();
        $query = "UPDATE __catalog43 
        SET";

        $delim = "";
        foreach($data as $field => $value) 
        {
            if($field === "ID") {
                continue;
            }
            $query .= "$delim `$field`='$value'";
            $delim = " ,";
        }

        $query .= " WHERE ID=$userID";

        $result = mysqli_query($this->connection, $query)
            or die(mysqli_error($this->connection));
  
    }

    public function delete(int $id)
    {

    }
}