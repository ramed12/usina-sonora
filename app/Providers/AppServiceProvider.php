<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use App\models\Menu;
use App\models\Submenu;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {


        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {

            $event->menu->add('Administração do Site');
            $event->menu->add([
                'text'        => 'Páginas',
                'key'         => 'pages',
                'icon'        => 'fas fa-fw fa-book-open',
                'can'         => 'isAdmin',
            ]);
            $menus = Menu::where('status', 1)->where('tag', 'pages')->whereNotIn('id', [6, 14])->get()->map(function (Menu $menu) {
                if ($menu->id == 1 || $menu->id == 2 || $menu->id == 4 || $menu->id == 7) {
                    return [
                        'text' => $menu->name,
                        'url'  => 'dashboard/' . $menu->url,
                        'icon' => $menu->icon,
                        'can'         => 'isAdmin',
                    ];
                } else {
                    return [
                        'text' => $menu->name,
                        'url'  => 'dashboard/' . $menu->url . "/" . $menu->id,
                        'icon' => $menu->icon,
                        'can'         => 'isAdmin',
                    ];
                }
            });
            $event->menu->addIn('pages', ...$menus);

            $event->menu->add([
                'text'        => 'Galeria de Imagem',
                'key'         => 'gallery',
                'url'         => 'dashboard/gallery',
                'icon'        => 'fas fa-fw fa-images',
                'can'         => 'isAdmin',
            ]);
            $menus = Menu::where('status', 1)->where('tag', 'gallery')->get()->map(function (Menu $menu) {
                return [
                    'text' => $menu->name,
                    'url'  => 'dashboard/gallery/' . $menu->url,
                    'icon' => $menu->icon,
                    'can'  => 'isAdmin',
                ];
            });
            $event->menu->addIn('gallery', ...$menus);

            $event->menu->add('Formulário do Site');
            $event->menu->add([
                'text'        => 'Contato',
                'url'         => 'dashboard/contact',
                'icon'        => 'fas fa-fw fa-headset',
                'can'         => 'isAdmin',
            ]);
            $event->menu->add([
                'text'        => 'Caixa de Idéias',
                'url'         => 'dashboard/idea',
                'icon'        => 'far fa-lightbulb',
                'can'         => 'isAdmin',

            ]);
            $event->menu->add([
                'text'        => 'Planilha Investidores',
                'url'         => 'dashboard/investor/file',
                'icon'        => 'fas fa-fw fa-table',
                'can'         => 'isAdmin',
            ]);

            $event->menu->add('Administração do Usuário');
            $event->menu->add([
                'text'        => 'Usuários',
                'url'         => 'dashboard/user',
                'icon'        => 'fas fa-fw fa-user',
                'can'         => 'isAdmin',
            ]);
            $event->menu->add([
                'text'        => 'Investidores',
                'url'         => 'dashboard/investor',
                'icon'        => 'fas fa-fw fa-user',
                'can'         => 'isAdmin',
            ]);
            $event->menu->add([
                'text'        => 'Informaçoes da Usina',
                'key'         => 'company',
                'icon'        => 'fas fa-fw fa-industry',
                'can'         => 'isAdmin',
            ]);
            $event->menu->add([
                'text'        => 'Log de Acesso do Investidor',
                'url'         => 'dashboard/log-investor',
                'icon'        => 'fas fa-fw fa-industry',
                'can'         => 'isAdmin',
            ]);
            $menus = Menu::where('status', 1)->where('tag', 'company')->get()->map(function (Menu $menu) {
                return [
                    'text' => $menu->name,
                    'url'  => 'dashboard/' . $menu->url,
                    'icon' => $menu->icon,
                    'can'  => 'isAdmin',
                ];
            });
            $event->menu->addIn('company', ...$menus);

            $event->menu->add([
                'text'        => 'Paramêtro do Sistema',
                'key'         => 'parameter',
                'icon'        => 'fas fa-fw fa-cogs',
                'can'         => 'isAdmin',
            ]);
            $menus = Menu::where('status', 1)->where('tag', 'parameter')->get()->map(function (Menu $menu) {
                return [
                    'text' => $menu->name,
                    'url'  => 'dashboard/' . $menu->url,
                    'icon' => $menu->icon,
                    'can'  => 'isAdmin',
                ];
            });
            $event->menu->addIn('parameter', ...$menus);
        });
    }
}
