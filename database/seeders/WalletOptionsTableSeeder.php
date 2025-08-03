<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WalletOptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear the table first
        DB::table('wallet_options')->truncate();

        $wallets = [
            [
                'id' => 1,
                'coin_code' => 'BTC',
                'coin_name' => 'Bitcoin',
                'wallet_name' => 'Main BTC Wallet',
                'wallet_type' => 'crypto',
                'icon' => 'icons/btc.png',
                'wallet_address' => 'btc',
                'network_type' => 'Bitcoin',
                'created_at' => '2025-04-08 05:57:25',
                'updated_at' => '2025-06-05 15:58:59',
            ],
            [
                'id' => 2,
                'coin_code' => 'ETH',
                'coin_name' => 'Ethereum',
                'wallet_name' => 'ETH Wallet',
                'wallet_type' => 'crypto',
                'icon' => 'icons/eth.png',
                'wallet_address' => 'eth',
                'network_type' => 'ERC20',
                'created_at' => '2025-04-08 05:57:25',
                'updated_at' => '2025-06-18 04:48:48',
            ],
            [
                'id' => 3,
                'coin_code' => 'XRP',
                'coin_name' => 'XRP',
                'wallet_name' => 'XRP Reserve',
                'wallet_type' => 'crypto',
                'icon' => 'icons/xrp.png',
                'wallet_address' => 'xrp',
                'network_type' => 'XRP Ledger',
                'created_at' => '2025-04-08 05:57:25',
                'updated_at' => '2025-06-05 16:01:25',
            ],
            [
                'id' => 4,
                'coin_code' => 'SOL',
                'coin_name' => 'Solana',
                'wallet_name' => 'Solana Wallet',
                'wallet_type' => 'crypto',
                'icon' => 'icons/sol.png',
                'wallet_address' => 'sol',
                'network_type' => 'Solana',
                'created_at' => '2025-04-08 05:57:25',
                'updated_at' => '2025-06-05 16:00:08',
            ],
            [
                'id' => 5,
                'coin_code' => 'USDT',
                'coin_name' => 'Tether',
                'wallet_name' => 'USDT Stable',
                'wallet_type' => 'crypto',
                'icon' => 'icons/usdt.png',
                'wallet_address' => 'usdt',
                'network_type' => 'ERC20',
                'created_at' => '2025-04-08 05:57:25',
                'updated_at' => '2025-06-18 04:51:50',
            ],
            [
                'id' => 6,
                'coin_code' => 'DOGE',
                'coin_name' => 'Dogecoin',
                'wallet_name' => 'Doge Wallet',
                'wallet_type' => 'crypto',
                'icon' => 'icons/doge.png',
                'wallet_address' => 'dog',
                'network_type' => 'Dogecoin',
                'created_at' => '2025-04-08 05:57:25',
                'updated_at' => '2025-06-05 16:04:18',
            ],
            [
                'id' => 8,
                'coin_code' => 'Sui',
                'coin_name' => 'Sui',
                'wallet_name' => 'Sui Wallet',
                'wallet_type' => 'crypto',
                'icon' => 'icons/ada.png',
                'wallet_address' => 'sui',
                'network_type' => 'Coin',
                'created_at' => '2025-04-08 05:57:25',
                'updated_at' => '2025-06-05 16:03:38',
            ],
        ];

        DB::table('wallet_options')->insert($wallets);
    }
}
