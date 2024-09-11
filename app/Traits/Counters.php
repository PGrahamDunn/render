<?php

namespace App\Traits;

use App\Models\Counter;
use Illuminate\Support\Facades\DB;

trait Counters
{
    public function create_counter(string $name, string $prefix, int $seed_number)
    {
        $counter = Counter::where('name',$name)->first();
        if (!$counter)
        {
            $result = Counter::Create(['name' => $name, 'prefix' => strtoupper($prefix), 'count_number' => $seed_number]);
            if ($result)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    public function delete_counter(string $name)
    {
        $deleted = DB::table('counters')->where('name', $name)->delete();   
    }

    public function get_counter(string $name)
    {
        $counter = Counter::where('name',$name)->first();
        if ($counter)
        {
            return $counter->count_number;
        }
        else
        {
            return null;
        }
    }

    public function get_counter_prefix(string $name)
    {
        $counter = Counter::where('name',$name)->first();
        if ($counter)
        {
            return $counter->prefix . str_pad($counter->count_number, 6, "0",STR_PAD_LEFT);
        }
        else
        {
            return null;
        }
    }

    public function increment_counter(string $name)
    {
        $counter = Counter::where('name',$name)->first();
        if ($counter)
        {
            $count = ++$counter->count_number;
            $counter->save();
            return $count;
        }
        else
        {
            return null;
        }
    }

    public function increment_counter_prefix(string $name)
    {
        $counter = Counter::where('name',$name)->first();
        if ($counter)
        {
            $count = ++$counter->count_number;
            $prefix_count =  $counter->prefix . str_pad($count, 6, "0",STR_PAD_LEFT);
            $counter->save();
            return $prefix_count;
        }
        else
        {
            return null;
        }
    }

    public function decrement_counter(string $name)
    {
        $counter = Counter::where('name',$name)->first();
        if ($counter)
        {
            $count = --$counter->count_number;
            $counter->save();
            return $count;
        }
        else
        {
            return null;
        }
    }

    public function decrement_counter_prefix(string $name)
    {
        $counter = Counter::where('name',$name)->first();
        if ($counter)
        {
            $count = --$counter->count_number;
            $prefix_count =  $counter->prefix . str_pad($count, 6, "0",STR_PAD_LEFT);
            $counter->save();
            return $prefix_count;
        }
        else
        {
            return null;
        }
    }

}