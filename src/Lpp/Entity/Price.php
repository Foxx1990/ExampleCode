<?php

namespace Lpp\Entity;

/**
 * Represents a single price from a search result
 * related to a single item.
 * 
 */
class Price
{
    /**
     * Description text for the price
     * 
     * @var string
     */
    private $description;

    /**
     * Price in euro
     * 
     * @var int
     */
    private $priceInEuro;

    /**
     * Warehouse's arrival date (to)
     *
     * @var \DateTime
     */
    private $arrivalDate;

    /**
     * Due to date,
     * defining how long will the item be available for sale (i.e. in a collection)
     *
     * @var \DateTime
     */
    private $dueDate;

    /**
     * getDateToObject
     *
     * @param  mixed $dueDate
     * @return DateTime
     */
    public function getDateToObject($date): \DateTime
    {
        $dateTime = \datetime::createfromformat('Y-m-d', $date);
        return $dateTime;
    } 
    public function getDueDate() {

        return $this->getDateToObject($this->dueDate);
    }

    /**
     * setDueDate
     *
     * @param  mixed $date
     * @return void
     */
    public function setDueDate($date) {
        $this->dueDate = $date;
    }
    
    /**
     * getArrivalDate
     *
     * @return void
     */
    public function getArrivalDate() {
       return $this->getDateToObject($this->arrivalDate);
    }    

    /**
     * setArrivalDate
     *
     * @param  mixed $date
     * @return void
     */
    public function setArrivalDate($date) {
        $this->arrivalDate = $date;
    } 

    /**
     * getPriceInEuro
     *
     * @return int
     */
    public function getPriceInEuro(): int {
       return $this->priceInEuro;
    }
    
    /**
     * setPriceInEuro
     *
     * @param  mixed $price
     * @return void
     */
    public function setPriceInEuro( int $price) {
        $this->priceInEuro = $price;
    }
    
    /**
     * getDescription
     *
     * @return string
     */
    public function getDescription(): string {
       return $this->description;
    }
    
    /**
     * setDescription
     *
     * @param  mixed $description
     * @return void
     */
    public function setDescription(string $description) {
        $this->description = $description;
    }
}
