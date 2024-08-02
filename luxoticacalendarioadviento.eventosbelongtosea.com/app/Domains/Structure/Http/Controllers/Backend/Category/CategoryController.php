<?php

namespace App\Domains\Structure\Http\Controllers\Backend\Category;

use App\Domains\Structure\Http\Requests\Backend\Category\DeleteCategoryRequest;
use App\Domains\Structure\Http\Requests\Backend\Category\EditCategoryRequest;
use App\Domains\Structure\Http\Requests\Backend\Category\StoreCategoryRequest;
use App\Domains\Structure\Http\Requests\Backend\Category\UpdateCategoryRequest;
use App\Domains\Structure\Models\Category;
use App\Domains\Structure\Services\CategoryService;

/**
 * Class CategoryController.
 */
class CategoryController
{
    /**
     * @var CategoryService
     */
    protected $categoryService;

    /**
     * CategoryController constructor.
     *
     * @param  CategoryService  $categoryService
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('backend.structure.category.index');
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return view('backend.structure.category.create');
    }

    /**
     * @param  StoreCategoryRequest  $request
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function store(StoreCategoryRequest $request)
    {

        $this->categoryService->store($request->validated());

        return redirect()->route('admin.structure.category.index')->withFlashSuccess(__('La categoría ha sido creada.'));
    }

    /**
     * @param EditCategoryRequest $request
     * @param Category $category
     * @return mixed
     */
    public function edit(EditCategoryRequest $request, Category $category)
    {
        return view('backend.structure.category.edit')
            ->withCategory($category);
    }
    /**
     * @param  UpdateCategoryRequest  $request
     * @param  Category  $category
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $this->categoryService->update($category, $request->validated());

        return redirect()->route('admin.structure.category.index')->withFlashSuccess(__('La categoría ha sido modificada.'));
    }

    /**
     * @param  DeleteCategoryRequest  $request
     * @param  Category  $category
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(DeleteCategoryRequest $request, Category $category)
    {
        $this->categoryService->destroy($category);

        return redirect()->route('admin.structure.category.index')->withFlashSuccess(__('La categoría ha sido eliminada.'));
    }
}
