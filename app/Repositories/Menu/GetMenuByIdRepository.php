<?php

namespace App\Repositories\Menu;

use Exception;

use App\Models\Menu;

class GetMenuByIdRepository
{
    public function getMenuById($shop_id)
    {
        try{
            $menus = Menu::join('shops', 'menus.shop_id', '=', 'shops.id')
                ->select('menus.*', 'shops.namaToko', 'menus.image as imageMenu', 'shops.image as imageToko')
                ->where('menus.shop_id', $shop_id)
                ->orderBy('menus.namaMenu', 'asc')
                ->get();

            $menuDTOs = [];
            
            if($menus->isEmpty()) {
                throw new Exception("Menu not found");
            }

            foreach ($menus as $menu) {
                $menuDTO = [
                    'id' => $menu->id,
                    'namaMenu' => $menu->namaMenu,
                    'hargaMenu' => $menu->hargaMenu,
                    'stokMenu' => $menu->stokMenu,
                    'deskripsiMenu' => $menu->deskripsiMenu,
                    'namaToko' => $menu->namaToko,
                    'imageMenu' => $menu->imageMenu,
                    'imageToko' => $menu->imageToko,
                ];

                array_push($menuDTOs, $menuDTO);
            }

            return $menuDTOs;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }
}
