<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $table = 'account';
    protected $primaryKey = 'account_id';
    
    public static function List($column,  $filter){
        return Account::
        join('store', 'store.store_account_id', 'account.account_id')
        ->join('company', 'company.company_store_id', 'store.store_id')
        ->where($column,  $filter);
    }
    
    public static function Account($account_type){
        
        if (Account::Type()[$account_type] == 'SAAS') {
            $result = Account::get()
             ->where('account_type', $account_type);
        }  
        elseif (Account::Type()[$account_type] == 'B2B') {
             $result = Company::Account()
             ->where('account_type', $account_type);
        }
        elseif (Account::Type()[$account_type] == 'B2C') {
             $result = Person::Account()
                 ->where('account_type', $account_type);
        }
        
        return $result;
    }

    
    

    public static function Type(){
        return [
            'SAAS',
            'B2B',
            'B2C'
        ];
    }
}
