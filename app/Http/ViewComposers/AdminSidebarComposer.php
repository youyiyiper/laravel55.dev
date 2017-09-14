<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\SidebarsRepository;

class AdminSidebarComposer
{
    /**
     * 仓库实现.
     *
     * @var SidebarsRepository
     */
    protected $SidebarsRepository;

    /**
     * 创建一个新的属性composer.
     *
     * @param SidebarsRepository $users
     * @return void
     */
    public function __construct(SidebarsRepository $SidebarsRepository)
    {
        // Dependencies automatically resolved by service container...
        $this->SidebarsRepository = $SidebarsRepository;
    }

    /**
     * 绑定数据到视图.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        //后台用户菜单数据
        $view->with([
            'adminMenus' => $this->SidebarsRepository->getAdminMenus()
        ]);
    }
}