<?php


class Product
{
    public $id;
    public $productName;
    public $Price;
    public $Stock;
    public $status;
    public $isPromoted;
    public $icon;
    public $category;
    public $img_path;



    public function setIsPromoted($isPromoted)
    {
        if ($isPromoted == 'promoted') {
            $this->category = 1;
        } else {
            $this->category = 0;
        }

    }

    public function getIsPromoted($IsPromoted)
    {
        if ($IsPromoted == 1) {
            return 'Promoting';
        } else {
            return 'Not Promoting';
        }
    }

    public function getStatus($status)
    {
        if ($status == 1) {
            return 'Disable';
        } else {
            return 'Enable';
        }
    }
}

?>