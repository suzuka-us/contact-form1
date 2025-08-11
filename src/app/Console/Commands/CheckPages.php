<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class CheckPages extends Command
{
    protected $signature = 'check:pages';
    protected $description = 'Check if required routes and views exist';

    // 確認したいページ一覧 (ルート名とビュー名のペア)
    protected $pages = [
        ['route' => 'register', 'view' => 'auth.register'],
        ['route' => 'login', 'view' => 'auth.login'],
        ['route' => 'admin.contacts.index', 'view' => 'admin.contacts.index'],
        ['route' => 'contacts.index', 'view' => 'contacts.index'],
        ['route' => 'contacts.confirm', 'view' => 'contacts.confirm'],
        ['route' => 'thanks', 'view' => 'thanks'],
    ];

    public function handle()
    {
        $this->info("=== ページ確認開始 ===");

        foreach ($this->pages as $page) {
            $this->checkRoute($page['route']);
            $this->checkView($page['view']);
            $this->line(''); // 空行
        }

        $this->info("=== ページ確認終了 ===");
        return 0;
    }

    protected function checkRoute(string $routeName)
    {
        $routeExists = Route::has($routeName);
        $this->line("ルート '{$routeName}': " . ($routeExists ? "存在します ✅" : "存在しません ❌"));
    }

    protected function checkView(string $viewName)
    {
        $viewExists = View::exists($viewName);
        $this->line("ビュー '{$viewName}': " . ($viewExists ? "存在します ✅" : "存在しません ❌"));
    }
}
