<?php

namespace App\Domains\Structure\Services;

use App\Domains\Structure\Events\Category\CategoryCreated;
use App\Domains\Structure\Events\Category\CategoryDeleted;
use App\Domains\Structure\Events\Category\CategoryUpdated;
use App\Domains\Structure\Models\Category;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class CategoryService.
 */
class CategoryService extends BaseService
{
    /**
     * CategoryService constructor.
     *
     * @param  Category  $category
     */
    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    /**
     * @param  array  $data
     *
     * @return Category
     * @throws GeneralException
     * @throws \Throwable
     */
    public function store(array $data = []): Category
    {
        DB::beginTransaction();

        try {
            $category = $this->model::create([
                'name' => $data['name'],
                'description' => $data['description'],
                'content' => $data['content'],
                'order' => $data['order'],
                'published' => $data['published'],
                'active' => $data['active'],
            ]);

            if (isset($data['image'])) {
                $category->addMediaFromBase64($data['image'])
                    ->usingName('Image')
                    ->usingFileName(getRandomFilenameFromB64($data['image']))
                    ->toMediaCollection('image');
            }

            if (isset($data['icon'])) {
                $category->addMediaFromBase64($data['icon'])
                    ->usingName('Icon')
                    ->usingFileName(getRandomFilenameFromB64($data['icon']))
                    ->toMediaCollection('icon');
            }
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('Hubo un problema creando la categoría.'));
        }

        event(new CategoryCreated($category));

        DB::commit();

        return $category;
    }

    /**
     * @param  Category  $category
     * @param  array  $data
     *
     * @return Category
     * @throws GeneralException
     * @throws \Throwable
     */
    public function update(Category $category, array $data = []): Category
    {
        DB::beginTransaction();

        try {
            $category->update([
                'name' => $data['name'],
                'description' => $data['description'],
                'content' => $data['content'],
                'order' => $data['order'],
                'published' => $data['published'],
                'active' => $data['active'],
            ]);

            if (isset($data['image'])) {
                $category->deleteImage();
                $category->addMediaFromBase64($data['image'])
                    ->usingName('Image')
                    ->usingFileName(getRandomFilenameFromB64($data['image']))
                    ->toMediaCollection('image');
            }

            if (isset($data['icon'])) {
                $category->deleteIcon();
                $category->addMediaFromBase64($data['icon'])
                    ->usingName('Icon')
                    ->usingFileName(getRandomFilenameFromB64($data['icon']))
                    ->toMediaCollection('icon');
            }
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('Hubo un problema actualizando la categoría.'));
        }

        event(new CategoryUpdated($category));

        DB::commit();

        return $category;
    }

    /**
     * @param  Category  $category
     *
     * @return bool
     * @throws GeneralException
     */
    public function destroy(Category $category): bool
    {
        if ($category->activities()->count()) {
            throw new GeneralException(__('No se puede eliminar una categoría con activdades asociadas'));
        }

        if ($this->deleteById($category->id)) {
            event(new CategoryDeleted($category));

            return true;
        }

        throw new GeneralException(__('Hubo un problema eliminando la categoría.'));
    }
}
