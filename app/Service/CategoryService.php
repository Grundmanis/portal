<?php

namespace App\Service;


use App\Advert;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CategoryService
{

    /**
     * @var Collection
     */
    public $categories;
    /**
     * @var Category
     */
    public $category;

    /**
     * @var Collection
     */
    public $categoryChild;

    /**
     * @var string
     */
    public $categoryViewName = 'category.index';

    /**
     * @var string
     */
    public $advertsViewName = 'category.show';

    /**
     * @var Category
     */
    public $categoryParent;

    /**
     * @var Collection
     */
    public $adverts;

    /**
     * @var Collection
     */
    public $filters;

    /**
     * CategoryService constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->categories = $request->categories['categories'];
        $this->category = $request->categories['category'];
        $this->categoryChild = $this->category->child;
        $this->categoryParent = isset($request->categories['categoryParent']) ? $request->categories['categoryParent'] : null;
    }

    /**
     * @return $this
     */
    public function getAdverts() {
        $this->adverts = $this->category->adverts()->orderBy('id','desc')->with('filters')->paginate(5);
        return $this;
    }

    /**
     * @return $this
     */
    public function getCategoryFilters() {
        $this->filters = $this->category->filters->where('in_adverts_list',1);
        return $this;
    }

}