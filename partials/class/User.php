<?php 

class Company{
  public $name;
  public $catchPhrase;
  public $bs;

  function __construct($Name, $CatchPhrase, $BS){
    $this->name = $Name;
    $this->catchPhrase = $CatchPhrase;
    $this->bs = $BS;
  }
}

class Geo{
  public $lat;
  public $lng;

  function __construct($Latitude, $Longitude){
    $this->lat = $Latitude;
    $this->lng = $Longitude;
  }
}

class Address{
  public $street;
  public $suite;
  public $city;
  public $zipcode;

  public $geo;

  function __construct($Street, $Suite, $City, $Zipcode, $Latitude, $Longitude){
    $this->street = $Street;
    $this->suite = $Suite;
    $this->city = $City;
    $this->zipcode = $Zipcode;

    $this->geo = new Geo($Latitude, $Longitude);
  }

  function GetAddress(){
    return $this -> street . ', ' . $this -> zipcode . ' ' . $this -> city;
  }
}

class User{
  public $id;
  public $name;
  public $username;
  public $email;
  public $phone;
  public $website;

  public $address;
  public $company;

  function __construct($ID, $Name, $Username, $Email, $Phone, $Website, $Street, $Suite,
                        $City, $Zipcode, $Latitude, $Longitude, $CompanyName, $CompanyCP, $CompanyBS){
                          $this->id = $ID;
                          $this->name = $Name;
                          $this->username = $Username;
                          $this->email = $Email;
                          $this->phone = $Phone;
                          $this->website = $Website;

                          $this->address = new Address($Street, $Suite, $City, $Zipcode, $Latitude, $Longitude);
                          $this->company = new Company($CompanyName, $CompanyCP, $CompanyBS);

                        }
}

?>
