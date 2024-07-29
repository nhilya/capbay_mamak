<?php

namespace App\Services;

use App\Models\FoodMenu;

class PricingRulesService
{
    protected $items = [];

    public function scan(FoodMenu $item)
    {
        if (!isset($this->items[$item->code])) {
            $this->items[$item->code] = 0;
        }

        $this->items[$item->code]++;
    }

    public function total()
    {
        $total = 0;
        // dd($this->items);

        foreach ($this->items as $code => $quantity) {
            $item = FoodMenu::where('code', $code)->first();

            $price = $item->price;

            if ($code === 'B001') {
                // Buy 1 Get 1 Free for Kopi
                $total += $price * ceil($quantity / 2);
            } elseif ($code === 'B002') {
                // Buy 1 Get 1 Free for Teh Tarik
                $total += $price * ceil($quantity / 2);
            } elseif ($code === 'F001') {
                // RM1.2 each if buying 2 or more
                if ($quantity >= 2) {
                    $total += 1.2 * $quantity;
                } else {
                    $total += $price * $quantity;
                }
            } else {
                $total += $price * $quantity;
            }
        }

        return $total;
    }
}
