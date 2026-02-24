<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\AccountingEntry;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transactions = array(
            array('id' => '1','product_id' => '1','type' => 'sale','quantity' => '10','unit_price' => '200.00','subtotal' => '2000.00','discount' => '50.00','vat' => '100.00','total' => '2050.00','paid' => '1000.00','due' => '1050.00','transaction_date' => '2026-02-24','created_at' => '2026-02-24 18:59:15','updated_at' => '2026-02-24 18:59:15')
        );

        foreach ($transactions as $transaction) {
            Transaction::create($transaction);
        }



        $accounting_entries = array(
            array('id' => '1','transaction_id' => '1','account' => 'Cash','type' => 'debit','amount' => '1000.00','created_at' => '2026-02-24 18:59:15','updated_at' => '2026-02-24 18:59:15'),
            array('id' => '2','transaction_id' => '1','account' => 'Accounts Receivable','type' => 'debit','amount' => '1050.00','created_at' => '2026-02-24 18:59:15','updated_at' => '2026-02-24 18:59:15'),
            array('id' => '3','transaction_id' => '1','account' => 'Cost of Goods Sold','type' => 'debit','amount' => '1000.00','created_at' => '2026-02-24 18:59:15','updated_at' => '2026-02-24 18:59:15'),
            array('id' => '4','transaction_id' => '1','account' => 'Sales Revenue','type' => 'credit','amount' => '2000.00','created_at' => '2026-02-24 18:59:15','updated_at' => '2026-02-24 18:59:15'),
            array('id' => '5','transaction_id' => '1','account' => 'VAT Payable','type' => 'credit','amount' => '100.00','created_at' => '2026-02-24 18:59:15','updated_at' => '2026-02-24 18:59:15'),
            array('id' => '6','transaction_id' => '1','account' => 'Inventory','type' => 'credit','amount' => '1000.00','created_at' => '2026-02-24 18:59:15','updated_at' => '2026-02-24 18:59:15')
        );

        foreach ($accounting_entries as $accounting_entry) {
            AccountingEntry::create($accounting_entry);
        }
    }
}
