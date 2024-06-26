<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;

use App\Services\Menu\GetAllMenuWithShopNameService;
use App\Services\Menu\AddMenuService;
use App\Services\Menu\AddMenuImageService;
use App\Services\Menu\EditMenuService;
use App\Services\Menu\DeleteMenuService;
use App\Services\Menu\GetMenuByIdService;
use App\Services\Menu\GetAllPaidedMenuByShopService;
use App\Services\Menu\GetAllPaidedMenuByInvoiceService;
use App\Services\Menu\DonePaidedMenuByShopService;

class MenuController extends Controller
{
    public function __construct(
        private GetMenuByIdService $getMenuByIdService,
        private GetAllMenuWithShopNameService $getAllMenuService,
        private GetAllPaidedMenuByShopService $getAllPaidedMenuByShopService,
        private GetAllPaidedMenuByInvoiceService $getAllPaidedMenuByInvoiceService,
        private DonePaidedMenuByShopService $donePaidedMenuByShopService,
        private AddMenuService $addMenuService,
        private AddMenuImageService $addMenuImageService,
        private EditMenuService $editMenuService,
        private DeleteMenuService $deleteMenuService
    ) {}

    public function getMenuById(Request $request) {
        try {

            $resultData = $this->getMenuByIdService->getMenuById($request);
            return response()->json([
                'status' => 'success',
                'message' => 'All menu data retrieved successfully',
                'data' => $resultData
            ])->setStatusCode(200);
        } catch (Exception $error) {
            return response()->json([
                'status' => 'error',
                'message' => $error->getMessage(),
            ])->setStatusCode(401);
        }
    }

    public function getAllMenu(Request $request) {
        try {
            $resultData = $this->getAllMenuService->getAllMenuWithShopName($request);
            return response()->json([
                'status' => 'success',
                'message' => 'All menu data retrieved successfully',
                'data' => $resultData
            ])->setStatusCode(200);
        } catch (Exception $error) {
            return response()->json([
                'status' => 'error',
                'message' => $error->getMessage(),
            ])->setStatusCode(401);
        }
    }

    public function getAllPaidedMenuByInvoice(Request $request) {
        try {
            $resultData = $this->getAllPaidedMenuByInvoiceService->getAllPaidedMenuByInvoice($request);
            return response()->json([
                'status' => 'success',
                'message' => 'All paided menu data by invoice retrieved successfully',
                'data' => $resultData
            ])->setStatusCode(200);
        } catch (Exception $error) {
            return response()->json([
                'status' => 'error',
                'message' => $error->getMessage(),
            ])->setStatusCode(401);
        }
    }

    public function getAllPaidedMenuByShop(Request $request) {
        try {
            $resultData = $this->getAllPaidedMenuByShopService->getAllPaidedMenuByShop($request);
            return response()->json([
                'status' => 'success',
                'message' => 'All paided menu data by shop retrieved successfully',
                'data' => $resultData
            ])->setStatusCode(200);
        } catch (Exception $error) {
            return response()->json([
                'status' => 'error',
                'message' => $error->getMessage(),
            ])->setStatusCode(401);
        }
    }

    public function donePaidedMenuByShop(Request $request) {
        try {
            $resultData = $this->donePaidedMenuByShopService->donePaidedMenuByShop($request);
            return response()->json([
                'status' => 'success',
                'message' => 'Paided menu data done to procced successfully',
                'data' => $resultData
            ])->setStatusCode(200);
        } catch (Exception $error) {
            return response()->json([
                'status' => 'error',
                'message' => $error->getMessage(),
            ])->setStatusCode(401);
        }
    }

    public function addMenu(Request $request) {
        try {
            $resultData = $this->addMenuService->addMenu($request);
            return response()->json([
                'status' => 'success',
                'message' => 'Menu data added successfully',
                'data' => $resultData
            ])->setStatusCode(201);
        } catch (Exception $error) {
            return response()->json([
                'status' => 'error',
                'message' => $error->getMessage(),
            ])->setStatusCode(401);
        }
    }

    public function addMenuImage(Request $request) {
        try {
            $resultData = $this->addMenuImageService->addMenuImage($request);
            return response()->json([
                'status' => 'success',
                'message' => 'Menu image data added successfully',
                'data' => $resultData
            ])->setStatusCode(201);
        } catch (Exception $error) {
            return response()->json([
                'status' => 'error',
                'message' => $error->getMessage(),
            ])->setStatusCode(401);
        }
    }

    public function editMenu(Request $request) {
        try {
            $resultData = $this->editMenuService->editMenu($request);
            return response()->json([
                'status' => 'success',
                'message' => 'Menu data edited successfully',
                'data' => $resultData
            ])->setStatusCode(200);
        } catch (Exception $error) {
            return response()->json([
                'status' => 'error',
                'message' => $error->getMessage(),
            ])->setStatusCode(401);
        }
    }

    public function deleteMenu(Request $request) {
        try {
            $resultData = $this->deleteMenuService->deleteMenu($request);
            return response()->json([
                'status' => 'success',
                'message' => 'Menu data deleted successfully',
                'data' => $resultData
            ])->setStatusCode(200);
        } catch (Exception $error) {
            return response()->json([
                'status' => 'error',
                'message' => $error->getMessage(),
            ])->setStatusCode(401);
        }
    }
}
