<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WalletOption;

class WalletOptionSeeder extends Seeder
{
    public function run(): void
    {
        $wallets = [
            [
                'coin_code' => 'BTC',
                'coin_name' => 'Bitcoin',
                'wallet_name' => 'Main BTC Wallet',
                'wallet_type' => 'Hot',
                'icon' => 'icons/btc.png',
                'wallet_address' => '1A1zP1eP5QGefi2DMPTfTL5SLmv7DivfNa',
                'network_type' => 'Bitcoin',
            ],
            [
                'coin_code' => 'ETH',
                'coin_name' => 'Ethereum',
                'wallet_name' => 'ETH Wallet',
                'wallet_type' => 'Hot',
                'icon' => 'icons/eth.png',
                'wallet_address' => '0x742d35Cc6634C0532925a3b844Bc454e4438f44e',
                'network_type' => 'ERC20',
            ],
            [
                'coin_code' => 'XRP',
                'coin_name' => 'XRP',
                'wallet_name' => 'XRP Reserve',
                'wallet_type' => 'Cold',
                'icon' => 'icons/xrp.png',
                'wallet_address' => 'rEb8TK3gBgk5auZkwc6sHnwrGVJH8DuaLh',
                'network_type' => 'XRP Ledger',
            ],
            [
                'coin_code' => 'SOL',
                'coin_name' => 'Solana',
                'wallet_name' => 'Solana Wallet',
                'wallet_type' => 'Hot',
                'icon' => 'icons/sol.png',
                'wallet_address' => '4Nd1m3XLbXzdSWkpUTuNqQ5oMLMRZZB8C1YtAcUgzLKi',
                'network_type' => 'Solana',
            ],
            [
                'coin_code' => 'USDT',
                'coin_name' => 'Tether',
                'wallet_name' => 'USDT Stable',
                'wallet_type' => 'Hot',
                'icon' => 'icons/usdt.png',
                'wallet_address' => 'TX7b3Ae5Nmuvn57gxG3MDZ49gN8vhZ5EMs',
                'network_type' => 'TRC20',
            ],
            [
                'coin_code' => 'DOGE',
                'coin_name' => 'Dogecoin',
                'wallet_name' => 'Doge Wallet',
                'wallet_type' => 'Cold',
                'icon' => 'icons/doge.png',
                'wallet_address' => 'D5ZKHx5nD4NMEJY1NEQ2ArNGiEYHgaZTbU',
                'network_type' => 'Dogecoin',
            ],
            [
                'coin_code' => 'LTC',
                'coin_name' => 'Litecoin',
                'wallet_name' => 'Lite Wallet',
                'wallet_type' => 'Hot',
                'icon' => 'icons/ltc.png',
                'wallet_address' => 'LcHK3xGw7Pi6GMwNHxX1EDhVnRQumHnpUJ',
                'network_type' => 'Litecoin',
            ],
            [
                'coin_code' => 'ADA',
                'coin_name' => 'Cardano',
                'wallet_name' => 'ADA Wallet',
                'wallet_type' => 'Cold',
                'icon' => 'icons/ada.png',
                'wallet_address' => 'addr1q9r8p8v9qg9f9kkg9e5cgm5kkgsk29qf3nuk5k5rjmgvxxg0qf2t0w4r88x',
                'network_type' => 'Cardano',
            ],
        ];

        foreach ($wallets as $wallet) {
            WalletOption::create($wallet);
        }
    }
}
