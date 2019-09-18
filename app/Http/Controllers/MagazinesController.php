<?php

namespace App\Http\Controllers;

use App\Bundle\Magazine\Service\MagazineSearchService;
use App\Magazine;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MagazinesController extends ApiController
{
    /** @var MagazineSearchService */
    private $magazineSearchService;

    public function __construct(
        MagazineSearchService $magazineSearchService
    )
    {
        $this->magazineSearchService = $magazineSearchService;
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id)
    {
        return response()->json(Magazine::with('publisher')->findOrFail($id));
    }

    /**
     * @param Request $request
     * @return array
     */
    public function search(Request $request)
    {
        $this->magazineSearchService->setParameters($request);
        $this->magazineSearchService->addFilterParameters();

        $this->magazineSearchService->setItemsOfPage((int)$request->input('resultOfPage'));
        $this->magazineSearchService->setPage((int) $request->input('page'));

        return response()->json([
            'page' => $this->magazineSearchService->getPage(),
            'lastPage' => $this->magazineSearchService->lastPage(),
            'results' => $this->magazineSearchService->countResults(),
            'resultOfPage' => $this->magazineSearchService->getCountItemsOfPage(),
            'data' => $this->magazineSearchService->get()
        ]);
    }
}
