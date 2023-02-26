<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $item_id;

    public function deleteCategory($item_id)
    {
        $this->item_id = $item_id;
    }

    public function destroyCategory()
    {
        $category = Category::find($this->item_id);
        $path = 'uploads/category/'.$category->image;

        //TODO not working, different names
        if (File::exists($path))
        {
            File::delete($path);
        }

        $category->delete();
        session()->flash('message', 'Category Deleted');
        $this->dispatchBrowserEvent('close-modal');
    }
    public function render()
    {
        $categories = Category::orderBy('id','DESC')->paginate(5);
        return view('livewire.admin.category.index', ['categories' => $categories]);
    }
}
