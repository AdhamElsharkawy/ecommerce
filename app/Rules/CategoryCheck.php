<?php

namespace App\Rules;

use Closure;
use App\Models\Category;
use Illuminate\Contracts\Validation\ValidationRule;

class CategoryCheck implements ValidationRule
{

    protected $category;

    /**
     * Create a new rule instance.
     *
     * @param  \App\Models\Category  $category
     */
    public function __construct($category)
    {
        $this->category = $category;
    }


    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $parent = Category::find($value);
        while ($parent) {
            if ($parent->parent_id == $this->category->id) {
                $fail('Invalid parent category. Please select a valid parent category.');
            }
        }
    }
}
